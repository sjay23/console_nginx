#!/bin/bash

sleep 10

clickhouse-client --query "CREATE DATABASE IF NOT EXISTS logger;"
clickhouse-client --query "CREATE TABLE IF NOT EXISTS logger.Nginx_logs (
                               \`remote_addr\` String,
                               \`remote_user\` String,
                               \`time_local\` DateTime,
                               \`request_method\` String,
                               \`request\` String,
                               \`request_protocol\` String,
                               \`status\` UInt16,
                               \`body_bytes_sent\` UInt64,
                               \`http_referer\` String,
                               \`http_user_agent\` String
                           ) ENGINE = MergeTree
                           ORDER BY time_local;"

