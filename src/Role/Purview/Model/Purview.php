<?php
namespace Sdk\Role\Purview\Model;

use Marmot\Core;

/**
 * @todo
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class Purview implements IPurviewAble
{
    private $column;

    public function __construct(int $column = 0)
    {
        $this->column = !empty($column) ? $column : 0;
    }

    public function __destruct()
    {
        unset($this->column);
    }

    public function getColumn(): int
    {
        return $this->column;
    }

    public function fetch() : bool
    {
        $staffPurview = $this->fetchStaffPurview();
        $column = $this->getColumn();

        return isset($staffPurview[$column]);
    }

    protected function operation($method, $column = 0) : bool
    {
        $staffPurview = $this->fetchStaffPurview();
        $column = empty($column) ? $this->getColumn() : $column;
        
        if (isset($staffPurview[$column]) && isset(IPurviewAble::ACTIONS[$column][$method])) {
            $action = IPurviewAble::ACTIONS[$column][$method];
            return ($action & $staffPurview[$column]) == $action;
        }

        return false;
    }

    /**
     * 该方法是为了处理同一个列表中的多个栏目下都存在同一个操作
     * 如: 信用数据管理, 信用数据检索, 信用数据归档中都存在数据导出功能, 只要有其中一个栏目中有数据导出功能, 默认该权限为true, 细致的权限校验由前端控制
     */
    protected function operationColumns($method, array $columns) : bool
    {
        $staffPurview = $this->fetchStaffPurview();

        if (!empty($columns)) {
            foreach ($columns as $column) {
                if (isset($staffPurview[$column]) && isset(IPurviewAble::ACTIONS[$column][$method])) {
                    $action = IPurviewAble::ACTIONS[$column][$method];
                    if (($action & $staffPurview[$column]) == $action) {
                        return true;
                    }
                }
            }
        }
        
        return false;
    }

    protected function fetchStaffPurview() : array
    {
        return Core::$container->get('staff')->getPurview();
    }
}
