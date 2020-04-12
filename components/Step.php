<?php

namespace app\components;

abstract class Step
{
    protected $params = [];
    protected $message = '';
    protected $success = 1;

    public function run()
    {
        try {
            if ($this->shouldExecute()) {
                $this->execute();
                $output = self::generateResponse($this->success, $this->message);
            } else {
                $output = self::generateResponse(1, 'Skipped');
            }
        } catch (\Exception $ex) {
            $output = self::generateResponse(0, $ex->getMessage());
        }

        return $output;
    }

    abstract protected function execute();

    public function setParams($params)
    {
        $this->params = $params;
    }

    public static function generateResponse($success, $message)
    {
        return [
            'success' => $success,
            'message' => $message,
        ];
    }

    protected function shouldExecute()
    {
        return true;
    }
}
