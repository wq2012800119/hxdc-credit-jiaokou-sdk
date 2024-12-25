<?php
namespace Sdk\Application\Commitment\Model;

class CommitmentTemplate
{
    /**
     * 承诺模板字段
     */
    const COMMITMENT_TEMPLATE = array(
        array(
            "name" => "承诺编码",
            "identify" => "code",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 20,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填，按照“行政区划编码（6位，指承诺受理所在地）+年月日（8位，即承诺作出日期）+流水号（6位）”进行编码"
        ),
        array(
            "name" => "承诺人名称",
            "identify" => "subjectName",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 200,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填，填写法人及非法人组织、个体工商户名称或自然人姓名"
        ),
        array(
            "name" => "承诺人类别",
            "identify" => "subjectCategory",
            "dataType" => array("id" => "NA", "name" => "枚举型"),
            "dataLength" => 16,
            "optionalRange" => "法人及非法人组织;自然人;个体工商户",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填，选择“法人及非法人组织”、“个体工商户”、“自然人”中的一项填写"
        ),
        array(
            "name" => "承诺人代码",
            "identify" => "identify",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 18,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填，法人及非法人组织、个体工商户填写统一社会信用代码；自然人填写身份证号码"
        ),
        array(
            "name" => "承诺类型",
            "identify" => "commitmentTypeId",
            "dataType" => array("id" => "NA", "name" => "枚举型"),
            "dataLength" => 64,
            "optionalRange" => "审批替代型;容缺受理型;证明事项型;信用修复型;行业自律型;主动型;其他",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填，选择“审批替代型”、“容缺受理型”、“证明事项型”、“信用修复型”、“行业自律型”、“主动型”、“其他”中的一项填写；如为“其他”，填写具体类型"
        ),
        array(
            "name" => "承诺事由",
            "identify" => "reason",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 512,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填，填写作出信用承诺的事由，即办理的具体业务事项 。如， ①审批替代型， 申请办理 X X 许可证 ； ②容缺受理型 ， 申请办理 X X 政务服务事项 ；③ 证明事项型 ， 申请办理 X X 证明文件； ④信用修复型， 申请在 X X 网站办理行政处罚信息信用修复；⑤行业自律型 ， 参加X X 协会组织的信用承诺活动；⑥主动型，自愿作出承诺等",//phpcs:ignore
        ),
        array(
            "name" => "承诺内容",
            "identify" => "content",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 4000,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填，填写信用承诺书中的主要内容"
        ),
        array(
            "name" => "违诺责任",
            "identify" => "liabilityBreachCommitment",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 4000,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填，填写信用承诺书中载明的不履行信用承诺要承担的主要责任"
        ),
        array(
            "name" => "承诺作出日期",
            "identify" => "commitmentDate",
            "dataType" => array("id" => "MQ", "name" => "日期型"),
            "dataLength" => 0,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填，填写作出信用承诺的具体日期"
        ),
        array(
            "name" => "承诺有效期",
            "identify" => "commitmentValidity",
            "dataType" => array("id" => "MQ", "name" => "日期型"),
            "dataLength" => 0,
            "optionalRange" => "",
            "required" => array("id" => "Lw", "name" => "否"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "选填，填写作出信用承诺的截止日期"
        ),
        array(
            "name" => "承诺履行状态",
            "identify" => "fulfillmentStatus",
            "dataType" => array("id" => "NA", "name" => "枚举型"),
            "dataLength" => 0,
            "optionalRange" => "全部履行;部分履行;全部未履行",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填，选择“全部履行”、“部分履行”、“全部未履行”中的一项填写"
        ),
        array(
            "name" => "未履行的承诺内容",
            "identify" => "unperformedCommitmentContent",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 4000,
            "optionalRange" => "",
            "required" => array("id" => "Lw", "name" => "否"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "承诺履行状态为“全部履行”的不填，承诺履行状态为“部分履行”或“全部未履行”的必填, 填写未履行信用承诺书中承诺的主要内容",//phpcs:ignore
        ),
        array(
            "name" => "违诺责任追究内容",
            "identify" => "liabilityBreachCommitmentContent",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 4000,
            "optionalRange" => "",
            "required" => array("id" => "Lw", "name" => "否"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "承诺履行状态为“全部履行”的不填； 承诺履行状态为＂部分履行”或“全部未履行”的必填，填写不履行信用承诺所受到的处理、处罚、处置以及其他形式的惩罚内容。如，①审批替代型， 撤销 X X 许可证； ②容缺受理型， 取消 X X 审批决定； ③ 证明事项型， 撤销 X X 证明文件； ④信用修复型， X X 行政处罚信息按最长公示期向社会公示，有关违背承诺情况进行通报和公示等",//phpcs:ignore
        ),
        array(
            "name" => "承诺履行状态认定日期",
            "identify" => "fulfillmentStatusDate",
            "dataType" => array("id" => "MQ", "name" => "日期型"),
            "dataLength" => 0,
            "optionalRange" => "",
            "required" => array("id" => "Lw", "name" => "否"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "选填，填写认定信用承诺履行状态的具体日期"
        ),
        array(
            "name" => "承诺履行状态认定单位",
            "identify" => "acceptanceConfirmUnit",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 200,
            "optionalRange" => "",
            "required" => array("id" => "Lw", "name" => "否"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "选填，填写信用承诺履行状态认定单位名称"
        ),
        array(
            "name" => "承诺履行状态认定单位代码",
            "identify" => "acceptanceConfirmUnitIdentify",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 18,
            "optionalRange" => "",
            "required" => array("id" => "Lw", "name" => "否"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "选填，填写信用承诺履行状态认定单位统一社会信用代码"
        ),
        array(
            "name" => "承诺受理单位",
            "identify" => "acceptanceUnit",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 200,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填，填写信用承诺书受理单位名称"
        ),
        array(
            "name" => "承诺受理单位代码",
            "identify" => "acceptanceUnitIdentify",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 18,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填，填写信用承诺书受理单位统一社会信用代码"
        ),
        array(
            "name" => "公开类型",
            "identify" => "publicationType",
            "dataType" => array("id" => "NA", "name" => "枚举型"),
            "dataLength" => 0,
            "optionalRange" => "可向社会公开;特定范围内公开;不可公开",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填，选择“可向社会公开”、“特定范围内公开”、“不可公开”中的一项填写"
        ),
        array(
            "name" => "备注",
            "identify" => "remarks",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 512,
            "optionalRange" => "",
            "required" => array("id" => "Lw", "name" => "否"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "选填，填写其他需要补充说明的信息"
        ),
        // array(
        //     "name" => "承诺监管状态",
        //     "identify" => "superviseStatus",
        //     "dataType" => array("id" => "NA", "name" => "枚举型"),
        //     "dataLength" => 0,
        //     "optionalRange" => "监管中;监管完成",
        //     "required" => array("id" => "MA", "name" => "是"),
        //     "desensitization" => array("id" => "Lw", "name" => "否"),
        //     "desensitizationRule" =>[0, 0],
        //     "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
        //     "remarks" => "必填，选择“监管中”、“监管完成”中的一项填写"
        // ),
    );
}
