<?php

use bashkarev\clickhouse\Migration;

/**
 * Handles the creation of table `{{%clickhouse}}`.
 */
class m240129_232311_create_clickhouse_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE TABLE IF NOT EXISTS Nginx_logs (
    `remote_addr` String,
    `remote_user` String,
    `time_local` DateTime,
    `request` String,
    `status` UInt16,
    `body_bytes_sent` UInt64,
    `http_referer` String,
    `http_user_agent` String,
    `http_x_forwarded_for` String
) ENGINE = MergeTree
ORDER BY time_local;");
        $this->createTable('Nginx_logs', [
            'remote_addr' => $this->string(),
            'remote_user' => $this->string(),
            'time_local' => $this->dateTime(),
            'request' => $this->string(),
            'status' => $this->integer(),
            'body_bytes_sent' => $this->bigInteger(),
            'http_referer' => $this->string(),
            'http_user_agent' => $this->string(),
            'http_x_forwarded_for' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('Nginx_logs');
    }
}
