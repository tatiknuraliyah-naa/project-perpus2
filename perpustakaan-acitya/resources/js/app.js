import './bootstrap';

const sidebar = document.querySelector('.app-sidebar');
const sidebarToggle = document.querySelector('.sidebar-toggle');
const sidebarBackdrop = document.querySelector('.sidebar-backdrop');

if (sidebar && sidebarToggle) {
    const setSidebarOpen = (isOpen) => {
        sidebar.classList.toggle('is-open', isOpen);
        sidebarBackdrop?.classList.toggle('is-visible', isOpen);
        sidebarToggle.setAttribute('aria-expanded', String(isOpen));
    };

    sidebarToggle.addEventListener('click', () => {
        setSidebarOpen(!sidebar.classList.contains('is-open'));
    });

    sidebarBackdrop?.addEventListener('click', () => setSidebarOpen(false));
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') setSidebarOpen(false);
    });
}

const scanner = document.querySelector('[data-qr-scanner]');

if (scanner) {
    const video = scanner.querySelector('.scanner-video');
    const status = scanner.querySelector('.scanner-status');
    const startButton = scanner.querySelector('.scanner-start');
    const stopButton = scanner.querySelector('.scanner-stop');
    const placeholder = scanner.querySelector('.scanner-placeholder');
    const manualForm = scanner.querySelector('[data-qr-manual-form]');
    const scanPrefix = scanner.dataset.scanPrefix;
    let stream;
    let timer;

    const stopScanner = () => {
        window.clearInterval(timer);
        timer = undefined;
        stream?.getTracks().forEach((track) => track.stop());
        stream = undefined;
        video.srcObject = null;
        placeholder.hidden = false;
        startButton.hidden = false;
        stopButton.hidden = true;
    };

    const openScannedUrl = (value) => {
        try {
            const url = new URL(value, window.location.origin);
            if (url.origin !== window.location.origin || !url.href.startsWith(scanPrefix)) {
                throw new Error('QR bukan QR Kunjungan dari aplikasi ini.');
            }
            stopScanner();
            window.location.assign(url.href);
        } catch (error) {
            status.textContent = error.message || 'QR Code tidak dapat dibaca.';
        }
    };

    const scanFrame = async (detector) => {
        if (video.readyState < HTMLMediaElement.HAVE_CURRENT_DATA) return;
        try {
            const codes = await detector.detect(video);
            if (codes[0]?.rawValue) openScannedUrl(codes[0].rawValue);
        } catch {
            // Frame yang belum fokus adalah hal yang normal saat pemindaian berlangsung.
        }
    };

    startButton.addEventListener('click', async () => {
        if (!('BarcodeDetector' in window) || !navigator.mediaDevices?.getUserMedia) {
            status.textContent = 'Browser ini belum mendukung scan kamera. Gunakan kolom tautan di bawah.';
            return;
        }

        try {
            stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: { ideal: 'environment' } }, audio: false });
            video.srcObject = stream;
            await video.play();
            const detector = new BarcodeDetector({ formats: ['qr_code'] });
            placeholder.hidden = true;
            startButton.hidden = true;
            stopButton.hidden = false;
            status.textContent = 'Kamera aktif. Arahkan ke QR Code kunjungan.';
            timer = window.setInterval(() => scanFrame(detector), 350);
        } catch (error) {
            status.textContent = error.name === 'NotAllowedError'
                ? 'Akses kamera ditolak. Izinkan kamera atau gunakan kolom tautan.'
                : 'Kamera tidak dapat digunakan. Gunakan kolom tautan di bawah.';
            stopScanner();
        }
    });

    stopButton.addEventListener('click', () => {
        stopScanner();
        status.textContent = 'Kamera dimatikan.';
    });

    manualForm.addEventListener('submit', (event) => {
        event.preventDefault();
        openScannedUrl(new FormData(manualForm).get('qr_url'));
    });

    window.addEventListener('pagehide', stopScanner, { once: true });
}
