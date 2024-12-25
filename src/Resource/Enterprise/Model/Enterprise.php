<?php
namespace Sdk\Resource\Enterprise\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;

use Sdk\Resource\Data\Model\Data;

use Sdk\Resource\Enterprise\Repository\EnterpriseRepository;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.ShortVariable)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 *
 */
class Enterprise implements IObject
{
    use Object;

     /**
     * 主体类别
     * QYFR 企业法人
     * JGFR 机关法人
     * SYDWFR 事业单位法人
     * SHTTFR 社会团体法人
     * QTFR 其他法人
     * GTGSH 个体工商户
     * QTZZ 其他组织
     */
    const ZTLB = array(
        'QYFR' => '01',
        'JGFR' => '02',
        'SYDWFR' => '03',
        'SHTTFR' => '04',
        'QTFR' => '97',
        'GTGSH' => '98',
        'QTZZ' => '99'
    );

    const ZTLB_CN = array(
        self::ZTLB['QYFR'] => '企业法人',
        self::ZTLB['JGFR'] => '机关法人',
        self::ZTLB['SYDWFR'] => '事业单位法人',
        self::ZTLB['SHTTFR'] => '社会团体法人',
        self::ZTLB['QTFR'] => '其他法人',
        self::ZTLB['GTGSH'] => '个体工商户',
        self::ZTLB['QTZZ'] => '其他组织'
    );
    
    /**
     * 经营状态
     * CXZYKYZC 存续(在营、开业、在册)
     * DXWZX 吊销，未注销
     * DXYZC 吊销，已注销
     * ZX 注销
     * CX 撤销
     * QC 迁出
     * QT 其他
     */
    const JYZT = array(
        'CXZYKYZC' => 1,
        'DXWZX' => 2,
        'DXYZC' => 3,
        'ZX' => 4,
        'CX' => 5,
        'QC' => 6,
        'QT' => 9
    );

    const JYZT_CN = array(
        self::JYZT['CXZYKYZC'] => '存续(在营、开业、在册)',
        self::JYZT['DXWZX'] => '吊销，未注销',
        self::JYZT['DXYZC'] => '吊销，已注销',
        self::JYZT['ZX'] => '注销',
        self::JYZT['CX'] => '撤销',
        self::JYZT['QC'] => '迁出',
        self::JYZT['QT'] => '其他'
    );

    /**
     * 行业代码
     * A 农、林、牧、渔业
     * B 采矿业
     * C 制造业
     * D 电力、热力、燃气及水生产和供应业
     * E 建筑业
     * F 批发和零售业
     * G 交通运输、仓储和邮政业
     * H 住宿和餐饮业
     * I 信息传输、软件和信息技术服务业
     * J 金融业
     * K 房地产业
     * L 租赁和商务服务业
     * M 科学研究和技术服务业
     * N 水利、环境和公共设施管理业
     * O 居民服务、修理和其他服务业
     * P 教育
     * Q 卫生和社会工作
     * R 文化、体育和娱乐业
     * S 公共管理、社会保障和社会组织
     * T 国际组织
     */
    const HYDM = array(
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
        'E' => 'E',
        'F' => 'F',
        'G' => 'G',
        'H' => 'H',
        'I' => 'I',
        'J' => 'J',
        'K' => 'K',
        'L' => 'L',
        'M' => 'M',
        'N' => 'N',
        'O' => 'O',
        'P' => 'P',
        'Q' => 'Q',
        'R' => 'R',
        'S' => 'S',
        'T' => 'T',
    );

    const HYDM_CN = array(
        self::HYDM['A'] => '农、林、牧、渔业',
        self::HYDM['B'] => '采矿业',
        self::HYDM['C'] => '制造业',
        self::HYDM['D'] => '电力、热力、燃气及水生产和供应业',
        self::HYDM['E'] => '建筑业',
        self::HYDM['F'] => '批发和零售业',
        self::HYDM['G'] => '交通运输、仓储和邮政业',
        self::HYDM['H'] => '住宿和餐饮业',
        self::HYDM['I'] => '信息传输、软件和信息技术服务业',
        self::HYDM['J'] => '金融业',
        self::HYDM['K'] => '房地产业',
        self::HYDM['L'] => '租赁和商务服务业',
        self::HYDM['M'] => '科学研究和技术服务业',
        self::HYDM['N'] => '水利、环境和公共设施管理业',
        self::HYDM['O'] => '居民服务、修理和其他服务业',
        self::HYDM['P'] => '教育',
        self::HYDM['Q'] => '卫生和社会工作',
        self::HYDM['R'] => '文化、体育和娱乐业',
        self::HYDM['S'] => '公共管理、社会保障和社会组织',
        self::HYDM['T'] => '国际组织',
    );

    /**
     * 法定代表人证件类型
     * 111 居民身份证
     * 112 临时居民身份证
     * 113 户口簿
     * 114 中国人民解放军军官证
     * 115 中国人民武装警察部队警官证
     * 117 出生医学证明
     * 118 中国人民解放军士兵证
     * 119 中国人民武装警察部队士兵证
     * 120 中国人民解放军文职人员证
     * 122 中国人民武装警察部队文职人员证
     * 154 居住证
     * 411 外交护照
     * 412 公务护照
     * 413 公务普通护照
     * 414 普通护照
     * 415 旅行证
     */

    const FDDBRZJLX = array(
        'JMSFZ' => 111,
        'LSJMSFZ' => 112,
        'HKB' => 113,
        'ZGRMJFJJGZ' => 114,
        'ZGRMWZJCBDJGZ' => 115,
        'CSYXZM' => 117,
        'ZGRMJFJSBZ' => 118,
        'ZGRMWZJCBDSBZ' => 119,
        'ZGRMJFJWZRYZ' => 120,
        'ZGRMWZJCBDWZRYZ' => 122,
        'JZZ' => 154,
        'WJHZ' => 411,
        'GWHZ' => 412,
        'GWPTHZ' => 413,
        'PTHZ' => 414,
        'LXZ' => 415
    );

    const FDDBRZJLX_CN = array(
        self::FDDBRZJLX['JMSFZ'] => '居民身份证',
        self::FDDBRZJLX['LSJMSFZ'] => '临时居民身份证',
        self::FDDBRZJLX['HKB'] => '户口簿',
        self::FDDBRZJLX['ZGRMJFJJGZ'] => '中国人民解放军军官证',
        self::FDDBRZJLX['ZGRMWZJCBDJGZ'] => '中国人民武装警察部队警官证',
        self::FDDBRZJLX['CSYXZM'] => '出生医学证明',
        self::FDDBRZJLX['ZGRMJFJSBZ'] => '中国人民解放军士兵证',
        self::FDDBRZJLX['ZGRMWZJCBDSBZ'] => '中国人民武装警察部队士兵证',
        self::FDDBRZJLX['ZGRMJFJWZRYZ'] => '中国人民解放军文职人员证',
        self::FDDBRZJLX['ZGRMWZJCBDWZRYZ'] => '中国人民武装警察部队文职人员证',
        self::FDDBRZJLX['JZZ'] => '居住证',
        self::FDDBRZJLX['WJHZ'] => '外交护照',
        self::FDDBRZJLX['GWHZ'] => '公务护照',
        self::FDDBRZJLX['GWPTHZ'] => '公务普通护照',
        self::FDDBRZJLX['PTHZ'] => '普通护照',
        self::FDDBRZJLX['LXZ'] => '旅行证'
    );

    /**
     * 企业类型
     */
    const LX_CN = array(
        1100 => '有限责任公司',
        1110 => '有限责任公司(国有独资)',
        1120 => '有限责任公司(外商投资企业投资)',
        1121 => '有限责任公司(外商投资企业合资)',
        1122 => '有限责任公司(外商投资企业与内资合资)',
        1123 => '有限责任公司(外商投资企业法人独资)',
        1130 => '有限责任公司(自然人投资或控股)',
        1140 => '有限责任公司(国有控股)',
        1150 => '一人有限责任公司',
        1151 => '有限责任公司(自然人独资)',
        1152 => '有限责任公司(自然人投资或控股的法人独资)',
        1153 => '有限责任公司(非自然人投资或控股的法人独资)',
        1190 => '其他有限责任公司',
        1200 => '股份有限公司',
        1210 => '股份有限公司(上市)',
        1211 => '股份有限公司(上市、外商投资企业投资)',
        1212 => '股份有限公司(上市、自然人投资或控股)',
        1213 => '股份有限公司(上市、国有控股)',
        1219 => '其他股份有限公司(上市)',
        1220 => '股份有限公司(非上市)',
        1221 => '股份有限公司(非上市、外商投资企业投资)',
        1222 => '股份有限公司(非上市、自然人投资或控股)',
        1223 => '股份有限公司(非上市、国有控股)',
        1229 => '其他股份有限公司(非上市)',
        2100 => '有限责任公司分公司',
        2110 => '有限责任公司分公司(国有独资)',
        2120 => '有限责任公司分公司(外商投资企业投资)',
        2121 => '有限责任公司分公司(外商投资企业合资)',
        2122 => '有限责任公司分公司(外商投资企业与内资合资)',
        2123 => '有限责任公司分公司(外商投资企业法人独资)',
        2130 => '有限责任公司分公司(自然人投资或控股)',
        2140 => '有限责任公司分公司(国有控股)',
        2150 => '一人有限责任公司分公司',
        2151 => '有限责任公司分公司(自然人独资)',
        2152 => '有限责任公司分公司(自然人投资或控股的法人独资)',
        2153 => '有限责任公司分公司(非自然人投资或控股的法人独资）',
        2190 => '其他有限责任公司分公司',
        2200 => '股份有限公司分公司',
        2210 => '股份有限公司分公司(上市)',
        2211 => '股份有限公司分公司(上市、外商投资企业投资)',
        2212 => '股份有限公司分公司(上市、自然人投资或控股)',
        2213 => '股份有限公司分公司(上市、国有控股)',
        2219 => '其他股份有限公司分公司(上市)',
        2220 => '股份有限公司分公司(非上市)',
        2221 => '股份有限公司分公司(非上市、外商投资企业投资)',
        2222 => '股份有限公司分公司(非上市、自然人投资或控股)',
        2223 => '股份有限公司分公司(国有控股)',
        2229 => '其他股份有限公司分公司(非上市)',
        3100 => '全民所有制',
        3200 => '集体所有制',
        3300 => '股份制',
        3400 => '股份合作制',
        3500 => '联营',
        4100 => '事业单位营业',
        4110 => '国有事业单位营业',
        4120 => '集体事业单位营业',
        4200 => '社团法人营业',
        4210 => '国有社团法人营业',
        4220 => '集体社团法人营业',
        4300 => '内资企业法人分支机构(非法人)',
        4310 => '全民所有制分支机构(非法人)',
        4320 => '集体分支机构(非法人)',
        4330 => '股份制分支机构',
        4340 => '股份合作制分支机构',
        4400 => '经营单位(非法人)',
        4410 => '国有经营单位(非法人)',
        4420 => '集体经营单位(非法人)',
        4500 => '非公司私营企业',
        4530 => '合伙企业',
        4531 => '普通合伙企业',
        4532 => '特殊普通合伙企业',
        4533 => '有限合伙企业',
        4540 => '个人独资企业',
        4550 => '合伙企业分支机构',
        4551 => '普通合伙企业分支机构',
        4552 => '特殊普通合伙企业分支机构',
        4553 => '有限合伙企业分支机构',
        4560 => '个人独资企业分支机构',
        4600 => '联营',
        4700 => '股份制企业(非法人)',
        5100 => '有限责任公司',
        5110 => '有限责任公司(中外合资)',
        5120 => '有限责任公司(中外合作)',
        5130 => '有限责任公司(外商合资)',
        5140 => '有限责任公司(外国自然人独资)',
        5150 => '有限责任公司(外国法人独资)',
        5160 => '有限责任公司(外国非法人经济组织独资)',
        5190 => '其他',
        5200 => '股份有限公司',
        5210 => '股份有限公司(中外合资、未上市)',
        5220 => '股份有限公司(中外合资、上市)',
        5230 => '股份有限公司(外商合资、未上市)',
        5240 => '股份有限公司(外商合资、上市)',
        5290 => '其他',
        5300 => '非公司',
        5310 => '非公司外商投资企业(中外合作)',
        5390 => '其他',
        5400 => '外商投资合伙企业',
        5410 => '普通合伙企业',
        5420 => '特殊普通合伙企业',
        5430 => '有限合伙企业',
        5490 => '其他',
        5800 => '外商投资企业分支机构',
        5810 => '分公司',
        5820 => '非公司外商投资企业分支机构',
        5830 => '办事处',
        5840 => '外商投资合伙企业分支机构',
        5890 => '其他',
        6100 =>'有限责任公司',
        6110 =>'有限责任公司(港澳台与境内合资)',
        6120 =>'有限责任公司(港澳台与境内合作)',
        6130 =>'有限责任公司(港澳台合资)',
        6140 =>'有限责任公司(港澳台自然人独资)',
        6150 =>'有限责任公司(港澳台法人独资)',
        6160 =>'有限责任公司(港澳台非法人经济组织独资)',
        6170 =>'有限责任公司(港澳台与外国投资者合资)',
        6190 =>'其他',
        6200 =>'股份有限公司',
        6210 =>'股份有限公司(港澳台与境内合资、未上市)',
        6220 =>'股份有限公司(港澳台与境内合资、上市)',
        6230 =>'股份有限公司(港澳台合资、未上市)',
        6240 =>'股份有限公司(港澳台合资、上市)',
        6250 =>'股份有限公司(港澳台与外国投资者合资、未上市)',
        6260 =>'股份有限公司(港澳台与外国投资者合资、上市)',
        6290 =>'其他',
        6300 =>'非公司',
        6310 =>'非公司港、澳、台企业(港澳台与境内合作)',
        6320 =>'非公司港、澳、台企业(港澳台合资)',
        6390 =>'其他',
        6400 =>'港、澳、台投资合伙企业',
        6410 =>'普通合伙企业',
        6420 =>'特殊普通合伙企业',
        6430 =>'有限合伙企业',
        6490 =>'其他',
        6800 =>'港、澳、台投资企业分支机构',
        6810 =>'分公司',
        6820 =>'非公司港、澳、台投资企业分支机构',
        6830 =>'办事处',
        6840 =>'港、澳、台投资合伙企业分支机构',
        6890 =>'其他',
        7100 => '外国(地区）公司分支机构',
        7110 => '外国(地区)无限责任公司分支机构',
        7120 => '外国(地区)有限责任公司分支机构',
        7130 => '外国(地区)股份有限责任公司分支机构',
        7190 => '外国(地区)其他形式公司分支机构',
        7200 => '外国(地区)企业常驻代表机构',
        7300 => '外国(地区)企业在中国境内从事经营活动',
        7310 => '分公司',
        7390 => '其他',
        9100 => '农民专业合作社',
        9200 => '农民专业合作社分支机构',
        9900 => '其他'
    );
    /**
     * 授权状态
     * UN_AUTHORIZE 未授权
     * AUTHORIZE 已授权
     */
    const AUTHORIZATION = array(
        'UN_AUTHORIZE' => 0,
        'AUTHORIZE' => 2,
    );

    const AUTHORIZATION_CN = array(
        self::AUTHORIZATION['UN_AUTHORIZE'] => '未授权',
        self::AUTHORIZATION['AUTHORIZE'] => '已授权'
    );
    
    const AUTHORIZATION_TYPE = array(
        self::AUTHORIZATION['UN_AUTHORIZE'] => 'danger',
        self::AUTHORIZATION['AUTHORIZE'] => 'success'
    );

    /**
     * 企业获取信用数据数组键名
     * INFO_CATEGORY_OBTAIN_DATA 通过信息类别获取的信用数据-行政管理,守信信息, 失信信息
     * DIRECTORY_OBTAIN_DATA 通过资源目录id获取的信用数据-经营异常名录信息,公共信用综合评价结果,司法判决信息
     * COMMITMENT 企业信用承诺数据
     * CONTRACT_PERFORMANCE 企业合同履约数据
     * RAP_CASE 企业联合奖惩案例数据
     */
    const CREDIT_RECORD_DATA_KEYS_NAME = array(
        'INFO_CATEGORY_OBTAIN_DATA' => 'infoCategoryObtainData',
        'DIRECTORY_OBTAIN_DATA' => 'directoryObtainData',
        'COMMITMENT' => 'commitmentList',
        'CONTRACT_PERFORMANCE' => 'contractPerformanceList',
        'RAP_CASE' => 'rapCaseList'
    );

    /**
     * 信用主体获取信用数据数组键名(自然人同样适用)
     * INFO_CATEGORY_OBTAIN_DATA 通过信息类别获取的信用数据-行政管理,守信信息, 失信信息
     * DIRECTORY_OBTAIN_DATA 通过资源目录id获取的信用数据-经营异常名录信息,公共信用综合评价结果,司法判决信息
     * COMMITMENT 信用承诺数据
     * CONTRACT_PERFORMANCE 合同履约数据
     */
    const CREDIT_SUBJECT_CREDIT_DATA_KEYS_NAME = array(
        'INFO_CATEGORY_OBTAIN_DATA' => 'infoCategoryObtainData',
        'DIRECTORY_OBTAIN_DATA' => 'directoryObtainData',
        'COMMITMENT' => 'commitmentData',
        'CONTRACT_PERFORMANCE' => 'contractPerformanceData',
    );

    private $id;
    /**
     * @var string $ztmc 主体名称
     */
    private $ztmc;
    /**
     * @var string $ztlb 主体类别
     */
    private $ztlb;
    /**
     * @var string $tyshxydm 统一社会信用代码
     */
    private $tyshxydm;
    /**
     * @var string $fddbr 法定代表人
     */
    private $fddbr;
    /**
     * @var string $fddbrzjlx 法定代表人证件类型
     */
    private $fddbrzjlx;
    /**
     * @var string $fddbrzjhm 法定代表人证件号码
     */
    private $fddbrzjhm;
    /**
     * @var int $clrq 成立日期
     */
    private $clrq;
    /**
     * @var int $yxq 有效期
     */
    private $yxq;
    /**
     * @var string $dz 地址
     */
    private $dz;
    /**
     * @var string $djjg 登记机关
     */
    private $djjg;
    /**
     * @var string $gb 国别
     */
    private $gb;
    /**
     * @var string $zczb 注册资本（单位：万）
     */
    private $zczb;
    /**
     * @var string $zczbbz 注册资本币种
     */
    private $zczbbz;
    /**
     * @var string $hydm 行业代码
     */
    private $hydm;
    /**
     * @var string $lx 类型
     */
    private $lx;
    /**
     * @var string $jyfw 经营范围
     */
    private $jyfw;
    /**
     * @var int $jyzt 经营状态
     */
    private $jyzt;
    /**
     * @var string $jyfwms 经营范围描述
     */
    private $jyfwms;
    /**
     * @var int $authorization 授权状态
     */
    private $authorization;
    /**
     * @var Data $source 资源目录relation 关联 id
     */
    private $source;
    /**
     * @var int $complaintCount 被投诉数量
     */
    private $complaintCount;
    /**
     * @var int $praiseCount 被表扬数量
     */
    private $praiseCount;

    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->ztmc = '';
        $this->ztlb = '';
        $this->tyshxydm = '';
        $this->fddbr = '';
        $this->fddbrzjlx = '';
        $this->fddbrzjhm = '';
        $this->clrq = 0;
        $this->yxq = 0;
        $this->dz = '';
        $this->djjg = '';
        $this->gb = '';
        $this->zczb = '';
        $this->zczbbz = '';
        $this->hydm = '';
        $this->lx = '';
        $this->jyfw = '';
        $this->jyzt = 0;
        $this->jyfwms = '';
        $this->authorization = 0;
        $this->source = new Data();
        $this->complaintCount = 0;
        $this->praiseCount = 0;
        $this->status = 0;
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new EnterpriseRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->ztmc);
        unset($this->ztlb);
        unset($this->tyshxydm);
        unset($this->fddbr);
        unset($this->fddbrzjlx);
        unset($this->fddbrzjhm);
        unset($this->clrq);
        unset($this->yxq);
        unset($this->dz);
        unset($this->djjg);
        unset($this->gb);
        unset($this->zczb);
        unset($this->zczbbz);
        unset($this->hydm);
        unset($this->lx);
        unset($this->jyfw);
        unset($this->jyzt);
        unset($this->jyfwms);
        unset($this->authorization);
        unset($this->source);
        unset($this->complaintCount);
        unset($this->praiseCount);
        unset($this->status);
        unset($this->createTime);
        unset($this->updateTime);
        unset($this->statusTime);
        unset($this->repository);
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setZtmc(string $ztmc): void
    {
        $this->ztmc = $ztmc;
    }

    public function getZtmc(): string
    {
        return $this->ztmc;
    }

    public function setZtlb(string $ztlb): void
    {
        $this->ztlb = $ztlb;
    }

    public function getZtlb(): string
    {
        return $this->ztlb;
    }

    public function setTyshxydm(string $tyshxydm): void
    {
        $this->tyshxydm = $tyshxydm;
    }

    public function getTyshxydm(): string
    {
        return $this->tyshxydm;
    }

    public function setFddbr(string $fddbr): void
    {
        $this->fddbr = $fddbr;
    }

    public function getFddbr(): string
    {
        return $this->fddbr;
    }

    public function setFddbrzjlx(string $fddbrzjlx): void
    {
        $this->fddbrzjlx = $fddbrzjlx;
    }

    public function getFddbrzjlx(): string
    {
        return $this->fddbrzjlx;
    }

    public function setFddbrzjhm(string $fddbrzjhm): void
    {
        $this->fddbrzjhm = $fddbrzjhm;
    }

    public function getFddbrzjhm(): string
    {
        return $this->fddbrzjhm;
    }

    public function setClrq(int $clrq): void
    {
        $this->clrq = $clrq;
    }

    public function getClrq(): int
    {
        return $this->clrq;
    }

    public function setYxq(int $yxq): void
    {
        $this->yxq = $yxq;
    }

    public function getYxq(): int
    {
        return $this->yxq;
    }

    public function setDz(string $dz): void
    {
        $this->dz = $dz;
    }

    public function getDz(): string
    {
        return $this->dz;
    }

    public function setDjjg(string $djjg): void
    {
        $this->djjg = $djjg;
    }

    public function getDjjg(): string
    {
        return $this->djjg;
    }

    public function setGb(string $gb): void
    {
        $this->gb = $gb;
    }

    public function getGb(): string
    {
        return $this->gb;
    }

    public function setZczb(string $zczb): void
    {
        $this->zczb = $zczb;
    }

    public function getZczb(): string
    {
        return $this->zczb;
    }

    public function setZczbbz(string $zczbbz): void
    {
        $this->zczbbz = $zczbbz;
    }

    public function getZczbbz(): string
    {
        return $this->zczbbz;
    }

    public function setHydm(string $hydm): void
    {
        $this->hydm = $hydm;
    }

    public function getHydm(): string
    {
        return $this->hydm;
    }

    public function setLx(string $lx): void
    {
        $this->lx = $lx;
    }

    public function getLx(): string
    {
        return $this->lx;
    }

    public function setJyfw(string $jyfw): void
    {
        $this->jyfw = $jyfw;
    }

    public function getJyfw(): string
    {
        return $this->jyfw;
    }

    public function setJyzt(int $jyzt): void
    {
        $this->jyzt = $jyzt;
    }

    public function getJyzt(): int
    {
        return $this->jyzt;
    }

    public function setJyfwms(string $jyfwms): void
    {
        $this->jyfwms = $jyfwms;
    }

    public function getJyfwms(): string
    {
        return $this->jyfwms;
    }

    public function setAuthorization(int $authorization): void
    {
        $this->authorization = $authorization;
    }

    public function getAuthorization(): int
    {
        return $this->authorization;
    }

    public function setSource(Data $source): void
    {
        $this->source = $source;
    }

    public function getSource(): Data
    {
        return $this->source;
    }

    public function setComplaintCount(int $complaintCount): void
    {
        $this->complaintCount = $complaintCount;
    }

    public function getComplaintCount(): int
    {
        return $this->complaintCount;
    }

    public function setPraiseCount(int $praiseCount): void
    {
        $this->praiseCount = $praiseCount;
    }

    public function getPraiseCount(): int
    {
        return $this->praiseCount;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    protected function getRepository()
    {
        return $this->repository;
    }

    public function authorize() : bool
    {
        if ($this->isAuthorize()) {
            Core::setLastError(RESOURCE_CAN_NOT_MODIFY);
            return false;
        }

        return $this->getRepository()->authorize($this);
    }

    public function unAuthorize() : bool
    {
        if (!$this->isAuthorize()) {
            Core::setLastError(RESOURCE_CAN_NOT_MODIFY);
            return false;
        }

        return $this->getRepository()->unAuthorize($this);
    }

    public function isAuthorize() : bool
    {
        return $this->getAuthorization() == self::AUTHORIZATION['AUTHORIZE'];
    }
}
