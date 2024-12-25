<?php
namespace Sdk\Role\Purview\Model;

class PurviewFactory
{
    const MAPS = array(
        'o'=>'\Sdk\Organization\Organization\Model\OrganizationPurview',
        'o/d'=>'\Sdk\Organization\Department\Model\DepartmentPurview',
        'r'=>'\Sdk\Role\Model\RolePurview',
        'u/s'=>'\Sdk\User\Staff\Model\StaffPurview',
        'dc'=>'\Sdk\Dictionary\Item\Model\DictionaryPurview',
        'dc/di'=>'\Sdk\Dictionary\Item\Model\DictionaryPurview',
        'u/m'=>'\Sdk\User\Member\Model\MemberPurview',
        'l/a'=>'\Sdk\Log\ApplicationLog\Model\ApplicationLogPurview',
        'a'=>'\Sdk\Article\Article\Model\ArticlePurview',
        'a/ac'=>'\Sdk\Article\Category\Model\CategoryPurview',
        'sw'=>'\Sdk\Sensitive\Word\Model\SensitiveWordPurview',
        's/cms' =>'Sdk\Statistics\Record\Model\CmsPurview',
        'r/rd'=>'\Sdk\Resource\Directory\Model\DirectoryPurview',
        'r/rds'=>'\Sdk\Resource\Directory\Model\DirectoryPurview',
        's/rd' =>'Sdk\Statistics\Record\Model\ResourceDirectoryPurview',
        'r/rdsj'=>'\Sdk\Resource\Data\Model\DataPurview',
        'r/edt'=>'\Sdk\Resource\Data\Model\DataPurview',
        'r/udt'=>'\Sdk\Resource\Data\Model\DataPurview',
        'r/udtr'=>'\Sdk\Resource\Data\Model\DataPurview',
        's/rdsj' =>'Sdk\Statistics\Record\Model\ResourceDataPurview',
        's/rp' =>'Sdk\Statistics\Record\Model\ResourcePublicationPurview',
        's/rpqa' =>'Sdk\Statistics\Record\Model\ResourcePublicationQualityAnalysisPurview',
        's/rr' =>'Sdk\Statistics\Record\Model\ResourceRandomPurview',
        'wc/apc'=>'\Sdk\Article\Category\Model\ArticlePageConfigPurview',
        'wc/hpc'=>'\Sdk\WebsiteConfig\HelpPageConfig\Model\HelpPageConfigPurview',
        'wc/hmpc'=>'\Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfigPurview',
        'r/e'=>'\Sdk\Resource\Enterprise\Model\EnterprisePurview',
        'r/n'=>'\Sdk\Resource\NaturalPerson\Model\NaturalPersonPurview',
        's/rcs' =>'Sdk\Statistics\Record\Model\ResourceCreditSubjectPurview',
        'rap/m'=>'\Sdk\Rap\Memorandum\Model\MemorandumPurview',
        'rap/ms'=>'\Sdk\Rap\Measure\Model\MeasurePurview',
        'rap/c'=>'\Sdk\Rap\RapCase\Model\RapCasePurview',
        's/rap' =>'Sdk\Statistics\Record\Model\RapPurview',
        'cm/o'=>'\Sdk\Monitor\Opinion\Model\OpinionPurview',
        'cm/fm'=>'\Sdk\Monitor\FocusMonitor\Model\FocusMonitorPurview',
        'cm/fmr'=>'\Sdk\Monitor\FocusMonitor\Model\FocusMonitorPurview',
        'a/c'=>'\Sdk\Application\Commitment\Model\CommitmentPurview',
        'a/p'=>'\Sdk\Application\Commitment\Model\CommitmentPurview',
        'a/cs'=>'\Sdk\Application\Commitment\Model\CommitmentPurview',
        'a/ps'=>'\Sdk\Application\Commitment\Model\CommitmentPurview',
        's/ac' =>'Sdk\Statistics\Record\Model\CommitmentPurview',
        'i/i'=>'\Sdk\Interaction\Interlocution\Model\InterlocutionPurview',
        'i/f'=>'\Sdk\Interaction\Feedback\Model\FeedbackPurview',
        'i/c'=>'\Sdk\Interaction\Complaint\Model\ComplaintPurview',
        'i/p'=>'\Sdk\Interaction\Praise\Model\PraisePurview',
        'i/a'=>'\Sdk\Interaction\Appeal\Model\AppealPurview',
        's/i' =>'Sdk\Statistics\Record\Model\InteractionPurview',
        'cr/cc'=>'\Sdk\CreditReport\CommonConfig\Model\CommonConfigPurview',
        'cr/dr'=>'\Sdk\CreditReport\DownloadRecord\Model\DownloadRecordPurview',
        's/cr' =>'Sdk\Statistics\Record\Model\CreditReportPurview',
        'c/p'=>'\Sdk\Contract\Performance\Model\PerformancePurview',
        'c/f'=>'\Sdk\Contract\Performance\Model\PerformancePurview',
        'c/b'=>'\Sdk\Contract\Performance\Model\PerformancePurview',
        's/cp' =>'Sdk\Statistics\Record\Model\ContractPerformancePurview',
        'e/sm'=>'\Sdk\Evaluation\ScoreModel\Model\ScoreModelPurview',
        'e/i'=>'\Sdk\Evaluation\Indicator\Model\IndicatorPurview',
        'e/s'=>'\Sdk\Evaluation\Scenario\Model\ScenarioPurview',
        'cm/ioe'=>'\Sdk\CreditModule\IndustryOrgEva\Model\IndustryOrgEvaPurview',
        'cm/cer'=>'\Sdk\CreditModule\Model\CreditModuleFinancePurview',
        'cm/col'=>'\Sdk\CreditModule\Model\CreditModuleFinancePurview',
        'cm/cop'=>'\Sdk\CreditModule\Model\CreditModuleFinancePurview',
        'cm/fin'=>'\Sdk\CreditModule\Model\CreditModuleFinancePurview',
        'cm/sof'=>'\Sdk\CreditModule\Model\CreditModuleFinancePurview',
        'cm/tax'=>'\Sdk\CreditModule\Model\CreditModuleFinancePurview',
        's/cm' =>'Sdk\Statistics\Record\Model\CreditModulePurview',
        'm/nc'=>'\Sdk\Member\NaturalPersonCertificate\Model\NaturalPersonCertificatePurview',
        'm/ec'=>'\Sdk\Member\EnterpriseCertificate\Model\EnterpriseCertificatePurview',
        'm/c'=>'\Sdk\Member\Commitment\Model\CommitmentPurview',
        'm/rd'=>'\Sdk\Member\ResourceData\Model\ResourceDataPurview',
        's/sd' =>'Sdk\Statistics\Record\Model\SelfDeclarationPurview',
        'h' =>'Sdk\Statistics\Record\Model\WorkbenchPurview',
    );

    public static function getPurview(string $resource) : IPurviewAble
    {
        $model = isset(self::MAPS[$resource]) ? self::MAPS[$resource] : '';

        return class_exists($model) ? new $model : new NullPurview();
    }
}