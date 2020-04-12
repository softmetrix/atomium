<?php

namespace app\components;

class Sleep5SecondsStep extends Step
{
    protected function execute()
    {
        sleep(5);
        $this->message = 'Done';
        $this->success = 1;
    }
}
