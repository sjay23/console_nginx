<?php

return [
    'class' => 'bashkarev\clickhouse\Connection',
    'dsn' => "host={$_ENV['CLICKHOUSE_HOST']};port={$_ENV['CLICKHOUSE_PORT']};database={$_ENV['CLICKHOUSE_DB']};connect_timeout_with_failover_ms=10",
    'username' => $_ENV['CLICKHOUSE_USER'],
    'password' => $_ENV['CLICKHOUSE_PASS'],
    'charset' => 'utf8',
];
