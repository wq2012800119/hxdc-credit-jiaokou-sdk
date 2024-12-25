<?php
namespace Sdk\Evaluation\Scenario\Model;

use Marmot\Core;
use Marmot\Interfaces\INull;

class NullEvaluationReport extends EvaluationReport implements INull
{
    private static $instance;

    public static function &getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function resourceNotExist() : bool
    {
        Core::setLastError(RESOURCE_NOT_EXIST);
        return false;
    }

    public function evaluate() : bool
    {
        return $this->resourceNotExist();
    }
}
