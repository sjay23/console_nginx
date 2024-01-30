<?php

namespace app\commands;

use Exception;
use yii\console\Controller;
use DateTime;
use app\models\NginxLog;
use yii\console\ExitCode;
use yii\helpers\BaseConsole;

class ReadNginxLogsController extends Controller
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

        $logs = NginxLog::findByDateRange($startDateObj, $finishDateObj);
        $outputContent = "Show details logs";
        foreach ($logs as $log) {
            $this->stderr($this->viewNginxLog($log), BaseConsole::FG_GREEN);
            $this->stderr("\n--------------------\n");
        }
        return $outputContent;
    }

    private function viewNginxLog(NginxLog $log): string
    {
        $content = [];
        $attrs = $log->getAttributes();
        foreach ($attrs as $attrName => $value) {
            $content[] = "{$attrName}: {$value}";
        }
        return implode("\n", $content);
    }
}
