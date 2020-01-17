<?php

namespace app\components;

class Sleep3SecondsStep extends Step
{
    protected function execute()
    {
        sleep(3);

        return self::generateResponse(1, 'Done');
    }
}
