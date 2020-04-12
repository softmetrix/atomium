<?php

namespace app\components;

class Sleep3SecondsStep extends Step
{
    protected function execute()
    {
        sleep(3);
        $this->message = 'Done';
        $this->success = 1;
    }
}
