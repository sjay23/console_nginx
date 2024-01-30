<?php

namespace functional\commands;

use app\commands\ReadNginxLogsController;
use Yii;
use yii\base\InvalidRouteException;
use yii\console\Exception;
use yii\console\ExitCode;

class ReadNginxLogsControllerTestCest
{

    /**
     * @throws Exception
     * @throws InvalidRouteException
     */
    public function testActionIndex(\FunctionalTester $I)
    {
        $controller = new ReadNginxLogsController('read-count-nginx-logs', null);
        $controller->startDate = '2024-01-01';
        $controller->finishDate = '2024-01-31';

        $output = $controller->actionIndex();

        $I->assertEquals("Show details logs", $output);
    }
}
