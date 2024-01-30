<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'clickhouse' => [
        'host' => $_ENV['CLICKHOUSE_HOST'] ?? 'clickhouse',
        'port' => $_ENV['CLICKHOUSE_PORT'] ?? 8123,
        'database' => $_ENV['CLICKHOUSE_DB'] ?? 'logger',
        'username' => $_ENV['CLICKHOUSE_USER'] ?? 'default',
        'password' => $_ENV['CLICKHOUSE_PASS'] ?? '',
    ],
];
