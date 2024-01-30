<?php

namespace functional\commands;

use Yii;
use yii\base\InvalidRouteException;
use yii\console\Exception;
use yii\console\ExitCode;

class WriteNginxLogsToDbControllerTestCest
{

    /**
     * @throws Exception
     * @throws InvalidRouteException
     */
    public function testActionIndex(\FunctionalTester $I)
    {
        $test = Yii::$app->runAction('write-nginx-logs-to-db/index');
        $I->assertEquals("Success write DB", $test);
    }
}
