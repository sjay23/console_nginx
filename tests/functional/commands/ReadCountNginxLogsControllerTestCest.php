<?php

namespace functional\commands;

use app\commands\ReadCountNginxLogsController;
use app\models\NginxLog;
use DateTime;
use yii\helpers\Console;

class ReadCountNginxLogsControllerTestCest
{
    public function testActionIndex(\FunctionalTester $I)
    {
        $I->wantTo('Test action index');

        $controller = new ReadCountNginxLogsController('read-count-nginx-logs', null);
        $controller->startDate = '2024-01-01';
        $controller->finishDate = '2024-01-31';

        $I->expectTo('See count of logs between 2024-01-01 and 2024-01-31');
        $expectedCount = NginxLog::countByDateRange(new DateTime('2024-01-01'), new DateTime('2024-01-31'));

        $output = $controller->actionIndex();

        $I->assertEquals("Count logs: {$expectedCount}", $output);
    }
}
