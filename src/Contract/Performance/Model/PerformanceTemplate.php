<?php
namespace Sdk\Contract\Performance\Model;

class PerformanceTemplate
{
    /**
     * 合同履约模板字段
     */
    const CONTRACT_PERFORMANCE_TEMPLATE = array(
        array(
            "name" => "合同编号",
            "identify" => "htbh",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 100,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "合同名称",
            "identify" => "htmc",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 200,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "合同类型",
            "identify" => "htlx",
            "dataType" => array("id" => "NA", "name" => "枚举型"),
            "dataLength" => 16,
            "optionalRange" => "行政合同;市场化合同",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填，选择“行政合同”、“市场化合同”中的一项填写"
        ),
        array(
            "name" => "项目编号",
            "identify" => "xmbh",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 100,
            "optionalRange" => "",
            "required" => array("id" => "Lw", "name" => "否"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "选填"
        ),
        array(
            "name" => "采购人（甲方）",
            "identify" => "cgr",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 200,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "甲方主体统一社会信用代码",
            "identify" => "jfzttyshxydm",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 18,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "采购人地址",
            "identify" => "cgrdz",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 200,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "供应商（乙方）",
            "identify" => "gys",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 200,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "乙方统一社会信用代码",
            "identify" => "yftyshxydm",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 18,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "供应商地址",
            "identify" => "gysdz",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 200,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "供应商联系方式",
            "identify" => "gyslxfs",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 11,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "主要标的名称",
            "identify" => "zybdmc",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 200,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "规格型号（或服务要求）",
            "identify" => "ggxh",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 200,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "主要标的数量",
            "identify" => "zybdsl",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 200,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "主要标的单价",
            "identify" => "zybddj",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 10,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "合同金额（万元）",
            "identify" => "HTJE",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 10,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "履约期限",
            "identify" => "lyqx",
            "dataType" => array("id" => "MQ", "name" => "日期型"),
            "dataLength" => 0,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "签证地点",
            "identify" => "qzdd",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 200,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "采购方式",
            "identify" => "cgfs",
            "dataType" => array("id" => "NA", "name" => "枚举型"),
            "dataLength" => 64,
            "optionalRange" => "间接采购;现货采购;直接采购;远期合同采购;招标采购;分散采购;网上采购;集中采购",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填，选择“间接采购”、“现货采购”、“直接采购”、“远期合同采购”、“招标采购”、“分散采购”、“网上采购”、“集中采购”中的一项填写",//phpcs:ignore
        ),
        array(
            "name" => "合同签订日期",
            "identify" => "htqdrq",
            "dataType" => array("id" => "MQ", "name" => "日期型"),
            "dataLength" => 0,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "合同公告日期",
            "identify" => "htggrq",
            "dataType" => array("id" => "MQ", "name" => "日期型"),
            "dataLength" => 0,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "其他补充事宜",
            "identify" => "qtbcsy",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 500,
            "optionalRange" => "",
            "required" => array("id" => "Lw", "name" => "否"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "选填"
        ),
        array(
            "name" => "履约状态",
            "identify" => "lyzt",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 100,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "所属区域",
            "identify" => "ssqy",
            "dataType" => array("id" => "MA", "name" => "字符型"),
            "dataLength" => 100,
            "optionalRange" => "",
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填"
        ),
        array(
            "name" => "所属行业",
            "identify" => "sshy",
            "dataType" => array("id" => "NA", "name" => "枚举型"),
            "dataLength" => 64,
            "optionalRange" => "机构组织;农林牧渔;建筑建材;冶金矿产;石油化工;水利水电;交通运输;信息产业;机械机电;轻工食品;服装纺织;专业服务;安全防护;环保绿化;旅游休闲;办公文教;电子电工;玩具礼品;家居用品;物资;包装;体育;办公",//phpcs:ignore
            "required" => array("id" => "MA", "name" => "是"),
            "desensitization" => array("id" => "Lw", "name" => "否"),
            "desensitizationRule" =>[0, 0],
            "publicationRange" => array("id" => "MQ", "name" => "政务共享"),
            "remarks" => "必填，选择“机构组织”、“农林牧渔”、“建筑建材”、“冶金矿产”、“石油化工”、“水利水电”、“交通运输”、“信息产业”、“机械机电”、“轻工食品”、“服装纺织”、“专业服务”、“安全防护”、“环保绿化”、“旅游休闲”、“办公文教”、“电子电工”、“玩具礼品”、“家居用品”、“物资”、“包装”、“体育”、“办公”中的一项填写",//phpcs:ignore
        )
    );
}
