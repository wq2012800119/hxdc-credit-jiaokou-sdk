<?php
namespace Sdk\Statistics\Record\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class ResourcePublicationQualityAnalysisPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['RESOURCE_PUBLICATION_QUALITY_ANALYSIS_STATISTICS']);
    }
}
