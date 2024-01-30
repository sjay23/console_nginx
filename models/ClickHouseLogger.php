<?php

namespace app\models;

use Yii;

class ClickHouseLogger
{
    public static function log($data)
    {
        $clickhouse = Yii::$app->clickhouse;

        $command = $clickhouse->createCommand();
        $command->insert(NginxLog::tableName(), $data)->execute();
    }
}
