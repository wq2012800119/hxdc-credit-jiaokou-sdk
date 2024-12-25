<?php
namespace Sdk\CreditReport\DownloadRecord\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\CreditReport\DownloadRecord\Model\DownloadRecord;

class DownloadRecordWidgetRule
{
    public function domain($domain) : bool
    {
        if (!V::numeric()->positive()->validate($domain) || !in_array($domain, DownloadRecord::DOMAIN)
        ) {
            Core::setLastError(CREDIT_REPORT_DOWNLOAD_RECORD_DOMAIN_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function target($target) : bool
    {
        if (!V::numeric()->positive()->validate($target) || !in_array($target, DownloadRecord::TARGET)
        ) {
            Core::setLastError(CREDIT_REPORT_DOWNLOAD_RECORD_TARGET_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function subjectCategory($subjectCategory) : bool
    {
        if (!V::numeric()->positive()->validate($subjectCategory)
        || !in_array($subjectCategory, DownloadRecord::SUBJECT_CATEGORY)
        ) {
            Core::setLastError(CREDIT_REPORT_SUBJECT_CATEGORY_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
}
