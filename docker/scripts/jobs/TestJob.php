<?php

namespace app\components;

class TestJob extends Job
{
    public function params()
    {
        $params = [];
        $params['job_param_1'] = 111;

        return $params;
    }
}
