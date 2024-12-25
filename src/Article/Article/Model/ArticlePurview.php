<?php
namespace Sdk\Article\Article\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class ArticlePurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['ARTICLE']);
    }

    public function fetch() : bool
    {
        $staffPurview = $this->fetchStaffPurview();
        $articleColumn = IPurviewAble::COLUMN['ARTICLE'];
        $articleExamineColumn = IPurviewAble::COLUMN['ARTICLE_EXAMINE'];

        return (isset($staffPurview[$articleColumn]) || isset($staffPurview[$articleExamineColumn]));
    }

    public function top() : bool
    {
        return $this->operation('top');
    }

    public function cancelTop() : bool
    {
        return $this->operation('cancelTop');
    }

    public function enable() : bool
    {
        return $this->operation('enable');
    }

    public function disable() : bool
    {
        return $this->operation('disable');
    }

    public function add() : bool
    {
        return $this->operation('add');
    }

    public function edit() : bool
    {
        return $this->operation('edit');
    }

    public function approve() : bool
    {
        $articleExamineColumn = IPurviewAble::COLUMN['ARTICLE_EXAMINE'];

        return $this->operation('approve', $articleExamineColumn);
    }

    public function reject() : bool
    {
        $articleExamineColumn = IPurviewAble::COLUMN['ARTICLE_EXAMINE'];

        return $this->operation('reject', $articleExamineColumn);
    }
}
