<?php
namespace Sdk\Template\Adapter\Template;

use Sdk\Template\Model\Template;

use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;

interface ITemplateAdapter extends IFetchAbleAdapter
{
    //下载模板
    public function export(Template $template) : bool;
}
