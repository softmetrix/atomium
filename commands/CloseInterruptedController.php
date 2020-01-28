<?php

namespace app\commands;

use yii\console\Controller;
use app\models\PjeExecution;
use app\models\PjeExecutionStep;
use app\models\PjeNotification;

class CloseInterruptedController extends Controller
{
    public function actionIndex()
    {
        $inProgress = PjeExecution::find()->where([
                'end_time' => null,
            ])->all();
        foreach ($inProgress as $item) {
            if ($item->pid && !$this->pidIsRunning($item->pid)) {
                $execution = PjeExecution::find()->where([
                        'id' => $item->id,
                    ])->one();
                if (!$execution->end_time) {
                    PjeExecutionStep::updateAll([
                            'start_time' => date('Y-m-d H:i:s'),
                            'end_time' => date('Y-m-d H:i:s'),
                            'duration' => 0,
                            'success' => 0,
                            'response_message' => 'Interrupted',
                        ], 'end_time is null');
                    $duration = PjeExecutionStep::find()
                                                    ->where(['execution_id' => $execution->id])
                                                    ->andWhere(['not', ['duration' => null]])
                                                    ->sum('duration');
                    $startTime = PjeExecutionStep::find()
                                                    ->where(['execution_id' => $execution->id])
                                                    ->andWhere(['not', ['start_time' => null]])
                                                    ->min('start_time');
                    $endTime = PjeExecutionStep::find()
                                                    ->where(['execution_id' => $execution->id])
                                                    ->andWhere(['not', ['end_time' => null]])
                                                    ->max('end_time');
                    $execution->duration = $duration;
                    $execution->success = 0;
                    $execution->start_time = $startTime;
                    $execution->end_time = $endTime;
                    $execution->save(false);
                    $this->generateNotification($execution);
                }
            }
        }
    }

    protected function generateNotification($execution)
    {
        $notification = new PjeNotification();
        $notification->execution_id = $execution->id;
        $notification->notification_type = PjeNotification::TYPE_ERROR;
        $notification->notification_date = $execution->end_time;
        $notification->message = 'Job interrupted';
        $notification->save();
    }

    protected function pidIsRunning($pid)
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
            $taskList = shell_exec('tasklist 2>NUL');
            $taskTable = explode("\n", trim($taskList));
            $delimiters = explode(' ', $taskTable[1]);
            $pidColumnStart = strlen($delimiters[0]) + 1;
            $pidColumnLength = strlen($delimiters[1]);
            $pids = [];
            foreach ($taskTable as $key => $task) {
                if ($key > 1) {
                    $pids[] = (int) substr($task, $pidColumnStart, $pidColumnLength);
                }
            }
            $running = in_array($pid, $pids);
        } elseif (PHP_OS == 'Darwin') {
            $psOutput = shell_exec('ps -A -o pid');
            $pids = explode("\n", $psOutput);
            $pids = array_map('trim', $pids);
            $pids = array_filter($pids, function ($e) {
                return $e != 'PID' && $e != '';
            });
            $pids = array_map('intval', $pids);
            $running = in_array($pid, $pids);
        } elseif (PHP_OS == 'Linux') {
            $running = file_exists("/proc/{$pid}");
        } else {
            $running = true;
        }

        return $running;
    }
}
