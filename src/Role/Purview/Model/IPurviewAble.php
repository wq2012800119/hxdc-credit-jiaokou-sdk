<?php
namespace Sdk\Role\Purview\Model;

interface IPurviewAble
{
    /**
     * 是否需要权限限制
     */
    const PURVIEW_SCENE = array(
        'YES' => 0,
        'NO' => -2,
    );
    /**
     * 导航栏目
     * ORGANIZATION 委办局
     * DEPARTMENT 科室
     * ROLE 角色
     * STAFF 员工
     * DICTIONARY 字典
     * MEMBER 前台用户
     * APPLICATION_LOG 日志
     * ARTICLE_CATEGORY 新闻分类
     * ARTICLE 新闻发布
     * ARTICLE_EXAMINE 新闻审核
     * SENSITIVE_WORD 错敏词
     * CMS_STATISTICS 内容发布审核统计分析
     * RESOURCE_DIRECTORY 目录发布
     * RESOURCE_DIRECTORY_EXAMINE 目录审核
     * RESOURCE_DIRECTORY_STATISTICS 信用目录自主管理统计分析
     * RESOURCE_DATA 信用数据管理
     * RESOURCE_DATA_SEARCH 信用数据检索
     * RESOURCE_DATA_FILE 信用数据归档
     * RESOURCE_DATA_EXAMINE 信用数据审核
     * RESOURCE_DATA_STATISTICS 信用信息综合管理数据统计分析
     * RESOURCE_PUBLICATION 十公示数据管理
     * RESOURCE_PUBLICATION_SEARCH 十公示数据检索
     * RESOURCE_PUBLICATION_FILE 十公示数据归档
     * RESOURCE_PUBLICATION_EXAMINE 十公示数据审核
     * RESOURCE_PUBLICATION_STATISTICS 十公示统计分析
     * RESOURCE_PUBLICATION_QUALITY_ANALYSIS_STATISTICS 十公示数据质量分析
     * RESOURCE_RANDOM 抽查检查结果管理
     * RESOURCE_RANDOM_SEARCH 抽查检查结果检索
     * RESOURCE_RANDOM_FILE 抽查检查结果归档
     * RESOURCE_RANDOM_EXAMINE 抽查检查结果审核
     * RESOURCE_RANDOM_STATISTICS 抽查检查结果统计分析
     * CIVIL_SERVANT_CREDIT_FILE 公务员信用档案
     * DOCTOR_CREDIT_FILE 医生信用档案
     * LAWYER_CREDIT_FILE 律师信用档案
     * TEACHER_CREDIT_FILE 教师信用档案
     * WEBSITE_HOME_PAGE_CONFIG 网站首页自定义
     * WEBSITE_ARTICLE_PAGE_CONFIG 网站新闻栏目自定义
     * WEBSITE_HELP_PAGE_CONFIG 网站帮助页自定义
     * RESOURCE_LEGAL_PERSON_CREDIT_RECORD 法人信用记录
     * RESOURCE_NATURAL_PERSON_CREDIT_RECORD 自然人信用记录
     * RESOURCE_SOCIETY_CREDIT_RECORD 社团组织信用记录
     * RESOURCE_CAUSE_UNIT_CREDIT_RECORD 事业单位信用记录
     * RESOURCE_CREDIT_SUBJECT_STATISTICS 信用记录统计分析
     * RAP_MEMORANDUM 奖惩备忘录
     * RAP_MEASURE 奖惩措施
     * RAP_OBJECT_SEARCH 奖惩对象查询
     * RAP_CASE 奖惩案例
     * RAP_STATISTICS 联合奖惩统计分析
     * MONITOR_FOCUS_MONITOR 信用状况监测管理重点关注
     * MONITOR_OPINION 信用状况监测管理舆情信息
     * COMMITMENT 信用承诺管理
     * COMMITMENT_SEARCH 信用承诺检索
     * COMMITMENT_SUPERVISE 信用承诺监管
     * COMMITMENT_EARLY_WARNING 信用承诺预警
     * COMMITMENT_FILE 信用承诺归档
     * COMMITMENT_EXAMINE 信用承诺审核
     * COMMITMENT_STATISTICS 信用承诺统计
     * INTERACTION_INTERLOCUTION 互动交流-信用问答
     * INTERACTION_FEEDBACK 互动交流-意见反馈
     * INTERACTION_COMPLAINT 互动交流-信用投诉
     * INTERACTION_PRAISE 互动交流-信用表扬
     * INTERACTION_APPEAL 互动交流-异议申诉
     * INTERACTION_STATISTICS 互动交流业务管理统计分析
     * CREDIT_REPORT_COMMON_CONFIG 信用报告自定义
     * CREDIT_REPORT_DOWNLOAD_RECORD 信用报告下载记录
     * CREDIT_REPORT_AUTHORIZE 信用报告授权管理
     * CREDIT_REPORT_APPLICATION_STATISTICS 报告应用统计分析
     * CONTRACT_PERFORMANCE 合同履约管理
     * CONTRACT_PERFORMANCE_SEARCH 合同履约检索
     * CONTRACT_PERFORMANCE_SUPERVISE 合同履约监管
     * CONTRACT_PERFORMANCE_EARLY_WARNING 合同履约预警
     * CONTRACT_PERFORMANCE_STATISTICS 合同履约统计
     * EVALUATION_SCORE_MODEL 信用评价模型管理
     * EVALUATION_INDICATOR 信用评价指标管理
     * EVALUATION_SCENARIO 信用评价场景管理
     * CREDIT_MODULE_INDUSTRY_ORG_EVA 行业数据管理
     * CREDIT_MODULE_FINANCE 金融数据管理
     * CREDIT_MODULE_RESOURCE_DATA 信用+应用管理信用数据管理
     * CREDIT_MODULE_STATISTICS 信用+应用管理统计分析
     * CERTIFICATE_EXAMINE 实名认证审核管理
     * MEMBER_COMMITMENT_EXAMINE 信用承诺申报审核
     * MEMBER_RESOURCE_DATA_EXAMINE 信用信息申报审核
     * MEMBER_COMMITMENT 信用承诺申报查询
     * MEMBER_RESOURCE_DATA 信用信息申报查询
     * SELF_DECLARATION_STATISTICS 自主申报统计分析
     * WORKBENCH 信用大数据统计分析
     */
    const COLUMN = array(
        'ORGANIZATION' => 1, // 委办局管理
        'DEPARTMENT' => 2, // 科室管理
        'ROLE' => 3, //角色管理
        'STAFF' => 4, //员工管理
        'DICTIONARY' => 5, // 字典管理-字典分类管理/字典项管理
        'MEMBER' => 6, //前台用户管理
        'APPLICATION_LOG' => 7, //日志管理
        'ARTICLE_CATEGORY' => 21, //新闻分类管理
        'ARTICLE' => 22, //新闻发布管理
        'ARTICLE_EXAMINE' => 23, //新闻审核管理
        'SENSITIVE_WORD' => 24, //错敏词库管理
        'CMS_STATISTICS' => 25, //内容发布审核管理统计分析
        'RESOURCE_DIRECTORY' => 41, //目录发布管理
        'RESOURCE_DIRECTORY_EXAMINE' => 42, //目录审核管理
        'RESOURCE_DIRECTORY_STATISTICS' => 43, //信用目录自主管理统计分析
        'RESOURCE_DATA' => 51, //信用数据管理
        'RESOURCE_DATA_SEARCH' => 52, //信用数据检索
        'RESOURCE_DATA_FILE' => 53, //信用数据归档
        'RESOURCE_DATA_EXAMINE' => 54, //信用数据审核
        'RESOURCE_DATA_STATISTICS' => 55, //信用信息综合管理统计分析
        'RESOURCE_PUBLICATION' => 71, //十公示数据管理
        'RESOURCE_PUBLICATION_SEARCH' => 72, //十公示数据检索
        'RESOURCE_PUBLICATION_FILE' => 73, //十公示数据归档
        'RESOURCE_PUBLICATION_EXAMINE' => 74, //十公示数据审核
        'RESOURCE_PUBLICATION_STATISTICS' => 75, //十公示统计分析
        'RESOURCE_PUBLICATION_QUALITY_ANALYSIS_STATISTICS' => 76, //十公示数据质量分析
        'RESOURCE_RANDOM' => 81, //抽查检查结果管理
        'RESOURCE_RANDOM_SEARCH' => 82, //抽查检查结果检索
        'RESOURCE_RANDOM_FILE' => 83, //抽查检查结果归档
        'RESOURCE_RANDOM_EXAMINE' => 84, //抽查检查结果审核
        'RESOURCE_RANDOM_STATISTICS' => 85, //抽查检查结果统计分析
        'CIVIL_SERVANT_CREDIT_FILE' => 91, //公务员信用档案
        'DOCTOR_CREDIT_FILE' => 92, //医生信用档案
        'LAWYER_CREDIT_FILE' => 93, //律师信用档案
        'TEACHER_CREDIT_FILE' => 94, //教师信用档案
        'WEBSITE_HOME_PAGE_CONFIG' => 101, //首页自定义
        'WEBSITE_ARTICLE_PAGE_CONFIG' => 102, //新闻栏目自定义
        'WEBSITE_HELP_PAGE_CONFIG' => 103, //静态页面自定义
        'RESOURCE_LEGAL_PERSON_CREDIT_RECORD' => 111, //法人信用记录
        'RESOURCE_NATURAL_PERSON_CREDIT_RECORD' => 112, //自然人信用记录
        'RESOURCE_SOCIETY_CREDIT_RECORD' => 113, //社团组织信用记录
        'RESOURCE_CAUSE_UNIT_CREDIT_RECORD' => 114, //事业单位信用记录
        'RESOURCE_CREDIT_SUBJECT_STATISTICS' => 115, //信用记录统计分析
        'RAP_MEMORANDUM' => 121, //奖惩备忘录管理
        'RAP_MEASURE' => 122, //奖惩措施管理
        'RAP_OBJECT_SEARCH' => 123, //奖惩对象查询
        'RAP_CASE' => 124, //奖惩案例管理
        'RAP_STATISTICS' => 125, //联合奖惩统计分析
        'MONITOR_FOCUS_MONITOR' => 131, //重点监测统计
        'MONITOR_OPINION' => 132, //舆情监测
        'COMMITMENT' => 141, //信用承诺管理
        'COMMITMENT_SEARCH' => 142, //信用承诺检索
        'COMMITMENT_SUPERVISE' => 143, //信用承诺监管
        'COMMITMENT_EARLY_WARNING' => 144, //信用承诺预警
        'COMMITMENT_FILE' => 145, //信用承诺归档
        'COMMITMENT_EXAMINE' => 146, //信用承诺审核
        'COMMITMENT_STATISTICS' => 147, //信用承诺统计
        'INTERACTION_INTERLOCUTION' => 161, //信用问答管理
        'INTERACTION_FEEDBACK' => 162, //意见反馈管理
        'INTERACTION_COMPLAINT' => 163, //信用投诉管理
        'INTERACTION_PRAISE' => 164, //信用表扬管理
        'INTERACTION_APPEAL' => 165, //异议申诉管理
        'INTERACTION_STATISTICS' => 166, //互动交流业务管理统计分析
        'CREDIT_REPORT_COMMON_CONFIG' => 181, //信用报告自定义
        'CREDIT_REPORT_DOWNLOAD_RECORD' => 182, //信用报告下载记录
        'CREDIT_REPORT_AUTHORIZE' => 183, //信用报告授权管理
        'CREDIT_REPORT_APPLICATION_STATISTICS' => 184, //报告应用统计分析
        'CONTRACT_PERFORMANCE' => 191, //合同履约管理
        'CONTRACT_PERFORMANCE_SEARCH' => 192, //合同履约检索
        'CONTRACT_PERFORMANCE_SUPERVISE' => 193, //合同履约监管
        'CONTRACT_PERFORMANCE_EARLY_WARNING' => 194, //合同履约预警
        'CONTRACT_PERFORMANCE_STATISTICS' => 195, //合同履约统计
        'EVALUATION_SCORE_MODEL' => 211, //评分模型定制
        'EVALUATION_INDICATOR' => 212, //评价指标管理
        'EVALUATION_SCENARIO' => 213, //应用场景设置
        'CREDIT_MODULE_INDUSTRY_ORG_EVA' => 221, //行业数据管理
        'CREDIT_MODULE_FINANCE' => 222, //金融数据管理
        'CREDIT_MODULE_RESOURCE_DATA' => 223, //信用+应用管理信用数据管理
        'CREDIT_MODULE_STATISTICS' => 224, //信用+应用管理统计分析
        'CERTIFICATE_EXAMINE' => 241, //实名认证审核管理
        'MEMBER_COMMITMENT_EXAMINE' => 242, //信用承诺申报审核
        'MEMBER_RESOURCE_DATA_EXAMINE' => 243, //信用信息申报审核
        'MEMBER_COMMITMENT' => 244, //信用承诺申报查询
        'MEMBER_RESOURCE_DATA' => 245, //信用信息申报查询
        'SELF_DECLARATION_STATISTICS' => 246, //自主申报统计分析
        'WORKBENCH' => 247, //信用大数据统计分析
    );

    /**
     * 操作
     * 通用操作: add|edit=>1, enable|disable=>2, 4 预留
     */
    const ACTIONS = array(
        self::COLUMN['ORGANIZATION'] => array('add' => 1, 'edit' => 1),
        self::COLUMN['DEPARTMENT'] => array('add' => 1, 'edit' => 1),
        self::COLUMN['ROLE'] => array('add' => 1, 'edit' => 1),
        self::COLUMN['STAFF'] => array('add' => 1, 'edit' => 1, 'enable'=>2, 'disable' => 2, 'resetPassword' => 8),
        self::COLUMN['DICTIONARY'] => array('add' => 1, 'edit' => 1, 'enable'=>2, 'disable' => 2),
        self::COLUMN['MEMBER'] => array('enable'=>2, 'disable' => 2),
        self::COLUMN['APPLICATION_LOG'] => array('export' => 4),
        self::COLUMN['ARTICLE_CATEGORY'] => array('add' => 1, 'edit' => 1),
        self::COLUMN['ARTICLE'] => array(
            'add' => 1, 'edit' => 1, 'enable'=>2, 'disable' => 2, 'top' => 8, 'cancelTop' => 8
        ),
        self::COLUMN['ARTICLE_EXAMINE'] => array('approve' => 8, 'reject' => 8),
        self::COLUMN['SENSITIVE_WORD'] => array('add' => 1, 'edit' => 1, 'enable'=>2, 'disable' => 2),
        self::COLUMN['CMS_STATISTICS'] => array(),
        self::COLUMN['RESOURCE_DIRECTORY'] => array(
            'add' => 1, 'edit' => 1, 'enable'=>2, 'disable' => 2, 'rollback' => 8
        ),
        self::COLUMN['RESOURCE_DIRECTORY_EXAMINE'] => array('approve' => 8, 'reject' => 8),
        self::COLUMN['RESOURCE_DIRECTORY_STATISTICS'] => array(),

        self::COLUMN['RESOURCE_DATA'] => array('add' => 1, 'batchUpload' => 4, 'export' => 4),
        self::COLUMN['RESOURCE_DATA_SEARCH'] => array('export' => 4),
        self::COLUMN['RESOURCE_DATA_FILE'] => array('enable' => 2, 'disable' => 2, 'export' => 4),
        self::COLUMN['RESOURCE_DATA_EXAMINE'] => array('export' => 4, 'approve' => 8, 'reject' => 8),
        self::COLUMN['RESOURCE_DATA_STATISTICS'] => array(),
        self::COLUMN['RESOURCE_PUBLICATION'] => array('add' => 1, 'batchUpload' => 4, 'export' => 4),
        self::COLUMN['RESOURCE_PUBLICATION_SEARCH'] => array('export' => 4),
        self::COLUMN['RESOURCE_PUBLICATION_FILE'] => array('enable' => 2, 'disable' => 2, 'export' => 4),
        self::COLUMN['RESOURCE_PUBLICATION_EXAMINE'] => array('export' => 4, 'approve' => 8, 'reject' => 8),
        self::COLUMN['RESOURCE_PUBLICATION_STATISTICS'] => array(),
        self::COLUMN['RESOURCE_PUBLICATION_QUALITY_ANALYSIS_STATISTICS'] => array(),
        self::COLUMN['RESOURCE_RANDOM'] => array('add' => 1, 'batchUpload' => 4, 'export' => 4),
        self::COLUMN['RESOURCE_RANDOM_SEARCH'] => array('export' => 4),
        self::COLUMN['RESOURCE_RANDOM_FILE'] => array('enable' => 2, 'disable' => 2, 'export' => 4),
        self::COLUMN['RESOURCE_RANDOM_EXAMINE'] => array('export' => 4, 'approve' => 8, 'reject' => 8),
        self::COLUMN['RESOURCE_RANDOM_STATISTICS'] => array(),
        self::COLUMN['CIVIL_SERVANT_CREDIT_FILE'] => array(),
        self::COLUMN['DOCTOR_CREDIT_FILE'] => array(),
        self::COLUMN['LAWYER_CREDIT_FILE'] => array(),
        self::COLUMN['TEACHER_CREDIT_FILE'] => array(),
        self::COLUMN['WEBSITE_HOME_PAGE_CONFIG'] => array('add' => 1, 'publish' => 1),
        self::COLUMN['WEBSITE_ARTICLE_PAGE_CONFIG'] => array('diy' => 8),
        self::COLUMN['WEBSITE_HELP_PAGE_CONFIG'] => array('add' => 1, 'edit' => 1),
        self::COLUMN['RESOURCE_LEGAL_PERSON_CREDIT_RECORD'] => array(),
        self::COLUMN['RESOURCE_NATURAL_PERSON_CREDIT_RECORD'] => array(),
        self::COLUMN['RESOURCE_SOCIETY_CREDIT_RECORD'] => array(),
        self::COLUMN['RESOURCE_CAUSE_UNIT_CREDIT_RECORD'] => array(),
        self::COLUMN['RESOURCE_CREDIT_SUBJECT_STATISTICS'] => array(),
        self::COLUMN['RAP_MEMORANDUM'] => array('add' => 1, 'edit' => 1, 'enable'=>2, 'disable' => 2),
        self::COLUMN['RAP_MEASURE'] => array('add' => 1, 'edit' => 1, 'enable'=>2, 'disable' => 2),
        self::COLUMN['RAP_OBJECT_SEARCH'] => array(),
        self::COLUMN['RAP_CASE'] => array('add' => 1, 'export' => 4),
        self::COLUMN['RAP_STATISTICS'] => array(),
        self::COLUMN['MONITOR_FOCUS_MONITOR'] => array('add' => 1, 'edit' => 1, 'enable'=>2, 'disable' => 2),
        self::COLUMN['MONITOR_OPINION'] => array('add' => 1, 'edit' => 1, 'enable'=>2, 'disable' => 2),
        self::COLUMN['COMMITMENT'] => array('add' => 1, 'edit' => 1, 'batchUpload' => 4, 'export' => 4),
        self::COLUMN['COMMITMENT_SEARCH'] => array('export' => 4),
        self::COLUMN['COMMITMENT_SUPERVISE'] => array('export' => 4, 'superviseDone' => 8),
        self::COLUMN['COMMITMENT_EARLY_WARNING'] => array('export' => 4),
        self::COLUMN['COMMITMENT_FILE'] => array('enable' => 2, 'disable' => 2, 'export' => 4),
        self::COLUMN['COMMITMENT_EXAMINE'] => array('export' => 4, 'approve' => 8, 'reject' => 8),
        self::COLUMN['COMMITMENT_STATISTICS'] => array(),
        self::COLUMN['INTERACTION_INTERLOCUTION'] => array('accept' => 8, 'forward' => 16),
        self::COLUMN['INTERACTION_FEEDBACK'] => array('accept' => 8, 'forward' => 16),
        self::COLUMN['INTERACTION_COMPLAINT'] => array('accept' => 8, 'forward' => 16),
        self::COLUMN['INTERACTION_PRAISE'] => array('accept' => 8, 'forward' => 16),
        self::COLUMN['INTERACTION_APPEAL'] => array('accept' => 8, 'forward' => 16),
        self::COLUMN['INTERACTION_STATISTICS'] => array(),
        self::COLUMN['CREDIT_REPORT_COMMON_CONFIG'] => array('edit' => 1),
        self::COLUMN['CREDIT_REPORT_DOWNLOAD_RECORD'] => array(),
        self::COLUMN['CREDIT_REPORT_AUTHORIZE'] => array('authorize' => 8, 'unAuthorize' => 8),
        self::COLUMN['CREDIT_REPORT_APPLICATION_STATISTICS'] => array(),
        self::COLUMN['CONTRACT_PERFORMANCE'] => array('add' => 1, 'batchUpload' => 4, 'export' => 4),
        self::COLUMN['CONTRACT_PERFORMANCE_SEARCH'] => array('export' => 4),
        self::COLUMN['CONTRACT_PERFORMANCE_SUPERVISE'] => array('export' => 4, 'fulfillment' => 8, 'breach' => 8),
        self::COLUMN['CONTRACT_PERFORMANCE_EARLY_WARNING'] => array('export' => 4, 'ignoreWarning' => 8),
        self::COLUMN['CONTRACT_PERFORMANCE_STATISTICS'] => array(),
        self::COLUMN['EVALUATION_SCORE_MODEL'] => array('add' => 1, 'edit' => 1, 'enable'=>2, 'disable' => 2),
        self::COLUMN['EVALUATION_INDICATOR'] => array('add' => 1, 'edit' => 1, 'enable'=>2, 'disable' => 2),
        self::COLUMN['EVALUATION_SCENARIO'] => array('add' => 1, 'edit' => 1, 'enable'=>2, 'disable' => 2),
        self::COLUMN['CREDIT_MODULE_INDUSTRY_ORG_EVA'] => array('add' => 1, 'edit' => 1, 'enable'=>2, 'disable' => 2),
        self::COLUMN['CREDIT_MODULE_FINANCE'] => array('add' => 1, 'edit' => 1, 'enable'=>2, 'disable' => 2),
        self::COLUMN['CREDIT_MODULE_RESOURCE_DATA'] => array(),
        self::COLUMN['CREDIT_MODULE_STATISTICS'] => array(),
        self::COLUMN['CERTIFICATE_EXAMINE'] => array('approve' => 8, 'reject' => 8),
        self::COLUMN['MEMBER_COMMITMENT_EXAMINE'] => array('approve' => 8, 'reject' => 8),
        self::COLUMN['MEMBER_RESOURCE_DATA_EXAMINE'] => array('approve' => 8, 'reject' => 8),
        self::COLUMN['MEMBER_COMMITMENT'] => array(),
        self::COLUMN['MEMBER_RESOURCE_DATA'] => array(),
        self::COLUMN['SELF_DECLARATION_STATISTICS'] => array(),
        self::COLUMN['WORKBENCH'] => array()
    );

    public function getColumn() : int;
}
