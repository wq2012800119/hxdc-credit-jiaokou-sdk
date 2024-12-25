<?php
namespace Sdk\Log\ApplicationLog\Model;

use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;

class ApplicationLog implements IObject
{
    use Object;

    /**
     * 用户类型
     * PORTAL 门户
     * OA OA
     */
    const OPERATOR_CATEGORY = array(
        'PORTAL' => 1,
        'OA' => 2
    );

    const OPERATOR_CATEGORY_CN = array(
        self::OPERATOR_CATEGORY['PORTAL'] => '门户',
        self::OPERATOR_CATEGORY['OA'] => 'OA'
    );
    /**
    * 日志所属类型
        * SYSTEM => 0 系统
        * ORGANIZATION => 110 委办局
        * DEPARTMENT => 120 科室
        * ROLE => 210 角色
        * STAFF => 220 员工
        * MEMBER => 230 前台用户
        * ENTERPRISE_CERTIFICATE => 231 用户企业认证
        * NATURAL_PERSON_CERTIFICATE => 232 用户个人认证
        * MEMBER_COMMITMENT => 233 信用承诺自主申报
        * MEMBER_RESOURCE_DATA => 234 信用数据自主申报
        * DICTIONARY_CATEGORY => 310 字典分类
        * DICTIONARY_ITEM => 320 字典项
        * DIY_HELP_PAGE => 330 帮助页面自定义
        * DIY_HOME_PAGE => 340 网站首页自定义
        * DIY_COMMON_CONFIG => 350 未定义通用自定义
        * DIY_COMMON_CONFIG_CREDIT_REPORT_ENTERPRISE => 351 企业信用报告自定义
        * DIY_COMMON_CONFIG_CREDIT_REPORT_NATURAL_PERSON => 352 自然人信用报告自定义
        * ARTICLE_CATEGORY => 410 新闻分类
        * ARTICLE => 420 新闻
        * SENSITIVE_WORD => 430 敏感词
        * RESOURCE_DIRECTORY => 610 信用目录
        * RESOURCE_DATA => 620 信用数据
        * SPECIFIC_NATURAL_PERSON => 621 自然人数据
        * SPECIFIC_ENTERPRISE => 622 企业数据
        * UPLOAD_DATA_TASK => 623 信用数据上传任务
        * EXPORT_DATA_TASK => 624 信用数据导出任务
        * INTERACTION_APPEAL => 710 异议申诉
        * INTERACTION_COMPLAINT => 711 信用投诉
        * INTERACTION_FEEDBACK => 712 意见反馈
        * INTERACTION_INTERLOCUTION => 713 信用问答
        * INTERACTION_PRAISE => 714 信用表扬
        * COMMITMENT => 810 信用承诺
        * PROMISE => 811 履约践诺
        * RAP_MEMORANDUM => 910 联合奖惩备忘录
        * RAP_CASE => 911 联合奖惩案例
        * RAP_MEASURE => 912 联合奖惩措施
        * CONTRACT_PERFORMANCE => 1010 合同信息
        * BREACH_INFO => 1011 违约信息
        * FULFILLMENT_INFO => 1012 履约信息
        * EVALUATION_INDICATOR => 1110 信用评价指标
        * EVALUATION_SCORE_MODEL => 1111 信用评价模型
        * EVALUATION_SCENARIO => 1112 信用评价场景
        * CM_INDUSTRYORGEVA => 1210 信用+行业组织评价信息
        * CM_COLLATERAL =>  1211 信用+动产抵押信息
        * CM_TAXATION => 1212 信用+税务信息
        * CM_FINANCING => 1213 信用+融资信息
        * CM_COPYRIGHT => 1214 信用+著作权信息
        * CM_SOFTWARERIGHT => 1215 信用+软著信息
        * CM_CERTIFICATION => 1216 信用+证书信息
        * CREDIT_MONITOR_OPINION => 1310 舆情信息
        * CREDIT_MONITOR_FOCUS_MONITOR => 1311 重点监控
    */
    const TARGET_CATEGORY = array(
        'SYSTEM' => 0,
        'ORGANIZATION' => 110,
        'DEPARTMENT' => 120,
        'ROLE' => 210,
        'STAFF' => 220,
        'MEMBER' => 230,
        'ENTERPRISE_CERTIFICATE' => 231,
        'NATURAL_PERSON_CERTIFICATE' => 232,
        'MEMBER_COMMITMENT' => 233,
        'MEMBER_RESOURCE_DATA' => 234,
        'DICTIONARY_CATEGORY' => 310,
        'DICTIONARY_ITEM' => 320,
        'DIY_HELP_PAGE' => 330,
        'DIY_HOME_PAGE' => 340,
        'DIY_COMMON_CONFIG' => 350,
        'DIY_COMMON_CONFIG_CREDIT_REPORT_ENTERPRISE' => 351,
        'DIY_COMMON_CONFIG_CREDIT_REPORT_NATURAL_PERSON' => 352,
        'ARTICLE_CATEGORY' => 410,
        'ARTICLE' => 420,
        'SENSITIVE_WORD' => 430,
        'RESOURCE_DIRECTORY' => 610,
        'RESOURCE_DATA' => 620,
        'SPECIFIC_NATURAL_PERSON' => 621,
        'SPECIFIC_ENTERPRISE' => 622,
        'UPLOAD_DATA_TASK' => 623,
        'EXPORT_DATA_TASK' => 624,
        'INTERACTION_APPEAL' => 710,
        'INTERACTION_COMPLAINT' => 711,
        'INTERACTION_FEEDBACK' => 712,
        'INTERACTION_INTERLOCUTION' => 713,
        'INTERACTION_PRAISE' => 714,
        'COMMITMENT' => 810,
        'PROMISE' => 811,
        'RAP_MEMORANDUM' => 910,
        'RAP_CASE' => 911,
        'RAP_MEASURE' => 912,
        'CONTRACT_PERFORMANCE' => 1010,
        'BREACH_INFO' => 1011,
        'FULFILLMENT_INFO' => 1012,
        'EVALUATION_INDICATOR' => 1110,
        'EVALUATION_SCORE_MODEL' => 1111,
        'EVALUATION_SCENARIO' => 1112,
        'CM_INDUSTRYORGEVA' => 1210,
        'CM_COLLATERAL' => 1211,
        'CM_TAXATION' => 1212,
        'CM_FINANCING' => 1213,
        'CM_COPYRIGHT' => 1214,
        'CM_SOFTWARERIGHT' => 1215,
        'CM_CERTIFICATION' => 1216,
        'CREDIT_MONITOR_OPINION' => 1310,
        'CREDIT_MONITOR_FOCUS_MONITOR' => 1311,
    );

    const TARGET_CATEGORY_CN = array(
        self::TARGET_CATEGORY['SYSTEM'] => '系统',
        self::TARGET_CATEGORY['ORGANIZATION'] => '委办局',
        self::TARGET_CATEGORY['DEPARTMENT'] => '科室',
        self::TARGET_CATEGORY['ROLE'] => '角色',
        self::TARGET_CATEGORY['STAFF'] => '员工',
        self::TARGET_CATEGORY['MEMBER'] => '前台用户',
        self::TARGET_CATEGORY['ENTERPRISE_CERTIFICATE'] => '用户企业认证',
        self::TARGET_CATEGORY['NATURAL_PERSON_CERTIFICATE'] => '用户个人认证',
        self::TARGET_CATEGORY['MEMBER_COMMITMENT'] => '信用承诺自主申报',
        self::TARGET_CATEGORY['MEMBER_RESOURCE_DATA'] => '信用数据自主申报',
        self::TARGET_CATEGORY['DICTIONARY_CATEGORY'] => '字典分类',
        self::TARGET_CATEGORY['DICTIONARY_ITEM'] => '字典项',
        self::TARGET_CATEGORY['DIY_HELP_PAGE'] => '帮助页面自定义',
        self::TARGET_CATEGORY['DIY_HOME_PAGE'] => '网站首页自定义',
        self::TARGET_CATEGORY['DIY_COMMON_CONFIG'] => '未定义通用自定义',
        self::TARGET_CATEGORY['DIY_COMMON_CONFIG_CREDIT_REPORT_ENTERPRISE'] => '企业信用报告自定义',
        self::TARGET_CATEGORY['DIY_COMMON_CONFIG_CREDIT_REPORT_NATURAL_PERSON'] => '自然人信用报告自定义',
        self::TARGET_CATEGORY['ARTICLE_CATEGORY'] => '新闻分类',
        self::TARGET_CATEGORY['ARTICLE'] => '新闻',
        self::TARGET_CATEGORY['SENSITIVE_WORD'] => '敏感词',
        self::TARGET_CATEGORY['RESOURCE_DIRECTORY'] => '信用目录',
        self::TARGET_CATEGORY['RESOURCE_DATA'] => '信用数据',
        self::TARGET_CATEGORY['SPECIFIC_NATURAL_PERSON'] => '自然人数据',
        self::TARGET_CATEGORY['SPECIFIC_ENTERPRISE'] => '企业数据',
        self::TARGET_CATEGORY['UPLOAD_DATA_TASK'] => '信用数据上传任务',
        self::TARGET_CATEGORY['EXPORT_DATA_TASK'] => '信用数据导出任务',
        self::TARGET_CATEGORY['INTERACTION_APPEAL'] => '异议申诉',
        self::TARGET_CATEGORY['INTERACTION_COMPLAINT'] => '信用投诉',
        self::TARGET_CATEGORY['INTERACTION_FEEDBACK'] => '意见反馈',
        self::TARGET_CATEGORY['INTERACTION_INTERLOCUTION'] => '信用问答',
        self::TARGET_CATEGORY['INTERACTION_PRAISE'] => '信用表扬',
        self::TARGET_CATEGORY['COMMITMENT'] => '信用承诺',
        self::TARGET_CATEGORY['PROMISE'] => '履约践诺',
        self::TARGET_CATEGORY['RAP_MEMORANDUM'] => '联合奖惩备忘录',
        self::TARGET_CATEGORY['RAP_CASE'] => '联合奖惩案例',
        self::TARGET_CATEGORY['RAP_MEASURE'] => '联合奖惩措施',
        self::TARGET_CATEGORY['CONTRACT_PERFORMANCE'] => '合同信息',
        self::TARGET_CATEGORY['BREACH_INFO'] => '违约信息',
        self::TARGET_CATEGORY['FULFILLMENT_INFO'] => '履约信息',
        self::TARGET_CATEGORY['EVALUATION_INDICATOR'] => '信用评价指标',
        self::TARGET_CATEGORY['EVALUATION_SCORE_MODEL'] => '信用评价模型',
        self::TARGET_CATEGORY['EVALUATION_SCENARIO'] => '信用评价场景',
        self::TARGET_CATEGORY['CM_INDUSTRYORGEVA'] => '信用+行业组织评价信息',
        self::TARGET_CATEGORY['CM_COLLATERAL'] => '信用+动产抵押信息',
        self::TARGET_CATEGORY['CM_TAXATION'] => '信用+税务信息',
        self::TARGET_CATEGORY['CM_FINANCING'] => '信用+融资信息',
        self::TARGET_CATEGORY['CM_COPYRIGHT'] => '信用+著作权信息',
        self::TARGET_CATEGORY['CM_SOFTWARERIGHT'] => '信用+软著信息',
        self::TARGET_CATEGORY['CM_CERTIFICATION'] => '信用+证书信息',
        self::TARGET_CATEGORY['CREDIT_MONITOR_OPINION'] => '舆情信息',
        self::TARGET_CATEGORY['CREDIT_MONITOR_FOCUS_MONITOR'] => '重点监控'
    );

    /**
     * 日志对应动作
        * VIEW => 0, //查看
        * INSERT => 10, //新增
        * UPDATE => 20, //编辑
        * TOP => 30, //置顶
        * CANCEL_TOP => 31, //取消置顶
        * APPROVE => 40, //审核通过
        * REJECT => 41, //审核驳回
        * ENABLE => 50, //启用
        * DISABLE => 51, //禁用
        * PUBLISH => 60, //发布
        * AUTHENTICATE => 61, //认证
        * REAUTHENTICATE => 62, //重新认证
        * AUTHORIZE => 63, //授权
        * UNAUTHORIZE => 64, //取消授权
        * UPLOAD => 65, //上传
        * EXPORT => 66, //导出
        * ACCEPT => 70, //受理
        * REVOKE => 71, //撤销
        * ROLLBACK => 72, //回滚
        * IGNORE => 73, //忽略
        * FORWARD => 74, //转交
        * UPDATE_PASSWORD => 101, //修改密码
        * RESET_PASSWORD => 102, //重置密码
        * UPDATE_SECURITY_QUESTION => 103, //设定安全问题
        * VALIDATE_SECURITY_ANSWER => 104, //验证安全问题
        * LOGIN => 105, //登录
        * SUPERVISE_DONE => 106, //完成监管
        * SUPERVIESE_DOING => 107, //监管中
        * EDIT_DIY => 108, //修改自定义设置
     */
    const TARGET_ACTION = array(
        'VIEW' => 0,
        'INSERT' => 10,
        'UPDATE' => 20,
        'TOP' => 30,
        'CANCEL_TOP' => 31,
        'APPROVE' => 40,
        'REJECT' => 41,
        'ENABLE' => 50,
        'DISABLE' => 51,
        'PUBLISH' => 60,
        'AUTHENTICATE' => 61,
        'REAUTHENTICATE' => 62,
        'AUTHORIZE' => 63,
        'UNAUTHORIZE' => 64,
        'UPLOAD' => 65,
        'EXPORT' => 66,
        'ACCEPT' => 70,
        'REVOKE' => 71,
        'ROLLBACK' => 72,
        'IGNORE' => 73,
        'FORWARD' => 74,
        'UPDATE_PASSWORD' => 101,
        'RESET_PASSWORD' => 102,
        'UPDATE_SECURITY_QUESTION' => 103,
        'VALIDATE_SECURITY_ANSWER' => 104,
        'LOGIN' => 105,
        'SUPERVISE_DONE' => 106,
        'SUPERVIESE_DOING' => 107,
        'EDIT_DIY' => 108
    );

    const TARGET_ACTION_CN = array(
        self::TARGET_ACTION['VIEW'] => '查看',
        self::TARGET_ACTION['INSERT'] => '新增',
        self::TARGET_ACTION['UPDATE'] => '编辑',
        self::TARGET_ACTION['TOP'] => '置顶',
        self::TARGET_ACTION['CANCEL_TOP'] => '取消置顶',
        self::TARGET_ACTION['APPROVE'] => '审核通过',
        self::TARGET_ACTION['REJECT'] => '审核驳回',
        self::TARGET_ACTION['ENABLE'] => '启用',
        self::TARGET_ACTION['DISABLE'] => '禁用',
        self::TARGET_ACTION['PUBLISH'] => '发布',
        self::TARGET_ACTION['AUTHENTICATE'] => '认证',
        self::TARGET_ACTION['REAUTHENTICATE'] => '重新认证',
        self::TARGET_ACTION['AUTHORIZE'] => '授权',
        self::TARGET_ACTION['UNAUTHORIZE'] => '取消授权',
        self::TARGET_ACTION['UPLOAD'] => '上传',
        self::TARGET_ACTION['EXPORT'] => '导出',
        self::TARGET_ACTION['ACCEPT'] => '受理',
        self::TARGET_ACTION['REVOKE'] => '撤销',
        self::TARGET_ACTION['ROLLBACK'] => '回滚',
        self::TARGET_ACTION['IGNORE'] => '忽略',
        self::TARGET_ACTION['FORWARD'] => '转交',
        self::TARGET_ACTION['UPDATE_PASSWORD'] => '修改密码',
        self::TARGET_ACTION['RESET_PASSWORD'] => '重置密码',
        self::TARGET_ACTION['UPDATE_SECURITY_QUESTION'] => '设定安全问题',
        self::TARGET_ACTION['VALIDATE_SECURITY_ANSWER'] => '验证安全问题',
        self::TARGET_ACTION['LOGIN'] => '登录',
        self::TARGET_ACTION['SUPERVISE_DONE'] => '完成监管',
        self::TARGET_ACTION['SUPERVIESE_DOING'] => '监管中',
        self::TARGET_ACTION['EDIT_DIY'] => '修改自定义设置'
    );

    private $id;
    /**
     * @var int $operatorId 日志所属用户id
     */
    private $operatorId;
    /**
     * @var string $operatorIdentify 日志所属用户标识
     */
    private $operatorIdentify;
    /**
     * @var int $operatorCategory 用户类型
     */
    private $operatorCategory;
    /**
     * @var int $targetCategory 日志所属类型
     */
    private $targetCategory;
    /**
     * @var int $targetAction 日志对应动作
     */
    private $targetAction;
    /**
     * @var int $targetId 操作目标id
     */
    private $targetId;
    /**
     * @var string $targetName 操作目标名称
     */
    private $targetName;
    /**
     * @var string $description 描述
     */
    private $description;
    /**
     * @var int $errorId 错误id
     */
    private $errorId;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->operatorId = 0;
        $this->operatorIdentify = '';
        $this->operatorCategory = 0;
        $this->targetCategory = 0;
        $this->targetAction = 0;
        $this->targetId = 0;
        $this->targetName = '';
        $this->description = '';
        $this->errorId = 0;
        $this->status = 0;
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->operatorId);
        unset($this->operatorIdentify);
        unset($this->operatorCategory);
        unset($this->targetCategory);
        unset($this->targetAction);
        unset($this->targetId);
        unset($this->targetName);
        unset($this->description);
        unset($this->errorId);
        unset($this->status);
        unset($this->createTime);
        unset($this->updateTime);
        unset($this->statusTime);
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setOperatorId(int $operatorId): void
    {
        $this->operatorId = $operatorId;
    }

    public function getOperatorId(): int
    {
        return $this->operatorId;
    }

    public function setOperatorIdentify(string $operatorIdentify): void
    {
        $this->operatorIdentify = $operatorIdentify;
    }

    public function getOperatorIdentify(): string
    {
        return $this->operatorIdentify;
    }

    public function setOperatorCategory(int $operatorCategory): void
    {
        $this->operatorCategory = $operatorCategory;
    }

    public function getOperatorCategory(): int
    {
        return $this->operatorCategory;
    }

    public function setTargetCategory(int $targetCategory): void
    {
        $this->targetCategory = $targetCategory;
    }

    public function getTargetCategory(): int
    {
        return $this->targetCategory;
    }

    public function setTargetAction(int $targetAction): void
    {
        $this->targetAction = $targetAction;
    }

    public function getTargetAction(): int
    {
        return $this->targetAction;
    }

    public function setTargetId(int $targetId): void
    {
        $this->targetId = $targetId;
    }

    public function getTargetId(): int
    {
        return $this->targetId;
    }

    public function setTargetName(string $targetName): void
    {
        $this->targetName = $targetName;
    }

    public function getTargetName(): string
    {
        return $this->targetName;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setErrorId(int $errorId): void
    {
        $this->errorId = $errorId;
    }

    public function getErrorId(): int
    {
        return $this->errorId;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}
