<?php

return [
    'enabled' => env('BACKUP_ENABLED', true),
    'binary' => env('MYSQLDUMP_BINARY', '/usr/bin/mysqldump'),
];
