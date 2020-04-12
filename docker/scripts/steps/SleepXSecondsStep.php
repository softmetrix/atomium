<?php

namespace app\components;

class SleepXSecondsStep extends Step
{
    protected function execute()
    {
        $seconds = 5;
        if (array_key_exists('seconds', $this->params)) {
            $seconds = $this->params['seconds'];
        }
        sleep($seconds);
        $this->message = 'Done';
        $this->success = 1;
    }
}
