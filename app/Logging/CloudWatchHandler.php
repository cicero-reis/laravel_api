<?php

namespace App\Logging;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;
use Aws\CloudWatchLogs\CloudWatchLogsClient;

class CloudWatchHandler extends AbstractProcessingHandler
{
    protected CloudWatchLogsClient $client;
    protected string $logGroup;
    protected string $logStream;

    public function __construct(
        CloudWatchLogsClient $client,
        string $logGroup,
        string $logStream,
        $level = null,
        bool $bubble = true
    ) {
        parent::__construct($level, $bubble);

        $this->client = $client;
        $this->logGroup = $logGroup;
        $this->logStream = $logStream;

        // Cria o stream se não existir
        try {
            $this->client->createLogStream([
                'logGroupName' => $this->logGroup,
                'logStreamName' => $this->logStream,
            ]);
        } catch (\Exception $e) {
            // Ignore se já existir
        }
    }

    protected function write(LogRecord $record): void
    {
        $this->client->putLogEvents([
            'logGroupName' => $this->logGroup,
            'logStreamName' => $this->logStream,
            'logEvents' => [
                [
                    'timestamp' => round(microtime(true) * 1000),
                    'message' => $record->formatted,
                ],
            ],
        ]);
    }
}
