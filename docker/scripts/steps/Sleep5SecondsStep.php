<?php

namespace app\components;

class Sleep5SecondsStep extends Step
{
    protected function execute()
    {
        sleep(5);

        return self::generateResponse(1, 'Done');
    }
}
