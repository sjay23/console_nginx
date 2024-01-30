<?php
$db = require __DIR__ . '/db.php';
// test database! Important not to run tests on production or development databases
$db['dsn'] = "host={$_ENV['CLICKHOUSE_HOST']};port={$_ENV['CLICKHOUSE_PORT']};database={$_ENV['CLICKHOUSE_DB']};connect_timeout_with_failover_ms=10";

return $db;
