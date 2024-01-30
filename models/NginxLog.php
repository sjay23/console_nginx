<?php


namespace app\models;

use DateTime;
use bashkarev\clickhouse\ActiveRecord;

/**
 * This is the model class for table "Nginx_logs".
 *
 * @property string $remote_addr
 * @property string $time_local
 * @property string $request_method
 * @property string $request
 * @property string $request_protocol
 * @property integer $status
 * @property string $body_bytes_sent
 * @property string $http_referer
 * @property string $http_user_agent
 */
class NginxLog extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'logger.Nginx_logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['remote_addr', 'time_local', 'request_method', 'request', 'status', 'body_bytes_sent'], 'required'],
            [
                [
                    'remote_addr',
                    'remote_user',
                    'time_local',
                    'request_method',
                    'request',
                    'request_protocol',
                    'http_referer',
                    'http_user_agent'
                ],
                'string'
            ],
            [['status', 'body_bytes_sent'], 'integer'],
        ];
    }

    public static function findByDateRange(DateTime $startDate, DateTime $endDate): array
    {
        return static::find()
            ->where(['between', 'time_local', $startDate->format('Y-m-d H:i:s'), $endDate->format('Y-m-d H:i:s')])
            ->all();
    }

    public static function countByDateRange(DateTime $startDate, DateTime $endDate): string
    {
        return static::find()
            ->where(['between', 'time_local', $startDate->format('Y-m-d H:i:s'), $endDate->format('Y-m-d H:i:s')])
            ->count();
    }
}
