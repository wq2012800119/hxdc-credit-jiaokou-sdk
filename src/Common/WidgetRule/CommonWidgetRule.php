<?php
namespace Sdk\Common\WidgetRule;

use Marmot\Core;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Respect\Validation\Validator as V;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class CommonWidgetRule
{
    //验证路由id为数字
    public function routeId($id) : bool
    {
        if (!V::numeric()->positive()->validate($id)) {
            Core::setLastError(ROUTE_NOT_EXIST);
            return false;
        }

        return true;
    }

    //验证数据格式为数组
    public function isArrayType($data, string $pointer = '') : bool
    {
        if (!V::arrayType()->validate($data)) {
            Core::setLastError(PARAMETER_FORMAT_ERROR, array('pointer' => $pointer));
            return false;
        }

        return true;
    }

    //验证数据格式为字符串
    public function isStringType($data, string $pointer = '') : bool
    {
        if (!V::stringType()->validate($data)) {
            Core::setLastError(PARAMETER_FORMAT_ERROR, array('pointer' => $pointer));
            return false;
        }

        return true;
    }

    //验证数据格式为数字
    public function isNumericType($data, string $pointer = '') : bool
    {
        if (!is_numeric($data)) {
            Core::setLastError(PARAMETER_FORMAT_ERROR, array('pointer' => $pointer));
            return false;
        }
        
        return true;
    }

    const TITLE_MIN_LENGTH = 5;
    const TITLE_MAX_LENGTH = 80;
    //验证标题长度：5-80个字符
    public function title($title) : bool
    {
        if (!V::stringType()->length(self::TITLE_MIN_LENGTH, self::TITLE_MAX_LENGTH)->validate($title)) {
            Core::setLastError(TITLE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const NAME_MIN_LENGTH = 1;
    const NAME_MAX_LENGTH = 20;
    //验证名称长度：1-20个字符
    public function name($name) : bool
    {
        if (!V::stringType()->length(self::NAME_MIN_LENGTH, self::NAME_MAX_LENGTH)->validate($name)) {
            Core::setLastError(NAME_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const SUBJECT_NAME_MIN_LENGTH = 1;
    const SUBJECT_NAME_MAX_LENGTH = 200;
    //验证主体名称长度：1-200个字符
    public function subjectName($subjectName) : bool
    {
        if (!V::stringType()->length(
            self::SUBJECT_NAME_MIN_LENGTH,
            self::SUBJECT_NAME_MAX_LENGTH
        )->validate($subjectName)) {
            Core::setLastError(SUBJECT_NAME_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    //按照国标统一社会信用代码规则验证
    const UNIFIED_IDENTIFIER_LENGTH = 18;
    public function unifiedIdentifier($unifiedIdentifier) : bool
    {
        $regex = '/^[1-9ANY][1-9]\d{6}[0-9A-HJ-NPQRTUWXY]{10}$|0{17}X$/';
        if (strlen($unifiedIdentifier) != self::UNIFIED_IDENTIFIER_LENGTH || !preg_match($regex, $unifiedIdentifier)) {
            Core::setLastError(UNIFIED_IDENTIFIER_FORMAT_INCORRECT);
            return false;
        }
        
        if ($unifiedIdentifier == '00000000000000000X') {
            return true;
        }
        //验证最后一位数是否正确
        //1. 声明一个数组(加权因子)以下是数组的元素 1,3, 9,27,19,26,16,17,20,29,25,13,8,24,10,30,28
        $weightingFactor = array(1,3, 9,27,19,26,16,17,20,29,25,13,8,24,10,30,28); //加权因子
        //2. 声明一个0-9A-Z(权重) 没有I、O、S、V、Z 的数组
        $weight = array('0' , '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E',
        'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'T', 'U', 'W', 'X', 'Y');

        $total = 0;
        $unifiedIdentifierValueArray = str_split($unifiedIdentifier);
        $checkUnifiedIdentifierValue = $unifiedIdentifierValueArray[17];

        //3. 计算每一次权重与加权因子相乘之和
        //(1). 获取统一社会信用代码第一位到第十七位的值
        //(2). 通过获取到的值获取该值在权重数组中的健值
        //(3). 计算每一次权重与加权因子相乘之和
        for ($i = 0; $i < 17; $i++) {
            $unifiedIdentifierValue = $unifiedIdentifierValueArray[$i];

            $total += array_search($unifiedIdentifierValue, $weight) * $weightingFactor[$i];
        }

        //4.权重与加权因子相乘之和除以31求余,31再减去这个余数获得一个值
        $logicCheckCode = 31 - ($total % 31);
        //5.判断这个值是否等于31,如果相等将这个值重新赋值为0
        if ($logicCheckCode == 31) {
            $logicCheckCode = 0;
        }

        //6. 判断统一社会信用代码的最后一位与以上面计算获取的值作为下标获取权重数组中的一个元素是否相等,如果相等则正确
        if ($checkUnifiedIdentifierValue != $weight[$logicCheckCode]) {
            Core::setLastError(UNIFIED_IDENTIFIER_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    //按照国标身份证号规则验证
    public function idCard($idCard) : bool
    {
        $regex18 = '/^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$/';
        $regex15 = '/^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}$/';

        if (!preg_match($regex18, $idCard) && !preg_match($regex15, $idCard)) {
            Core::setLastError(ID_CARD_FORMAT_INCORRECT);
            return false;
        }

        if (strlen($idCard) == 15) {
            $idCard = $this->convertIDCard15to18($idCard);
        }

        //校验地址码,校验身份证日期规范校验
        if (!$this->checkAddressCode($idCard) || !$this->checkBirthDayCode($idCard)) {
            Core::setLastError(ID_CARD_FORMAT_INCORRECT);
            return false;
        }

        //验证最后一位数是否正确
        //加权因子
        $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
        //校验码对应值
        $code = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
        $checksum = 0;
        $checkIdCardValue = substr($idCard, 17, 1);
    
        for ($i = 0; $i < 17; $i++) {
            $checksum += substr($idCard, $i, 1) * $factor[$i];
        }
    
        $logicCheckCode = $code[$checksum % 11];

        if ($checkIdCardValue != $logicCheckCode) {
            Core::setLastError(ID_CARD_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
    // 将15位身份证升级到18位
    protected function convertIDCard15to18($idCard) : string
    {
        if (strlen($idCard) != 15) {
            return $idCard;
        }

        $idCard17 = substr($idCard, 0, 6) . '19' . substr($idCard, 6, 9);
        $idCard = $idCard17.$this->getIdCardLastValue($idCard17);

        return $idCard;
    }

    //计算身份证的最后一位验证码,根据国家标准GB 11643-1999
    protected function getIdCardLastValue($idCard17) : string
    {
        //加权因子
        $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
        //校验码对应值
        $code = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
        $checksum = 0;
    
        for ($i = 0; $i < 17; $i++) {
            $checksum += substr($idCard17, $i, 1) * $factor[$i];
        }
    
        return $code[$checksum % 11];
    }

    //校验地址码
    protected function checkAddressCode($idCard) : bool
    {
        $addressCode = substr($idCard, 0, 2);
        $provinceAndCities = [
            11 => "北京", 12 => "天津", 13 => "河北",  14 => "山西", 15 => "内蒙古",
            21 => "辽宁", 22 => "吉林", 23 => "黑龙江", 31 => "上海", 32 => "江苏",
            33 => "浙江", 34 => "安徽", 35 => "福建",  36 => "江西", 37 => "山东", 41 => "河南",
            42 => "湖北", 43 => "湖南", 44 => "广东",  45 => "广西", 46 => "海南", 50 => "重庆",
            51 => "四川", 52 => "贵州", 53 => "云南",  54 => "西藏", 61 => "陕西", 62 => "甘肃",
            63 => "青海", 64 => "宁夏", 65 => "新疆",  71 => "台湾", 81 => "香港", 82 => "澳门", 91 => "国外"
        ];

        return isset($provinceAndCities[$addressCode]);
    }

    //校验日期码
    protected function checkBirthDayCode($idCard) : bool
    {
        $birthDayCode = substr($idCard, 6, 8);
        $regex = '/^[1-9]\d{3}((0[1-9])|(10|11|12))((0[1-9])|([1-2][0-9])|(3[0-1]))$/';

        if (!preg_match($regex, $birthDayCode)) {
            return false;
        }

        $date = date('Y-m-d', strtotime($birthDayCode));

        if ($date > date("Y-m-d")) {
            return false;
        }

        return true;
    }

    //验证按照手机号规则验证
    public function cellphone($cellphone) : bool
    {
        $regex = '/^[1][0-9]{10}$/';

        if (!preg_match($regex, $cellphone)) {
            Core::setLastError(CELLPHONE_FORMAT_INCORRECT);
            return false;
        }
        
        return true;
    }

    const TELEPHONE_MIN_LENGTH = 4;
    const TELEPHONE_MAX_LENGTH = 11;
    //验证电话号码长度：4-11个字符
    public function telephone($telephone) : bool
    {
        if (!V::stringType()->length(
            self::TELEPHONE_MIN_LENGTH,
            self::TELEPHONE_MAX_LENGTH
        )->validate($telephone)) {
            Core::setLastError(TELEPHONE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    //验证密码长度：8-30个字符，规则为：大小写字母+数字+特殊字符(!@#$%.&)
    public function password($password, $pointer = 'password') : bool
    {
        $reg = '/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%.&])[\da-zA-Z!@#$%.&]{8,30}$/';

        if (!preg_match($reg, $password)) {
            Core::setLastError(PASSWORD_FORMAT_INCORRECT, array('pointer' => $pointer));
            return false;
        }

        return true;
    }

    //验证确认密码是否与密码一致
    public function confirmPassword($password, $confirmPassword) : bool
    {
        if ($password != $confirmPassword) {
            Core::setLastError(CONFIRM_PASSWORD_IDENTICAL_DENIED);
            return false;
        }

        return true;
    }

    const REASON_MIN_LENGTH = 1;
    const REASON_MAX_LENGTH = 200;
    //验证原因/驳回原因长度：1-200个字符
    public function reason($reason, $pointer = 'reason') : bool
    {
        if (!V::stringType()->length(
            self::REASON_MIN_LENGTH,
            self::REASON_MAX_LENGTH
        )->validate($reason)) {
            Core::setLastError(REASON_FORMAT_INCORRECT, array('pointer' => $pointer));
            return false;
        }

        return true;
    }

    const DESCRIPTION_MIN_LENGTH = 1;
    const DESCRIPTION_MAX_LENGTH = 200;
    //验证描述长度：1-200个字符
    public function description($description, $pointer = 'description') : bool
    {
        if (!V::stringType()->length(
            self::DESCRIPTION_MIN_LENGTH,
            self::DESCRIPTION_MAX_LENGTH
        )->validate($description)) {
            Core::setLastError(DESCRIPTION_FORMAT_INCORRECT, array('pointer' => $pointer));
            return false;
        }

        return true;
    }
    
    const CONTENT_MIN_LENGTH = 1;
    const CONTENT_MAX_LENGTH = 2000;
    //验证内容长度：1-2000个字符
    public function content($content, $pointer = 'content') : bool
    {
        if (!V::stringType()->length(
            self::CONTENT_MIN_LENGTH,
            self::CONTENT_MAX_LENGTH
        )->validate($content)) {
            Core::setLastError(CONTENT_FORMAT_INCORRECT, array('pointer' => $pointer));
            return false;
        }

        return true;
    }
    
    const REMARK_MIN_LENGTH = 1;
    const REMARK_MAX_LENGTH = 2000;
    //验证备注长度：1-2000个字符
    public function remark($remark, $pointer = 'remark') : bool
    {
        if (!V::stringType()->length(
            self::REMARK_MIN_LENGTH,
            self::REMARK_MAX_LENGTH
        )->validate($remark)) {
            Core::setLastError(REMARK_FORMAT_INCORRECT, array('pointer' => $pointer));
            return false;
        }

        return true;
    }

    public function attachment($attachment, $pointer = 'attachment') : bool
    {
        if (!V::arrayType()->validate($attachment)) {
            Core::setLastError(ATTACHMENT_FORMAT_INCORRECT, array('pointer' => $pointer));
            return false;
        }

        if (!isset($attachment['name']) || !isset($attachment['address'])) {
            Core::setLastError(ATTACHMENT_FORMAT_INCORRECT, array('pointer' => $pointer));
            return false;
        }

        if (!$this->validateAttachmentExtension($attachment['address'])) {
            Core::setLastError(ATTACHMENT_FORMAT_INCORRECT, array('pointer' => $pointer));
            return false;
        }

        return true;
    }

    public function attachments($attachments, $pointer = 'attachments') : bool
    {
        if (!V::arrayType()->validate($attachments)) {
            Core::setLastError(ATTACHMENT_FORMAT_INCORRECT, array('pointer' => $pointer));
            return false;
        }

        foreach ($attachments as $attachment) {
            if (!$this->attachment($attachment)) {
                Core::setLastError(ATTACHMENT_FORMAT_INCORRECT, array('pointer' => $pointer));
                return false;
            }
        }

        return true;
    }

    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    protected function validateAttachmentExtension($attachment) : bool
    {
        if (!V::extension('doc')->validate($attachment) &&
            !V::extension('docx')->validate($attachment) &&
            !V::extension('xls')->validate($attachment) &&
            !V::extension('xlsx')->validate($attachment) &&
            !V::extension('pdf')->validate($attachment) &&
            !V::extension('zip')->validate($attachment) &&
            !V::extension('rar')->validate($attachment) &&
            !V::extension('lzh')->validate($attachment) &&
            !V::extension('jar')->validate($attachment) &&
            !V::extension('ppt')->validate($attachment) &&
            !V::extension('txt')->validate($attachment)
        ) {
            return false;
        }

        return true;
    }

    public function picture($picture, $pointer = 'picture') : bool
    {
        if (!V::arrayType()->validate($picture)) {
            Core::setLastError(PICTURE_FORMAT_INCORRECT, array('pointer' => $pointer));
            return false;
        }

        if (!isset($picture['name']) || !isset($picture['address'])) {
            Core::setLastError(PICTURE_FORMAT_INCORRECT, array('pointer' => $pointer));
            return false;
        }

        if (!$this->validatePictureExtension($picture['address'])) {
            Core::setLastError(PICTURE_FORMAT_INCORRECT, array('pointer' => $pointer));
            return false;
        }

        return true;
    }

    public function pictures($pictures, $pointer = 'pointers') : bool
    {
        if (!V::arrayType()->validate($pictures)) {
            Core::setLastError(PICTURE_FORMAT_INCORRECT, array('pointer' => $pointer));
            return false;
        }

        foreach ($pictures as $picture) {
            if (!$this->picture($picture)) {
                Core::setLastError(PICTURE_FORMAT_INCORRECT, array('pointer' => $pointer));
                return false;
            }
        }

        return true;
    }

    public function validatePictureExtension($picture) : bool
    {
        if (!V::extension('jpg')->validate($picture) &&
            !V::extension('png')->validate($picture) &&
            !V::extension('svg')->validate($picture) &&
            !V::extension('jpeg')->validate($picture)
        ) {
            return false;
        }

        return true;
    }

    public function status($status, $pointer = 'status') : bool
    {
        if (!V::numeric()->validate($status) || !in_array($status, IOperateAble::STATUS)) {
            Core::setLastError(STATUS_FORMAT_INCORRECT, array('pointer' => $pointer));
            return false;
        }

        return true;
    }

    public function email($email) : bool
    {
        if (!V::email()->validate($email)) {
            Core::setLastError(EMAIL_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const REAL_NAME_MIN_LENGTH = 1;
    const REAL_NAME_MAX_LENGTH = 200;
    //验证真实姓名长度：1-200个字符
    public function realName($realName) : bool
    {
        if (!V::stringType()->length(
            self::REAL_NAME_MIN_LENGTH,
            self::REAL_NAME_MAX_LENGTH
        )->validate($realName)) {
            Core::setLastError(REAL_NAME_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
}
