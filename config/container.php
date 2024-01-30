<?php

return [
    'singletons' => [
        \ClickHouseDB\Client::class => function () {
            return new \ClickHouseDB\Client(Yii::$app->params['clickhouse']);
        },
    ]
];
