<?php

namespace app\commands;

use Exception;
use yii\console\Controller;
use DateTime;
use app\models\NginxLog;
use yii\console\ExitCode;
use yii\helpers\BaseConsole;

class ReadCountNginxLogsController extends Controller
{
    public $startDate;
    public $finishDate;

    public function options($actionID): array
    {
        return ['startDate', 'finishDate'];
    }

    /**
     * @throws Exception
     */
    public function actionIndex()
    {
        if ($this->startDate === null || $this->finishDate === null) {
            $this->stderr('Usage: --startDate=<start_date> --endDate=<end_date>' . PHP_EOL, BaseConsole::FG_RED);
            return ExitCode::DATAERR;
        }
        $startDateObj = new DateTime($this->startDate);
        $finishDateObj = new DateTime($this->finishDate);

        $count = NginxLog::countByDateRange($startDateObj, $finishDateObj);
        $returnContent = "Count logs: {$count}";
        $this->stderr($returnContent, BaseConsole::FG_GREEN);
        $this->stderr("\n--------------------\n");
        return $returnContent;
    }
}
