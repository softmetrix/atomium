<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class CreateController extends Controller
{
    public $type;
    public $name;
    private $jobsPath;
    private $stepsPath;
    private $componentsPath;

    public function options($actionID)
    {
        return ['type', 'name'];
    }

    public function optionAliases()
    {
        return [
            't' => 'type',
            'n' => 'name',
        ];
    }

    public function init()
    {
        parent::init();
        $this->jobsPath = Yii::$app->params['jobs_path'];
        $this->stepsPath = Yii::$app->params['steps_path'];
        $this->componentsPath = Yii::$app->params['components_path'];
    }

    public function actionIndex()
    {
        $this->name = ucfirst($this->name);
        if ($this->validateArgs()) {
            switch ($this->type) {
                case 'step':
                    $this->generateStepFromTemplate();
                break;
                case 'job':
                    $this->generateJobFromTemplate();
                break;
                case 'component':
                    $this->generateComponentFromTemplate();
                break;
            }
            echo 'File '.$this->generateClassPath()." has been successfully generated\n";
        }
    }

    private function validateArgs()
    {
        return $this->validatePassed() &&
            $this->validateType() &&
            $this->validateName() &&
            $this->validateFileExists();
    }

    private function validatePassed()
    {
        $status = true;
        if ($this->name &&
            $this->type &&
            strlen($this->name) > 0 &&
            strlen($this->type) > 0) {
            $status = true;
        } else {
            echo "Arguments name(n) and type(t) must be passed \n";
            $status = false;
        }

        return $status;
    }

    private function validateType()
    {
        $allowedTypes = ['job', 'step', 'component'];
        $status = in_array($this->type, $allowedTypes);
        if (!$status) {
            echo "Argument type must be job, step or component \n";
        }

        return $status;
    }

    private function validateName()
    {
        $status = preg_match('/^[A-Za-z]\w+$/', $this->name);
        if (!$status) {
            echo "{$this->name} is invalid name for class \n";
        }

        return $status;
    }

    private function validateFileExists()
    {
        $status = true;
        $path = $this->generateClassPath();
        if (file_exists($path)) {
            echo "{$path} file already exists. Please choose another name. \n";
            $status = false;
        }

        return $status;
    }

    private function generateFullClassName()
    {
        return $this->name.''.ucfirst($this->type);
    }

    private function generateClassPath()
    {
        switch ($this->type) {
            case 'step':
                $path = $this->stepsPath;
            break;
            case 'job':
                $path = $this->jobsPath;
            break;
            case 'component':
                $path = $this->componentsPath;
            break;
        }

        return $path.DIRECTORY_SEPARATOR.$this->generateFullClassName().'.php';
    }

    private function generateStepFromTemplate()
    {
        $code = <<<EOF
<?php
namespace app\components;
use Yii;

class [classname] extends Step {
    protected function execute() {
        \$success = 1;
        \$response = 'OK';
        return self::generateResponse(\$success, \$response);
    }
}
EOF;
        $code = str_replace('[classname]', $this->generateFullClassName(), $code);
        file_put_contents($this->generateClassPath(), $code);
    }

    private function generateJobFromTemplate()
    {
        $code = <<<EOF
<?php
namespace app\components;\
use Yii;

class [classname] extends Job {
    public function params() {
        \$params = [];
        return \$params;
    }
}
EOF;
        $code = str_replace('[classname]', $this->generateFullClassName(), $code);
        file_put_contents($this->generateClassPath(), $code);
    }

    private function generateComponentFromTemplate()
    {
        $code = <<<EOF
<?php
namespace app\components;

class [classname] extends Component {
}
EOF;
        $code = str_replace('[classname]', $this->generateFullClassName(), $code);
        file_put_contents($this->generateClassPath(), $code);
    }
}
