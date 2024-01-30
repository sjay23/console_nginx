<?php

namespace app\commands;

use app\models\ClickHouseLogger;
use DateTime;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\BaseConsole;

class WriteNginxLogsToDbController extends Controller
{
    public function actionIndex()
    {
        $logFile = '/var/log/nginx/access.log';
        $stateFile = 'nginx_log_state.txt';

        $lastPosition = file_exists($stateFile) ? intval(file_get_contents($stateFile)) : 0;
        $handle = fopen($logFile, "r");

        if ($handle) {
            fseek($handle, $lastPosition);
            while (($line = fgets($handle)) !== false) {
                $this->processLine($line);
                file_put_contents($stateFile, ftell($handle));
            }

            fclose($handle);
        } else {
            $this->stderr("Error file read" . PHP_EOL, BaseConsole::FG_RED);
            return ExitCode::DATAERR;
        }
        $this->stderr("Success write DB", BaseConsole::FG_GREEN);
        return "Success write DB";
    }

    private function processLine($logLine)
    {
        $pattern = '/^(\S+) (\S+) (\S+) \[(.+)\] "(\S+) (\S+) (\S+)" (\d+) (\d+) "([^"]*)" "([^"]*)"$/';

        $matches = [];

        preg_match($pattern, $logLine, $matches);

        $remoteAddr = $matches[1];
        $remoteUser = $matches[2];
        $timeLocal = DateTime::createFromFormat('d/M/Y:H:i:s O', $matches[4])->format('Y-m-d H:i:s');
        $requestMethod = $matches[5];
        $requestUri = $matches[6];
        $requestProtocol = $matches[7];
        $status = $matches[8];
        $bodyBytesSent = $matches[9];
        $httpReferer = $matches[10];
        $httpUserAgent = $matches[11];

        $data = [
            'remote_addr' => $remoteAddr,
            'remote_user' => $remoteUser,
            'time_local' => $timeLocal,
            'request_method' => $requestMethod,
            'request' => $requestUri,
            'request_protocol' => $requestProtocol,
            'status' => $status,
            'body_bytes_sent' => $bodyBytesSent,
            'http_referer' => $httpReferer,
            'http_user_agent' => $httpUserAgent
        ];
        ClickHouseLogger::log($data);
    }
}
