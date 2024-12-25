<?php

return [
    SLIDING_VERIFICATION_INCORRECT=>
    array(
        'id'=>SLIDING_VERIFICATION_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'SLIDING_VERIFICATION_INCORRECT',
        'title'=>'滑动验证失败, 请刷新页面重新尝试',
        'detail'=>'滑动验证失败, 请刷新页面重新尝试',
        'source'=>array(
            'pointer'=>'slidingVerification'
        ),
        'meta'=>array()
    ),
    FILE_NOT_EXIST=>
    array(
        'id'=>FILE_NOT_EXIST,
        'link'=>'',
        'status'=>403,
        'code'=>'FILE_NOT_EXIST',
        'title'=>'文件不存在, 请重新输入',
        'detail'=>'文件不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'file'
        ),
        'meta'=>array()
    ),
    FILE_EXTENSION_NOT_SUPPORTED=>
    array(
        'id'=>FILE_EXTENSION_NOT_SUPPORTED,
        'link'=>'',
        'status'=>403,
        'code'=>'FILE_EXTENSION_NOT_SUPPORTED',
        'title'=>'文件后缀不支持, 请重新输入',
        'detail'=>'文件后缀不支持, 请重新输入',
        'source'=>array(
            'pointer'=>'file'
        ),
        'meta'=>array()
    ),
    FILE_SIZE_LIMIT_EXCEEDED=>
    array(
        'id'=>FILE_SIZE_LIMIT_EXCEEDED,
        'link'=>'',
        'status'=>403,
        'code'=>'FILE_SIZE_LIMIT_EXCEEDED',
        'title'=>'文件大小超出限制, 请重新输入',
        'detail'=>'文件大小超出限制, 请重新输入',
        'source'=>array(
            'pointer'=>'file'
        ),
        'meta'=>array()
    ),
    FILE_UPLOAD_INCORRECT=>
    array(
        'id'=>FILE_UPLOAD_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'FILE_UPLOAD_INCORRECT',
        'title'=>'文件上传不正确, 请重新输入',
        'detail'=>'文件上传不正确, 请重新输入',
        'source'=>array(
            'pointer'=>'file'
        ),
        'meta'=>array()
    ),
    FILE_UPLOAD_PATH_NOT_EXIST=>
    array(
        'id'=>FILE_UPLOAD_PATH_NOT_EXIST,
        'link'=>'',
        'status'=>403,
        'code'=>'FILE_UPLOAD_PATH_NOT_EXIST',
        'title'=>'文件上传路径不存在, 请重新输入',
        'detail'=>'文件上传路径不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'file'
        ),
        'meta'=>array()
    ),
    CSRF_VERIFICATION_FAILURE=>
    array(
        'id'=>CSRF_VERIFICATION_FAILURE,
        'link'=>'',
        'status'=>403,
        'code'=>'CSRF_VERIFICATION_FAILURE',
        'title'=>'页面信息失效, 请刷新页面重新尝试',
        'detail'=>'页面信息失效, 请刷新页面重新尝试',
        'source'=>array(
            'pointer'=>'csrf'
        ),
        'meta'=>array()
    ),
    PARAMETER_FORMAT_ERROR=>
    array(
        'id'=>PARAMETER_FORMAT_ERROR,
        'link'=>'',
        'status'=>403,
        'code'=>'PARAMETER_FORMAT_ERROR',
        'title'=>'参数格式不正确, 请按照提示重新输入',
        'detail'=>'参数格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'parameter'
        ),
        'meta'=>array()
    ),
    PARAMETER_INCORRECT=>
    array(
        'id'=>PARAMETER_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'PARAMETER_INCORRECT',
        'title'=>'参数不正确, 请重新输入',
        'detail'=>'参数不正确, 请重新输入',
        'source'=>array(
            'pointer'=>'parameter'
        ),
        'meta'=>array()
    ),
    PARAMETER_NOT_EMPTY=>
    array(
        'id'=>PARAMETER_NOT_EMPTY,
        'link'=>'',
        'status'=>403,
        'code'=>'PARAMETER_NOT_EMPTY',
        'title'=>'参数不能为空, 请按照提示重新输入',
        'detail'=>'参数不能为空, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'parameter'
        ),
        'meta'=>array()
    ),
    RESOURCE_CAN_NOT_MODIFY=>
    array(
        'id'=>RESOURCE_CAN_NOT_MODIFY,
        'link'=>'',
        'status'=>403,
        'code'=>'RESOURCE_CAN_NOT_MODIFY',
        'title'=>'资源不能被操作, 请刷新页面重新尝试',
        'detail'=>'资源不能被操作, 请刷新页面重新尝试',
        'source'=>array(
            'pointer'=>'resource'
        ),
        'meta'=>array()
    ),
    RESOURCE_EXISTS=>
    array(
        'id'=>RESOURCE_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'RESOURCE_EXISTS',
        'title'=>'资源已经存在, 请重新输入',
        'detail'=>'资源已经存在, 请重新输入',
        'source'=>array(
            'pointer'=>'resource'
        ),
        'meta'=>array()
    ),
    RESOURCE_NOT_EXISTS=>
    array(
        'id'=>RESOURCE_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'RESOURCE_NOT_EXISTS',
        'title'=>'资源不存在, 请重新输入',
        'detail'=>'资源不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'resource'
        ),
        'meta'=>array()
    ),
    USER_NOT_LOGIN=>
    array(
        'id'=>USER_NOT_LOGIN,
        'link'=>'',
        'status'=>403,
        'code'=>'USER_NOT_LOGIN',
        'title'=>'用户未登录, 请登录后重新尝试',
        'detail'=>'用户未登录, 请登录后重新尝试',
        'source'=>array(
            'pointer'=>'user'
        ),
        'meta'=>array()
    ),
    USER_PURVIEW_UNASSIGNED=>
    array(
        'id'=>USER_PURVIEW_UNASSIGNED,
        'link'=>'',
        'status'=>403,
        'code'=>'USER_PURVIEW_UNASSIGNED',
        'title'=>'该用户并未分配此权限, 如有疑问请联系平台管理员',
        'detail'=>'该用户并未分配此权限, 如有疑问请联系平台管理员',
        'source'=>array(
            'pointer'=>'user'
        ),
        'meta'=>array()
    ),
    USER_IDENTITY_AUTHENTICATION_FAILED=>
    array(
        'id'=>USER_IDENTITY_AUTHENTICATION_FAILED,
        'link'=>'',
        'status'=>403,
        'code'=>'USER_IDENTITY_AUTHENTICATION_FAILED',
        'title'=>'用户身份认证失败, 请刷新页面重新进行登录',
        'detail'=>'用户身份认证失败, 请刷新页面重新进行登录',
        'source'=>array(
            'pointer'=>'user'
        ),
        'meta'=>array()
    ),
    USER_STATUS_DISABLED=>
    array(
        'id'=>USER_STATUS_DISABLED,
        'link'=>'',
        'status'=>403,
        'code'=>'USER_STATUS_DISABLED',
        'title'=>'该用户被禁用, 不能对平台进行任何操作, 如有疑问请联系平台管理员',
        'detail'=>'该用户被禁用, 不能对平台进行任何操作, 如有疑问请联系平台管理员',
        'source'=>array(
            'pointer'=>'user'
        ),
        'meta'=>array()
    ),
    TITLE_FORMAT_INCORRECT=>
    array(
        'id'=>TITLE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'TITLE_FORMAT_INCORRECT',
        'title'=>'标题格式不正确, 请按照提示重新输入',
        'detail'=>'标题格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'title'
        ),
        'meta'=>array()
    ),
    NAME_FORMAT_INCORRECT=>
    array(
        'id'=>NAME_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'NAME_FORMAT_INCORRECT',
        'title'=>'名称格式不正确, 请按照提示重新输入',
        'detail'=>'名称格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'name'
        ),
        'meta'=>array()
    ),
    SUBJECT_NAME_FORMAT_INCORRECT=>
    array(
        'id'=>SUBJECT_NAME_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'SUBJECT_NAME_FORMAT_INCORRECT',
        'title'=>'主体名称格式不正确, 请按照提示重新输入',
        'detail'=>'主体名称格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'subjectName'
        ),
        'meta'=>array()
    ),
    UNIFIED_IDENTIFIER_FORMAT_INCORRECT=>
    array(
        'id'=>UNIFIED_IDENTIFIER_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'UNIFIED_IDENTIFIER_FORMAT_INCORRECT',
        'title'=>'统一社会信用代码格式不正确, 请按照提示重新输入',
        'detail'=>'统一社会信用代码格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'unifiedIdentifier'
        ),
        'meta'=>array()
    ),
    ID_CARD_FORMAT_INCORRECT=>
    array(
        'id'=>ID_CARD_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ID_CARD_FORMAT_INCORRECT',
        'title'=>'身份证号格式不正确, 请按照提示重新输入',
        'detail'=>'身份证号格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'idCard'
        ),
        'meta'=>array()
    ),
    CELLPHONE_FORMAT_INCORRECT=>
    array(
        'id'=>CELLPHONE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CELLPHONE_FORMAT_INCORRECT',
        'title'=>'手机号格式不正确, 请按照提示重新输入',
        'detail'=>'手机号格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'cellphone'
        ),
        'meta'=>array()
    ),
    TELEPHONE_FORMAT_INCORRECT=>
    array(
        'id'=>TELEPHONE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'TELEPHONE_FORMAT_INCORRECT',
        'title'=>'电话号码格式不正确, 请按照提示重新输入',
        'detail'=>'电话号码格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'telephone'
        ),
        'meta'=>array()
    ),
    PASSWORD_FORMAT_INCORRECT=>
    array(
        'id'=>PASSWORD_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'PASSWORD_FORMAT_INCORRECT',
        'title'=>'密码格式不正确, 请按照提示重新输入',
        'detail'=>'密码格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'password'
        ),
        'meta'=>array()
    ),
    CONFIRM_PASSWORD_IDENTICAL_DENIED=>
    array(
        'id'=>CONFIRM_PASSWORD_IDENTICAL_DENIED,
        'link'=>'',
        'status'=>403,
        'code'=>'CONFIRM_PASSWORD_IDENTICAL_DENIED',
        'title'=>'确认密码与密码不一致,请重新输入',
        'detail'=>'确认密码与密码不一致,请重新输入',
        'source'=>array(
            'pointer'=>'confirmPassword'
        ),
        'meta'=>array()
    ),
    REASON_FORMAT_INCORRECT=>
    array(
        'id'=>REASON_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'REASON_FORMAT_INCORRECT',
        'title'=>'原因格式不正确, 请按照提示重新输入',
        'detail'=>'原因格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'reason'
        ),
        'meta'=>array()
    ),
    DESCRIPTION_FORMAT_INCORRECT=>
    array(
        'id'=>DESCRIPTION_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DESCRIPTION_FORMAT_INCORRECT',
        'title'=>'描述格式不正确, 请按照提示重新输入',
        'detail'=>'描述格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'description'
        ),
        'meta'=>array()
    ),
    CONTENT_FORMAT_INCORRECT=>
    array(
        'id'=>CONTENT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTENT_FORMAT_INCORRECT',
        'title'=>'内容格式不正确, 请按照提示重新输入',
        'detail'=>'内容格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'content'
        ),
        'meta'=>array()
    ),
    REMARK_FORMAT_INCORRECT=>
    array(
        'id'=>REMARK_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'REMARK_FORMAT_INCORRECT',
        'title'=>'备注格式不正确, 请按照提示重新输入',
        'detail'=>'备注格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'remark'
        ),
        'meta'=>array()
    ),
    ATTACHMENT_FORMAT_INCORRECT=>
    array(
        'id'=>ATTACHMENT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ATTACHMENT_FORMAT_INCORRECT',
        'title'=>'附件格式不正确, 请按照提示重新输入',
        'detail'=>'附件格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'attachment'
        ),
        'meta'=>array()
    ),
    PICTURE_FORMAT_INCORRECT=>
    array(
        'id'=>PICTURE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'PICTURE_FORMAT_INCORRECT',
        'title'=>'图片格式不正确, 请按照提示重新输入',
        'detail'=>'图片格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'picture'
        ),
        'meta'=>array()
    ),
    STAFF_FORMAT_INCORRECT=>
    array(
        'id'=>STAFF_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'STAFF_FORMAT_INCORRECT',
        'title'=>'发布人格式不正确, 请按照提示重新输入',
        'detail'=>'发布人格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'staff'
        ),
        'meta'=>array()
    ),
    ACCOUNT_NOT_EXISTS=>
    array(
        'id'=>ACCOUNT_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'ACCOUNT_NOT_EXISTS',
        'title'=>'账号不存在, 请重新输入',
        'detail'=>'账号不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'account'
        ),
        'meta'=>array()
    ),
    PASSWORD_INCORRECT=>
    array(
        'id'=>PASSWORD_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'PASSWORD_INCORRECT',
        'title'=>'密码不正确, 请重新输入',
        'detail'=>'密码不正确, 请重新输入',
        'source'=>array(
            'pointer'=>'password'
        ),
        'meta'=>array()
    ),
    STAFF_NOT_EXISTS=>
    array(
        'id'=>STAFF_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'STAFF_NOT_EXISTS',
        'title'=>'发布人不存在, 请重新输入',
        'detail'=>'发布人不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'staff'
        ),
        'meta'=>array()
    ),
    ACCOUNT_PASSWORD_INCORRECT=>
    array(
        'id'=>ACCOUNT_PASSWORD_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ACCOUNT_PASSWORD_INCORRECT',
        'title'=>'账号或密码不正确, 请重新输入',
        'detail'=>'账号或密码不正确, 请重新输入',
        'source'=>array(
            'pointer'=>'user'
        ),
        'meta'=>array()
    ),
    OLD_PASSWORD_INCORRECT=>
    array(
        'id'=>OLD_PASSWORD_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'OLD_PASSWORD_INCORRECT',
        'title'=>'旧密码不正确, 请重新输入',
        'detail'=>'旧密码不正确, 请重新输入',
        'source'=>array(
            'pointer'=>'oldPassword'
        ),
        'meta'=>array()
    ),
    STATUS_FORMAT_INCORRECT=>
    array(
        'id'=>STATUS_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'STATUS_FORMAT_INCORRECT',
        'title'=>'状态格式不正确, 请按照提示重新输入',
        'detail'=>'状态格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'status'
        ),
        'meta'=>array()
    ),
    EMAIL_FORMAT_INCORRECT=>
    array(
        'id'=>EMAIL_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EMAIL_FORMAT_INCORRECT',
        'title'=>'邮箱格式不正确, 请按照提示重新输入',
        'detail'=>'邮箱格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'email'
        ),
        'meta'=>array()
    ),
    REAL_NAME_FORMAT_INCORRECT=>
    array(
        'id'=>REAL_NAME_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'REAL_NAME_FORMAT_INCORRECT',
        'title'=>'真实姓名格式不正确, 请按照提示重新输入',
        'detail'=>'真实姓名格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'realName'
        ),
        'meta'=>array()
    ),
    MEMBER_FORMAT_INCORRECT=>
    array(
        'id'=>MEMBER_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'MEMBER_FORMAT_INCORRECT',
        'title'=>'发布用户格式不正确, 请按照提示重新输入',
        'detail'=>'发布用户格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'member'
        ),
        'meta'=>array()
    ),
    MEMBER_NOT_EXISTS=>
    array(
        'id'=>MEMBER_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'MEMBER_NOT_EXISTS',
        'title'=>'发布用户不存在, 请重新输入',
        'detail'=>'发布用户不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'member'
        ),
        'meta'=>array()
    ),
    RESOURCE_DATA_NOT_EXISTS=>
    array(
        'id'=>RESOURCE_DATA_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'RESOURCE_DATA_NOT_EXISTS',
        'title'=>'信用数据不存在, 请重新输入',
        'detail'=>'信用数据不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'data'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_NOT_EXISTS=>
    array(
        'id'=>ENTERPRISE_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_NOT_EXISTS',
        'title'=>'企业不存在, 请重新输入',
        'detail'=>'企业不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'enterprise'
        ),
        'meta'=>array()
    ),
    RESOURCE_DATA_FORMAT_INCORRECT=>
    array(
        'id'=>RESOURCE_DATA_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RESOURCE_DATA_FORMAT_INCORRECT',
        'title'=>'信用数据格式不正确, 请按照提示重新输入',
        'detail'=>'信用数据格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'data'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_FORMAT_INCORRECT',
        'title'=>'企业格式不正确, 请按照提示重新输入',
        'detail'=>'企业格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'enterprise'
        ),
        'meta'=>array()
    ),
    ORGANIZATION_FORMAT_INCORRECT=>
    array(
        'id'=>ORGANIZATION_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ORGANIZATION_FORMAT_INCORRECT',
        'title'=>'委办局格式不正确, 请按照提示重新输入',
        'detail'=>'委办局格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'organization'
        ),
        'meta'=>array()
    ),
    ORGANIZATION_NOT_EXISTS=>
    array(
        'id'=>ORGANIZATION_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'ORGANIZATION_NOT_EXISTS',
        'title'=>'委办局不存在, 请重新输入',
        'detail'=>'委办局不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'organization'
        ),
        'meta'=>array()
    ),
    USER_ACCOUNT_LOCKED=>
    array(
        'id'=>USER_ACCOUNT_LOCKED,
        'link'=>'',
        'status'=>403,
        'code'=>'USER_ACCOUNT_LOCKED',
        'title'=>'该账号已被锁定, 请30分钟后重新输入',
        'detail'=>'该账号已被锁定, 请30分钟后重新输入',
        'source'=>array(
            'pointer'=>'user'
        ),
        'meta'=>array()
    ),
    ORGANIZATION_SHORT_NAME_FORMAT_INCORRECT=>
    array(
        'id'=>ORGANIZATION_SHORT_NAME_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ORGANIZATION_SHORT_NAME_FORMAT_INCORRECT',
        'title'=>'简称格式不正确, 请按照提示重新输入',
        'detail'=>'简称格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'shortName'
        ),
        'meta'=>array()
    ),
    ORGANIZATION_JURISDICTION_AREA_FORMAT_INCORRECT=>
    array(
        'id'=>ORGANIZATION_JURISDICTION_AREA_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ORGANIZATION_JURISDICTION_AREA_FORMAT_INCORRECT',
        'title'=>'所属辖区格式不正确, 请按照提示重新输入',
        'detail'=>'所属辖区格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'jurisdictionArea'
        ),
        'meta'=>array()
    ),
    ORGANIZATION_NAME_EXISTS=>
    array(
        'id'=>ORGANIZATION_NAME_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'ORGANIZATION_NAME_EXISTS',
        'title'=>'名称已存在, 请重新输入',
        'detail'=>'名称已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'name'
        ),
        'meta'=>array()
    ),
    ORGANIZATION_SHORT_NAME_EXISTS=>
    array(
        'id'=>ORGANIZATION_SHORT_NAME_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'ORGANIZATION_SHORT_NAME_EXISTS',
        'title'=>'简称已存在, 请重新输入',
        'detail'=>'简称已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'shortName'
        ),
        'meta'=>array()
    ),
    ORGANIZATION_JURISDICTION_AREA_NOT_EXISTS=>
    array(
        'id'=>ORGANIZATION_JURISDICTION_AREA_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'ORGANIZATION_JURISDICTION_AREA_NOT_EXISTS',
        'title'=>'所属辖区不存在, 请重新输入',
        'detail'=>'所属辖区不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'jurisdictionArea'
        ),
        'meta'=>array()
    ),
    ORGANIZATION_UNIFIED_IDENTIFIER_EXISTS=>
    array(
        'id'=>ORGANIZATION_UNIFIED_IDENTIFIER_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'ORGANIZATION_UNIFIED_IDENTIFIER_EXISTS',
        'title'=>'统一社会信用代码已存在, 请重新输入',
        'detail'=>'统一社会信用代码已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'unifiedIdentifier'
        ),
        'meta'=>array()
    ),
    DEPARTMENT_ORGANIZATION_FORMAT_INCORRECT=>
    array(
        'id'=>DEPARTMENT_ORGANIZATION_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DEPARTMENT_ORGANIZATION_FORMAT_INCORRECT',
        'title'=>'所属委办局格式不正确, 请按照提示重新输入',
        'detail'=>'所属委办局格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'organization'
        ),
        'meta'=>array()
    ),
    DEPARTMENT_NAME_EXISTS=>
    array(
        'id'=>DEPARTMENT_NAME_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'DEPARTMENT_NAME_EXISTS',
        'title'=>'名称已存在, 请重新输入',
        'detail'=>'名称已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'name'
        ),
        'meta'=>array()
    ),
    DEPARTMENT_ORGANIZATION_NOT_EXISTS=>
    array(
        'id'=>DEPARTMENT_ORGANIZATION_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'DEPARTMENT_ORGANIZATION_NOT_EXISTS',
        'title'=>'所属委办局不存在, 请重新输入',
        'detail'=>'所属委办局不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'organization'
        ),
        'meta'=>array()
    ),
    ROLE_PURVIEW_FORMAT_INCORRECT=>
    array(
        'id'=>ROLE_PURVIEW_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ROLE_PURVIEW_FORMAT_INCORRECT',
        'title'=>'权限范围格式不正确, 请按照提示重新输入',
        'detail'=>'权限范围格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'purview'
        ),
        'meta'=>array()
    ),
    ROLE_NAME_EXISTS=>
    array(
        'id'=>ROLE_NAME_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'ROLE_NAME_EXISTS',
        'title'=>'名称已存在, 请重新输入',
        'detail'=>'名称已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'name'
        ),
        'meta'=>array()
    ),
    STAFF_CATEGORY_FORMAT_INCORRECT=>
    array(
        'id'=>STAFF_CATEGORY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'STAFF_CATEGORY_FORMAT_INCORRECT',
        'title'=>'用户类型格式不正确, 请按照提示重新输入',
        'detail'=>'用户类型格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'category'
        ),
        'meta'=>array()
    ),
    STAFF_ROLES_FORMAT_INCORRECT=>
    array(
        'id'=>STAFF_ROLES_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'STAFF_ROLES_FORMAT_INCORRECT',
        'title'=>'角色格式不正确, 请按照提示重新输入',
        'detail'=>'角色格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'roles'
        ),
        'meta'=>array()
    ),
    STAFF_ORGANIZATION_FORMAT_INCORRECT=>
    array(
        'id'=>STAFF_ORGANIZATION_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'STAFF_ORGANIZATION_FORMAT_INCORRECT',
        'title'=>'所属委办局格式不正确, 请按照提示重新输入',
        'detail'=>'所属委办局格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'organization'
        ),
        'meta'=>array()
    ),
    STAFF_DEPARTMENT_FORMAT_INCORRECT=>
    array(
        'id'=>STAFF_DEPARTMENT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'STAFF_DEPARTMENT_FORMAT_INCORRECT',
        'title'=>'所属科室格式不正确, 请按照提示重新输入',
        'detail'=>'所属科室格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'department'
        ),
        'meta'=>array()
    ),
    STAFF_CELLPHONE_EXISTS=>
    array(
        'id'=>STAFF_CELLPHONE_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'STAFF_CELLPHONE_EXISTS',
        'title'=>'手机号已存在, 请重新输入',
        'detail'=>'手机号已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'cellphone'
        ),
        'meta'=>array()
    ),
    STAFF_ORGANIZATION_NOT_EXISTS=>
    array(
        'id'=>STAFF_ORGANIZATION_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'STAFF_ORGANIZATION_NOT_EXISTS',
        'title'=>'所属委办局不存在, 请重新输入',
        'detail'=>'所属委办局不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'organization'
        ),
        'meta'=>array()
    ),
    STAFF_DEPARTMENT_NOT_EXISTS=>
    array(
        'id'=>STAFF_DEPARTMENT_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'STAFF_DEPARTMENT_NOT_EXISTS',
        'title'=>'所属科室不存在, 请重新输入',
        'detail'=>'所属科室不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'department'
        ),
        'meta'=>array()
    ),
    STAFF_ROLES_NOT_EXISTS=>
    array(
        'id'=>STAFF_ROLES_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'STAFF_ROLES_NOT_EXISTS',
        'title'=>'角色不存在, 请重新输入',
        'detail'=>'角色不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'roles'
        ),
        'meta'=>array()
    ),
    STAFF_NAVIGATION_FORMAT_INCORRECT=>
    array(
        'id'=>STAFF_NAVIGATION_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'STAFF_NAVIGATION_FORMAT_INCORRECT',
        'title'=>'快捷导航格式不正确, 请按照提示重新输入',
        'detail'=>'快捷导航格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'navigation'
        ),
        'meta'=>array()
    ),
    DICTIONARY_CATEGORY_FORMAT_INCORRECT=>
    array(
        'id'=>DICTIONARY_CATEGORY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DICTIONARY_CATEGORY_FORMAT_INCORRECT',
        'title'=>'所属分类格式不正确, 请按照提示重新输入',
        'detail'=>'所属分类格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'dictionaryCategory'
        ),
        'meta'=>array()
    ),
    DICTIONARY_ITEM_NAME_EXISTS=>
    array(
        'id'=>DICTIONARY_ITEM_NAME_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'DICTIONARY_ITEM_NAME_EXISTS',
        'title'=>'名称已存在, 请重新输入',
        'detail'=>'名称已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'name'
        ),
        'meta'=>array()
    ),
    DICTIONARY_CATEGORY_NOT_EXISTS=>
    array(
        'id'=>DICTIONARY_CATEGORY_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'DICTIONARY_CATEGORY_NOT_EXISTS',
        'title'=>'所属分类不存在, 请重新输入',
        'detail'=>'所属分类不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'dictSort'
        ),
        'meta'=>array()
    ),
    ARTICLE_CATEGORY_LEVEL_FORMAT_INCORRECT=>
    array(
        'id'=>ARTICLE_CATEGORY_LEVEL_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ARTICLE_CATEGORY_LEVEL_FORMAT_INCORRECT',
        'title'=>'等级格式不正确, 请按照提示重新输入',
        'detail'=>'等级格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'level'
        ),
        'meta'=>array()
    ),
    ARTICLE_CATEGORY_PARENT_CATEGORY_FORMAT_INCORRECT=>
    array(
        'id'=>ARTICLE_CATEGORY_PARENT_CATEGORY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ARTICLE_CATEGORY_PARENT_CATEGORY_FORMAT_INCORRECT',
        'title'=>'一级分类格式不正确, 请按照提示重新输入',
        'detail'=>'一级分类格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'parentCategory'
        ),
        'meta'=>array()
    ),
    ARTICLE_CATEGORY_NAME_EXISTS=>
    array(
        'id'=>ARTICLE_CATEGORY_NAME_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'ARTICLE_CATEGORY_NAME_EXISTS',
        'title'=>'名称已存在, 请重新输入',
        'detail'=>'名称已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'name'
        ),
        'meta'=>array()
    ),
    ARTICLE_CATEGORY_PARENT_CATEGORY_NOT_EXISTS=>
    array(
        'id'=>ARTICLE_CATEGORY_PARENT_CATEGORY_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'ARTICLE_CATEGORY_PARENT_CATEGORY_NOT_EXISTS',
        'title'=>'一级分类不存在, 请重新输入',
        'detail'=>'一级分类不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'parentCategory'
        ),
        'meta'=>array()
    ),
    ARTICLE_CATEGORY_STYLE_FORMAT_INCORRECT=>
    array(
        'id'=>ARTICLE_CATEGORY_STYLE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ARTICLE_CATEGORY_STYLE_FORMAT_INCORRECT',
        'title'=>'风格格式不正确, 请按照提示重新输入',
        'detail'=>'风格格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'style'
        ),
        'meta'=>array()
    ),
    ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT=>
    array(
        'id'=>ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT',
        'title'=>'自定义内容格式不正确, 请按照提示重新输入',
        'detail'=>'自定义内容格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'diyContent'
        ),
        'meta'=>array()
    ),
    ARTICLE_SOURCE_FORMAT_INCORRECT=>
    array(
        'id'=>ARTICLE_SOURCE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ARTICLE_SOURCE_FORMAT_INCORRECT',
        'title'=>'来源格式不正确, 请按照提示重新输入',
        'detail'=>'来源格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'source'
        ),
        'meta'=>array()
    ),
    ARTICLE_CATEGORY_FORMAT_INCORRECT=>
    array(
        'id'=>ARTICLE_CATEGORY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ARTICLE_CATEGORY_FORMAT_INCORRECT',
        'title'=>'二级分类格式不正确, 请按照提示重新输入',
        'detail'=>'二级分类格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'category'
        ),
        'meta'=>array()
    ),
    ARTICLE_PUB_DATE_FORMAT_INCORRECT=>
    array(
        'id'=>ARTICLE_PUB_DATE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ARTICLE_PUB_DATE_FORMAT_INCORRECT',
        'title'=>'发布时间格式不正确, 请按照提示重新输入',
        'detail'=>'发布时间格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'pubDate'
        ),
        'meta'=>array()
    ),
    ARTICLE_ATTACHMENTS_FORMAT_INCORRECT=>
    array(
        'id'=>ARTICLE_ATTACHMENTS_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ARTICLE_ATTACHMENTS_FORMAT_INCORRECT',
        'title'=>'附件格式不正确, 请按照提示重新输入',
        'detail'=>'附件格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'attachments'
        ),
        'meta'=>array()
    ),
    ARTICLE_ATTACHMENTS_COUNT_INCORRECT=>
    array(
        'id'=>ARTICLE_ATTACHMENTS_COUNT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ARTICLE_ATTACHMENTS_COUNT_INCORRECT',
        'title'=>'附件数量不正确, 请按照提示重新输入',
        'detail'=>'附件数量不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'attachments'
        ),
        'meta'=>array()
    ),
    ARTICLE_IS_SLIDES_FORMAT_INCORRECT=>
    array(
        'id'=>ARTICLE_IS_SLIDES_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ARTICLE_IS_SLIDES_FORMAT_INCORRECT',
        'title'=>'是否设为轮播格式不正确, 请按照提示重新输入',
        'detail'=>'是否设为轮播格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'isSlides'
        ),
        'meta'=>array()
    ),
    ARTICLE_IS_HOME_SLIDES_FORMAT_INCORRECT=>
    array(
        'id'=>ARTICLE_IS_HOME_SLIDES_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ARTICLE_IS_HOME_SLIDES_FORMAT_INCORRECT',
        'title'=>'是否设为首页轮播格式不正确, 请按照提示重新输入',
        'detail'=>'是否设为首页轮播格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'isHomeSlides'
        ),
        'meta'=>array()
    ),
    ARTICLE_CATEGORY_NOT_EXISTS=>
    array(
        'id'=>ARTICLE_CATEGORY_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'ARTICLE_CATEGORY_NOT_EXISTS',
        'title'=>'二级分类不存在, 请重新输入',
        'detail'=>'二级分类不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'category'
        ),
        'meta'=>array()
    ),
    ARTICLE_CONTENT_COUNT_INCORRECT=>
    array(
        'id'=>ARTICLE_CONTENT_COUNT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ARTICLE_CONTENT_COUNT_INCORRECT',
        'title'=>'内容数量不正确, 请按照提示重新输入',
        'detail'=>'内容数量不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'content'
        ),
        'meta'=>array()
    ),
    MEMBER_GENDER_FORMAT_INCORRECT=>
    array(
        'id'=>MEMBER_GENDER_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'MEMBER_GENDER_FORMAT_INCORRECT',
        'title'=>'性别格式不正确, 请按照提示重新输入',
        'detail'=>'性别格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'gender'
        ),
        'meta'=>array()
    ),
    MEMBER_EMAIL_FORMAT_INCORRECT=>
    array(
        'id'=>MEMBER_EMAIL_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'MEMBER_EMAIL_FORMAT_INCORRECT',
        'title'=>'邮箱格式不正确, 请按照提示重新输入',
        'detail'=>'邮箱格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'email'
        ),
        'meta'=>array()
    ),
    MEMBER_ADDRESS_FORMAT_INCORRECT=>
    array(
        'id'=>MEMBER_ADDRESS_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'MEMBER_ADDRESS_FORMAT_INCORRECT',
        'title'=>'地址格式不正确, 请按照提示重新输入',
        'detail'=>'地址格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'address'
        ),
        'meta'=>array()
    ),
    MEMBER_QUESTION_FORMAT_INCORRECT=>
    array(
        'id'=>MEMBER_QUESTION_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'MEMBER_QUESTION_FORMAT_INCORRECT',
        'title'=>'密保问题格式不正确, 请按照提示重新输入',
        'detail'=>'密保问题格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'question'
        ),
        'meta'=>array()
    ),
    MEMBER_ANSWER_FORMAT_INCORRECT=>
    array(
        'id'=>MEMBER_ANSWER_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'MEMBER_ANSWER_FORMAT_INCORRECT',
        'title'=>'密保答案格式不正确, 请按照提示重新输入',
        'detail'=>'密保答案格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'answer'
        ),
        'meta'=>array()
    ),
    MEMBER_CELLPHONE_EXISTS=>
    array(
        'id'=>MEMBER_CELLPHONE_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'MEMBER_CELLPHONE_EXISTS',
        'title'=>'手机号已存在, 请重新输入',
        'detail'=>'手机号已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'cellphone'
        ),
        'meta'=>array()
    ),
    MEMBER_ID_CARD_EXISTS=>
    array(
        'id'=>MEMBER_ID_CARD_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'MEMBER_ID_CARD_EXISTS',
        'title'=>'身份证号已存在, 请重新输入',
        'detail'=>'身份证号已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'idCard'
        ),
        'meta'=>array()
    ),
    MEMBER_ANSWER_INCORRECT=>
    array(
        'id'=>MEMBER_ANSWER_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'MEMBER_ANSWER_INCORRECT',
        'title'=>'密保答案不正确, 请重新输入',
        'detail'=>'密保答案不正确, 请重新输入',
        'source'=>array(
            'pointer'=>'answer'
        ),
        'meta'=>array()
    ),
    DIRECTORY_NAME_FORMAT_INCORRECT=>
    array(
        'id'=>DIRECTORY_NAME_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_NAME_FORMAT_INCORRECT',
        'title'=>'目录名称格式不正确, 请按照提示重新输入',
        'detail'=>'目录名称格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'name'
        ),
        'meta'=>array()
    ),
    DIRECTORY_IDENTIFY_FORMAT_INCORRECT=>
    array(
        'id'=>DIRECTORY_IDENTIFY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_IDENTIFY_FORMAT_INCORRECT',
        'title'=>'目录标识格式不正确, 请按照提示重新输入',
        'detail'=>'目录标识格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'identify'
        ),
        'meta'=>array()
    ),
    DIRECTORY_SUBJECT_CATEGORY_FORMAT_INCORRECT=>
    array(
        'id'=>DIRECTORY_SUBJECT_CATEGORY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_SUBJECT_CATEGORY_FORMAT_INCORRECT',
        'title'=>'信用主体类别格式不正确, 请按照提示重新输入',
        'detail'=>'信用主体类别格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'subjectCategory'
        ),
        'meta'=>array()
    ),
    DIRECTORY_INFO_CATEGORY_FORMAT_INCORRECT=>
    array(
        'id'=>DIRECTORY_INFO_CATEGORY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_INFO_CATEGORY_FORMAT_INCORRECT',
        'title'=>'信息类别格式不正确, 请按照提示重新输入',
        'detail'=>'信息类别格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'infoCategory'
        ),
        'meta'=>array()
    ),
    DIRECTORY_SOURCE_UNITS_FORMAT_INCORRECT=>
    array(
        'id'=>DIRECTORY_SOURCE_UNITS_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_SOURCE_UNITS_FORMAT_INCORRECT',
        'title'=>'来源单位格式不正确, 请按照提示重新输入',
        'detail'=>'来源单位格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'sourceUnits'
        ),
        'meta'=>array()
    ),
    DIRECTORY_ITEMS_FORMAT_INCORRECT=>
    array(
        'id'=>DIRECTORY_ITEMS_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_ITEMS_FORMAT_INCORRECT',
        'title'=>'模板信息格式不正确, 请按照提示重新输入',
        'detail'=>'模板信息格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'items'
        ),
        'meta'=>array()
    ),
    DIRECTORY_NAME_EXISTS=>
    array(
        'id'=>DIRECTORY_NAME_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_NAME_EXISTS',
        'title'=>'目录名称已存在, 请重新输入',
        'detail'=>'目录名称已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'name'
        ),
        'meta'=>array()
    ),
    DIRECTORY_IDENTIFY_EXISTS=>
    array(
        'id'=>DIRECTORY_IDENTIFY_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_IDENTIFY_EXISTS',
        'title'=>'目录标识已存在, 请重新输入',
        'detail'=>'目录标识已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'identify'
        ),
        'meta'=>array()
    ),
    DIRECTORY_ITEMS_NAME_FORMAT_INCORRECT=>
    array(
        'id'=>DIRECTORY_ITEMS_NAME_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_ITEMS_NAME_FORMAT_INCORRECT',
        'title'=>'字段名称格式不正确, 请按照提示重新输入',
        'detail'=>'字段名称格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'itemsName'
        ),
        'meta'=>array()
    ),
    DIRECTORY_ITEMS_IDENTIFY_FORMAT_INCORRECT=>
    array(
        'id'=>DIRECTORY_ITEMS_IDENTIFY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_ITEMS_IDENTIFY_FORMAT_INCORRECT',
        'title'=>'字段标识格式不正确, 请按照提示重新输入',
        'detail'=>'字段标识格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'itemsIdentify'
        ),
        'meta'=>array()
    ),
    DIRECTORY_ITEMS_NAME_EXISTS=>
    array(
        'id'=>DIRECTORY_ITEMS_NAME_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_ITEMS_NAME_EXISTS',
        'title'=>'字段名称已存在, 请重新输入',
        'detail'=>'字段名称已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'itemsName'
        ),
        'meta'=>array()
    ),
    DIRECTORY_ITEMS_IDENTIFY_EXISTS=>
    array(
        'id'=>DIRECTORY_ITEMS_IDENTIFY_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_ITEMS_IDENTIFY_EXISTS',
        'title'=>'字段标识已存在, 请重新输入',
        'detail'=>'字段标识已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'itemsIdentify'
        ),
        'meta'=>array()
    ),
    DIRECTORY_ITEMS_DATA_TYPE_FORMAT_INCORRECT=>
    array(
        'id'=>DIRECTORY_ITEMS_DATA_TYPE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_ITEMS_DATA_TYPE_FORMAT_INCORRECT',
        'title'=>'数据类型格式不正确, 请按照提示重新输入',
        'detail'=>'数据类型格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'itemsDataType'
        ),
        'meta'=>array()
    ),
    DIRECTORY_ITEMS_DATA_LENGTH_FORMAT_INCORRECT=>
    array(
        'id'=>DIRECTORY_ITEMS_DATA_LENGTH_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_ITEMS_DATA_LENGTH_FORMAT_INCORRECT',
        'title'=>'数据长度格式不正确, 请按照提示重新输入',
        'detail'=>'数据长度格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'itemsDataLength'
        ),
        'meta'=>array()
    ),
    DIRECTORY_ITEMS_OPTIONAL_RANGE_FORMAT_INCORRECT=>
    array(
        'id'=>DIRECTORY_ITEMS_OPTIONAL_RANGE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_ITEMS_OPTIONAL_RANGE_FORMAT_INCORRECT',
        'title'=>'可选范围格式不正确, 请按照提示重新输入',
        'detail'=>'可选范围格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'itemsOptionalRange'
        ),
        'meta'=>array()
    ),
    DIRECTORY_ITEMS_REQUIRED_FORMAT_INCORRECT=>
    array(
        'id'=>DIRECTORY_ITEMS_REQUIRED_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_ITEMS_REQUIRED_FORMAT_INCORRECT',
        'title'=>'是否必填状态格式不正确, 请按照提示重新输入',
        'detail'=>'是否必填状态格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'itemsRequired'
        ),
        'meta'=>array()
    ),
    DIRECTORY_ITEMS_DESENSITIZATION_FORMAT_INCORRECT=>
    array(
        'id'=>DIRECTORY_ITEMS_DESENSITIZATION_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_ITEMS_DESENSITIZATION_FORMAT_INCORRECT',
        'title'=>'是否脱敏状态格式不正确, 请按照提示重新输入',
        'detail'=>'是否脱敏状态格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'itemsDesensitization'
        ),
        'meta'=>array()
    ),
    DIRECTORY_ITEMS_DESENSITIZATION_RULE_FORMAT_INCORRECT=>
    array(
        'id'=>DIRECTORY_ITEMS_DESENSITIZATION_RULE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_ITEMS_DESENSITIZATION_RULE_FORMAT_INCORRECT',
        'title'=>'脱敏规则格式不正确, 请按照提示重新输入',
        'detail'=>'脱敏规则格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'itemsDesensitizationRule'
        ),
        'meta'=>array()
    ),
    DIRECTORY_ITEMS_PUBLICATION_RANGE_FORMAT_INCORRECT=>
    array(
        'id'=>DIRECTORY_ITEMS_PUBLICATION_RANGE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_ITEMS_PUBLICATION_RANGE_FORMAT_INCORRECT',
        'title'=>'公开范围格式不正确, 请按照提示重新输入',
        'detail'=>'公开范围格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'itemsPublicationRange'
        ),
        'meta'=>array()
    ),
    DIRECTORY_ITEMS_COUNT_INCORRECT=>
    array(
        'id'=>DIRECTORY_ITEMS_COUNT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_ITEMS_COUNT_INCORRECT',
        'title'=>'模板信息数量不正确, 请按照提示重新输入',
        'detail'=>'模板信息数量不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'itemsCount'
        ),
        'meta'=>array()
    ),
    DIRECTORY_ITEMS_REMARKS_FORMAT_INCORRECT=>
    array(
        'id'=>DIRECTORY_ITEMS_REMARKS_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_ITEMS_REMARKS_FORMAT_INCORRECT',
        'title'=>'备注格式不正确, 请按照提示重新输入',
        'detail'=>'备注格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'itemsRemarks'
        ),
        'meta'=>array()
    ),
    DIRECTORY_ITEMS_SUBJECT_NAME_IDENTIFY_FORMAT_INCORRECT=>
    array(
        'id'=>DIRECTORY_ITEMS_SUBJECT_NAME_IDENTIFY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_ITEMS_SUBJECT_NAME_IDENTIFY_FORMAT_INCORRECT',
        'title'=>'模板信息中必须包含ZTMC,TYSHXYDM/ZJHM, 请按照提示重新输入',
        'detail'=>'模板信息中必须包含ZTMC,TYSHXYDM/ZJHM, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'items'
        ),
        'meta'=>array()
    ),
    DIRECTORY_SOURCE_UNITS_NOT_EXISTS=>
    array(
        'id'=>DIRECTORY_SOURCE_UNITS_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_SOURCE_UNITS_NOT_EXISTS',
        'title'=>'来源单位不存在, 请重新输入',
        'detail'=>'来源单位不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'sourceUnits'
        ),
        'meta'=>array()
    ),
    DIRECTORY_SNAPSHOT_FORMAT_INCORRECT=>
    array(
        'id'=>DIRECTORY_SNAPSHOT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_SNAPSHOT_FORMAT_INCORRECT',
        'title'=>'快照格式不正确, 请按照提示重新输入',
        'detail'=>'快照格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'snapshot'
        ),
        'meta'=>array()
    ),
    DIRECTORY_SNAPSHOT_NOT_EXISTS=>
    array(
        'id'=>DIRECTORY_SNAPSHOT_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_SNAPSHOT_NOT_EXISTS',
        'title'=>'快照不存在, 请重新输入',
        'detail'=>'快照不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'snapshot'
        ),
        'meta'=>array()
    ),
    DIRECTORY_EXISTS=>
    array(
        'id'=>DIRECTORY_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'DIRECTORY_EXISTS',
        'title'=>'目录已存在, 请重新输入',
        'detail'=>'目录已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'directory'
        ),
        'meta'=>array()
    ),
    HELP_PAGE_CONFIG_STYLE_FORMAT_INCORRECT=>
    array(
        'id'=>HELP_PAGE_CONFIG_STYLE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'HELP_PAGE_CONFIG_STYLE_FORMAT_INCORRECT',
        'title'=>'风格格式不正确, 请按照提示重新输入',
        'detail'=>'风格格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'style'
        ),
        'meta'=>array()
    ),
    HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT=>
    array(
        'id'=>HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT',
        'title'=>'自定义内容格式不正确, 请按照提示重新输入',
        'detail'=>'自定义内容格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'diyContent'
        ),
        'meta'=>array()
    ),
    HELP_PAGE_CONFIG_TITLE_EXISTS=>
    array(
        'id'=>HELP_PAGE_CONFIG_TITLE_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'HELP_PAGE_CONFIG_TITLE_EXISTS',
        'title'=>'标题已存在, 请重新输入',
        'detail'=>'标题已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'title'
        ),
        'meta'=>array()
    ),
    HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT=>
    array(
        'id'=>HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT',
        'title'=>'自定义内容格式不正确, 请按照提示重新输入',
        'detail'=>'自定义内容格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'diyContent'
        ),
        'meta'=>array()
    ),
    DATA_IDENTIFY_FORMAT_INCORRECT=>
    array(
        'id'=>DATA_IDENTIFY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DATA_IDENTIFY_FORMAT_INCORRECT',
        'title'=>'主体代码格式不正确, 请按照提示重新输入',
        'detail'=>'主体代码格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'identify'
        ),
        'meta'=>array()
    ),
    DATA_SUBJECT_CATEGORY_FORMAT_INCORRECT=>
    array(
        'id'=>DATA_SUBJECT_CATEGORY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DATA_SUBJECT_CATEGORY_FORMAT_INCORRECT',
        'title'=>'信用主体类别格式不正确, 请按照提示重新输入',
        'detail'=>'信用主体类别格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'subjectCategory'
        ),
        'meta'=>array()
    ),
    DATA_INFO_CATEGORY_FORMAT_INCORRECT=>
    array(
        'id'=>DATA_INFO_CATEGORY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DATA_INFO_CATEGORY_FORMAT_INCORRECT',
        'title'=>'信息类别格式不正确, 请按照提示重新输入',
        'detail'=>'信息类别格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'infoCategory'
        ),
        'meta'=>array()
    ),
    DATA_PUBLICATION_RANGE_FORMAT_INCORRECT=>
    array(
        'id'=>DATA_PUBLICATION_RANGE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DATA_PUBLICATION_RANGE_FORMAT_INCORRECT',
        'title'=>'公开范围格式不正确, 请按照提示重新输入',
        'detail'=>'公开范围格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'publicationRange'
        ),
        'meta'=>array()
    ),
    DATA_EXPIRE_DATE_FORMAT_INCORRECT=>
    array(
        'id'=>DATA_EXPIRE_DATE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DATA_EXPIRE_DATE_FORMAT_INCORRECT',
        'title'=>'有效期限格式不正确, 请按照提示重新输入',
        'detail'=>'有效期限格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'expireDate'
        ),
        'meta'=>array()
    ),
    DATA_ITEMS_FORMAT_INCORRECT=>
    array(
        'id'=>DATA_ITEMS_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DATA_ITEMS_FORMAT_INCORRECT',
        'title'=>'模板数据信息格式不正确, 请按照提示重新输入',
        'detail'=>'模板数据信息格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'items'
        ),
        'meta'=>array()
    ),
    DATA_DIRECTORY_FORMAT_INCORRECT=>
    array(
        'id'=>DATA_DIRECTORY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DATA_DIRECTORY_FORMAT_INCORRECT',
        'title'=>'目录格式不正确, 请按照提示重新输入',
        'detail'=>'目录格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'directory'
        ),
        'meta'=>array()
    ),
    DATA_DIRECTORY_NOT_EXISTS=>
    array(
        'id'=>DATA_DIRECTORY_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'DATA_DIRECTORY_NOT_EXISTS',
        'title'=>'目录不存在, 请重新输入',
        'detail'=>'目录不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'directory'
        ),
        'meta'=>array()
    ),
    DATA_DIRECTORY_SNAPSHOT_NOT_EXISTS=>
    array(
        'id'=>DATA_DIRECTORY_SNAPSHOT_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'DATA_DIRECTORY_SNAPSHOT_NOT_EXISTS',
        'title'=>'目录快照不存在, 请重新输入',
        'detail'=>'目录快照不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'directorySnapshot'
        ),
        'meta'=>array()
    ),
    DATA_EXISTS=>
    array(
        'id'=>DATA_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'DATA_EXISTS',
        'title'=>'数据已存在, 请重新输入',
        'detail'=>'数据已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'data'
        ),
        'meta'=>array()
    ),
    DATA_ITEMS_COUNT_FORMAT_INCORRECT=>
    array(
        'id'=>DATA_ITEMS_COUNT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'DATA_ITEMS_COUNT_FORMAT_INCORRECT',
        'title'=>'模板信息数量与目录模板信息数量不匹配, 请重新输入',
        'detail'=>'模板信息数量与目录模板信息数量不匹配, 请重新输入',
        'source'=>array(
            'pointer'=>'items'
        ),
        'meta'=>array()
    ),
    UPLOAD_DATA_TASK_NAME_FORMAT_INCORRECT=>
    array(
        'id'=>UPLOAD_DATA_TASK_NAME_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'UPLOAD_DATA_TASK_NAME_FORMAT_INCORRECT',
        'title'=>'文件名称格式不正确, 请按照提示重新输入',
        'detail'=>'文件名称格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'name'
        ),
        'meta'=>array()
    ),
    UPLOAD_DATA_TASK_NAME_EXISTS=>
    array(
        'id'=>UPLOAD_DATA_TASK_NAME_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'UPLOAD_DATA_TASK_NAME_EXISTS',
        'title'=>'文件重复, 请重新输入',
        'detail'=>'文件重复, 请重新输入',
        'source'=>array(
            'pointer'=>'name'
        ),
        'meta'=>array()
    ),
    UPLOAD_DATA_TASK_NAME_NOT_EXISTS=>
    array(
        'id'=>UPLOAD_DATA_TASK_NAME_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'UPLOAD_DATA_TASK_NAME_NOT_EXISTS',
        'title'=>'文件不存在, 请重新输入',
        'detail'=>'文件不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'name'
        ),
        'meta'=>array()
    ),
    UPLOAD_DATA_TASK_DIRECTORY_FORMAT_INCORRECT=>
    array(
        'id'=>UPLOAD_DATA_TASK_DIRECTORY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'UPLOAD_DATA_TASK_DIRECTORY_FORMAT_INCORRECT',
        'title'=>'目录格式不正确, 请按照提示重新输入',
        'detail'=>'目录格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'directory'
        ),
        'meta'=>array()
    ),
    UPLOAD_DATA_TASK_DIRECTORY_NOT_EXISTS=>
    array(
        'id'=>UPLOAD_DATA_TASK_DIRECTORY_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'UPLOAD_DATA_TASK_DIRECTORY_NOT_EXISTS',
        'title'=>'目录不存在, 请重新输入',
        'detail'=>'目录不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'directory'
        ),
        'meta'=>array()
    ),
    STAFF_NOT_BELONG_TO_DIRECTORY_SOURCE_UNITS=>
    array(
        'id'=>STAFF_NOT_BELONG_TO_DIRECTORY_SOURCE_UNITS,
        'link'=>'',
        'status'=>403,
        'code'=>'STAFF_NOT_BELONG_TO_DIRECTORY_SOURCE_UNITS',
        'title'=>'员工不属于目录来源单位',
        'detail'=>'员工不属于目录来源单位',
        'source'=>array(
            'pointer'=>'directory'
        ),
        'meta'=>array()
    ),
    UPLOAD_FILE_EXCEED_MAX_LINES_LIMIT=>
    array(
        'id'=>UPLOAD_FILE_EXCEED_MAX_LINES_LIMIT,
        'link'=>'',
        'status'=>403,
        'code'=>'UPLOAD_FILE_EXCEED_MAX_LINES_LIMIT',
        'title'=>'上传文件超过最大行数限制, 请按照提示重新输入',
        'detail'=>'上传文件超过最大行数限制, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'name'
        ),
        'meta'=>array()
    ),
    EXPORT_DATA_TASK_SIZE_FORMAT_INCORRECT=>
    array(
        'id'=>EXPORT_DATA_TASK_SIZE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EXPORT_DATA_TASK_SIZE_FORMAT_INCORRECT',
        'title'=>'导出数量格式不正确, 请按照提示重新输入',
        'detail'=>'导出数量格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'size'
        ),
        'meta'=>array()
    ),
    EXPORT_DATA_TASK_OFFSET_FORMAT_INCORRECT=>
    array(
        'id'=>EXPORT_DATA_TASK_OFFSET_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EXPORT_DATA_TASK_OFFSET_FORMAT_INCORRECT',
        'title'=>'起始数量格式不正确, 请按照提示重新输入',
        'detail'=>'起始数量格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'offset'
        ),
        'meta'=>array()
    ),
    EXPORT_DATA_TASK_NAME_NOT_EXISTS=>
    array(
        'id'=>EXPORT_DATA_TASK_NAME_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'EXPORT_DATA_TASK_NAME_NOT_EXISTS',
        'title'=>'文件不存在, 请重新输入',
        'detail'=>'文件不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'name'
        ),
        'meta'=>array()
    ),
    EXPORT_DATA_TASK_DIRECTORY_SNAPSHOT_FORMAT_INCORRECT=>
    array(
        'id'=>EXPORT_DATA_TASK_DIRECTORY_SNAPSHOT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EXPORT_DATA_TASK_DIRECTORY_SNAPSHOT_FORMAT_INCORRECT',
        'title'=>'目录快照格式不正确, 请按照提示重新输入',
        'detail'=>'目录快照格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'directorySnapshot'
        ),
        'meta'=>array()
    ),
    EXPORT_DATA_TASK_DIRECTORY_SNAPSHOT_NOT_EXISTS=>
    array(
        'id'=>EXPORT_DATA_TASK_DIRECTORY_SNAPSHOT_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'EXPORT_DATA_TASK_DIRECTORY_SNAPSHOT_NOT_EXISTS',
        'title'=>'目录快照不存在, 请重新输入',
        'detail'=>'目录快照不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'directorySnapshot'
        ),
        'meta'=>array()
    ),
    EXPORT_DATA_SIZE_EXCEED_MAX_LINES_LIMIT=>
    array(
        'id'=>EXPORT_DATA_SIZE_EXCEED_MAX_LINES_LIMIT,
        'link'=>'',
        'status'=>403,
        'code'=>'EXPORT_DATA_SIZE_EXCEED_MAX_LINES_LIMIT',
        'title'=>'导出数量超过最大限制, 请按照提示重新输入',
        'detail'=>'导出数量超过最大限制, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'offset'
        ),
        'meta'=>array()
    ),
    COMMITMENT_CODE_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_CODE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_CODE_FORMAT_INCORRECT',
        'title'=>'承诺编码格式不正确, 请按照提示重新输入',
        'detail'=>'承诺编码格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'code'
        ),
        'meta'=>array()
    ),
    COMMITMENT_SUBJECT_NAME_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_SUBJECT_NAME_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_SUBJECT_NAME_FORMAT_INCORRECT',
        'title'=>'承诺人名称格式不正确, 请按照提示重新输入',
        'detail'=>'承诺人名称格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'subjectName'
        ),
        'meta'=>array()
    ),
    COMMITMENT_SUBJECT_CATEGORY_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_SUBJECT_CATEGORY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_SUBJECT_CATEGORY_FORMAT_INCORRECT',
        'title'=>'承诺人类别格式不正确, 请按照提示重新输入',
        'detail'=>'承诺人类别格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'subjectCategory'
        ),
        'meta'=>array()
    ),
    COMMITMENT_IDENTIFY_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_IDENTIFY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_IDENTIFY_FORMAT_INCORRECT',
        'title'=>'承诺人代码格式不正确, 请按照提示重新输入',
        'detail'=>'承诺人代码格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'identify'
        ),
        'meta'=>array()
    ),
    COMMITMENT_TYPE_ID_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_TYPE_ID_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_TYPE_ID_FORMAT_INCORRECT',
        'title'=>'承诺类型格式不正确, 请按照提示重新输入',
        'detail'=>'承诺类型格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'commitmentTypeId'
        ),
        'meta'=>array()
    ),
    COMMITMENT_TYPE_OTHER_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_TYPE_OTHER_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_TYPE_OTHER_FORMAT_INCORRECT',
        'title'=>'承诺类型-其他具体类型格式不正确, 请按照提示重新输入',
        'detail'=>'承诺类型-其他具体类型格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'commitmentTypeOther'
        ),
        'meta'=>array()
    ),
    COMMITMENT_REASON_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_REASON_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_REASON_FORMAT_INCORRECT',
        'title'=>'承诺事由格式不正确, 请按照提示重新输入',
        'detail'=>'承诺事由格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'reason'
        ),
        'meta'=>array()
    ),
    COMMITMENT_CONTENT_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_CONTENT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_CONTENT_FORMAT_INCORRECT',
        'title'=>'承诺内容格式不正确, 请按照提示重新输入',
        'detail'=>'承诺内容格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'content'
        ),
        'meta'=>array()
    ),
    COMMITMENT_LIABILITY_BREACH_COMMITMENT_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_LIABILITY_BREACH_COMMITMENT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_LIABILITY_BREACH_COMMITMENT_FORMAT_INCORRECT',
        'title'=>'违诺责任格式不正确, 请按照提示重新输入',
        'detail'=>'违诺责任格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'liabilityBreachCommitment'
        ),
        'meta'=>array()
    ),
    COMMITMENT_DATE_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_DATE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_DATE_FORMAT_INCORRECT',
        'title'=>'承诺作出日期格式不正确, 请按照提示重新输入',
        'detail'=>'承诺作出日期格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'commitmentDate'
        ),
        'meta'=>array()
    ),
    COMMITMENT_ACCEPTANCE_UNIT_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_ACCEPTANCE_UNIT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_ACCEPTANCE_UNIT_FORMAT_INCORRECT',
        'title'=>'承诺受理单位格式不正确, 请按照提示重新输入',
        'detail'=>'承诺受理单位格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'acceptanceUnit'
        ),
        'meta'=>array()
    ),
    COMMITMENT_ACCEPTANCE_UNIT_IDENTIFY_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_ACCEPTANCE_UNIT_IDENTIFY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_ACCEPTANCE_UNIT_IDENTIFY_FORMAT_INCORRECT',
        'title'=>'承诺受理单位代码格式不正确, 请按照提示重新输入',
        'detail'=>'承诺受理单位代码格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'acceptanceUnitIdentify'
        ),
        'meta'=>array()
    ),
    COMMITMENT_PUBLICATION_TYPE_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_PUBLICATION_TYPE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_PUBLICATION_TYPE_FORMAT_INCORRECT',
        'title'=>'公开类型格式不正确, 请按照提示重新输入',
        'detail'=>'公开类型格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'publicationType'
        ),
        'meta'=>array()
    ),
    COMMITMENT_REMARKS_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_REMARKS_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_REMARKS_FORMAT_INCORRECT',
        'title'=>'备注格式不正确, 请按照提示重新输入',
        'detail'=>'备注格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'remarks'
        ),
        'meta'=>array()
    ),
    COMMITMENT_FULFILLMENT_STATUS_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_FULFILLMENT_STATUS_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_FULFILLMENT_STATUS_FORMAT_INCORRECT',
        'title'=>'承诺履行状态格式不正确, 请按照提示重新输入',
        'detail'=>'承诺履行状态格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'fulfillmentStatus'
        ),
        'meta'=>array()
    ),
    COMMITMENT_UNPERFORMED_COMMITMENT_CONTENT_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_UNPERFORMED_COMMITMENT_CONTENT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_UNPERFORMED_COMMITMENT_CONTENT_FORMAT_INCORRECT',
        'title'=>'未履行的承诺内容格式不正确, 请按照提示重新输入',
        'detail'=>'未履行的承诺内容格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'unperformedCommitmentContent'
        ),
        'meta'=>array()
    ),
    COMMITMENT_LIABILITY_BREACH_COMMITMENT_CONTENT_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_LIABILITY_BREACH_COMMITMENT_CONTENT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_LIABILITY_BREACH_COMMITMENT_CONTENT_FORMAT_INCORRECT',
        'title'=>'违诺责任追究内容格式不正确, 请按照提示重新输入',
        'detail'=>'违诺责任追究内容格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'liabilityBreachCommitmentContent'
        ),
        'meta'=>array()
    ),
    COMMITMENT_FULFILLMENT_STATUS_DATE_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_FULFILLMENT_STATUS_DATE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_FULFILLMENT_STATUS_DATE_FORMAT_INCORRECT',
        'title'=>'承诺履行状态认定日期格式不正确, 请按照提示重新输入',
        'detail'=>'承诺履行状态认定日期格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'fulfillmentStatusDate'
        ),
        'meta'=>array()
    ),
    COMMITMENT_ACCEPTANCE_CONFIRM_UNIT_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_ACCEPTANCE_CONFIRM_UNIT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_ACCEPTANCE_CONFIRM_UNIT_FORMAT_INCORRECT',
        'title'=>'承诺履行状态认定单位格式不正确, 请按照提示重新输入',
        'detail'=>'承诺履行状态认定单位格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'acceptanceConfirmUnit'
        ),
        'meta'=>array()
    ),
    COMMITMENT_ACCEPTANCE_CONFIRM_UNIT_IDENTIFY_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_ACCEPTANCE_CONFIRM_UNIT_IDENTIFY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_ACCEPTANCE_CONFIRM_UNIT_IDENTIFY_FORMAT_INCORRECT',
        'title'=>'承诺履行状态认定单位代码格式不正确, 请按照提示重新输入',
        'detail'=>'承诺履行状态认定单位代码格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'acceptanceConfirmUnitIdentify'
        ),
        'meta'=>array()
    ),
    COMMITMENT_SUPERVISE_STATUS_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_SUPERVISE_STATUS_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_SUPERVISE_STATUS_FORMAT_INCORRECT',
        'title'=>'承诺监管状态格式不正确, 请按照提示重新输入',
        'detail'=>'承诺监管状态格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'superviseStatus'
        ),
        'meta'=>array()
    ),
    COMMITMENT_NOT_EXISTS=>
    array(
        'id'=>COMMITMENT_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_NOT_EXISTS',
        'title'=>'信用承诺不存在, 请重新输入',
        'detail'=>'信用承诺不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'commitment'
        ),
        'meta'=>array()
    ),
    COMMITMENT_EXISTS=>
    array(
        'id'=>COMMITMENT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_EXISTS',
        'title'=>'信用承诺已存在, 请重新输入',
        'detail'=>'信用承诺已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'commitment'
        ),
        'meta'=>array()
    ),
    COMMITMENT_VALIDITY_FORMAT_INCORRECT=>
    array(
        'id'=>COMMITMENT_VALIDITY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'COMMITMENT_VALIDITY_FORMAT_INCORRECT',
        'title'=>'承诺有效期格式不正确, 请按照提示重新输入',
        'detail'=>'承诺有效期格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'commitmentValidity'
        ),
        'meta'=>array()
    ),
    PROMISE_EXISTS=>
    array(
        'id'=>PROMISE_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'PROMISE_EXISTS',
        'title'=>'履约践诺已存在, 请重新输入',
        'detail'=>'履约践诺已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'promise'
        ),
        'meta'=>array()
    ),
    APPLICATION_EXPORT_DATA_TASK_CATEGORY_FORMAT_INCORRECT=>
    array(
        'id'=>APPLICATION_EXPORT_DATA_TASK_CATEGORY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'APPLICATION_EXPORT_DATA_TASK_CATEGORY_FORMAT_INCORRECT',
        'title'=>'应用数据导出任务类型格式不正确, 请按照提示重新输入',
        'detail'=>'应用数据导出任务类型格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'category'
        ),
        'meta'=>array()
    ),
    APPLICATION_UPLOAD_DATA_TASK_CATEGORY_FORMAT_INCORRECT=>
    array(
        'id'=>APPLICATION_UPLOAD_DATA_TASK_CATEGORY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'APPLICATION_UPLOAD_DATA_TASK_CATEGORY_FORMAT_INCORRECT',
        'title'=>'应用数据导入任务类型格式不正确, 请按照提示重新输入',
        'detail'=>'应用数据导入任务类型格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'category'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_HTBH_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_HTBH_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_HTBH_FORMAT_INCORRECT',
        'title'=>'合同编号格式不正确, 请按照提示重新输入',
        'detail'=>'合同编号格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'htbm'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_HTMC_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_HTMC_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_HTMC_FORMAT_INCORRECT',
        'title'=>'合同名称格式不正确, 请按照提示重新输入',
        'detail'=>'合同名称格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'htmc'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_HTLX_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_HTLX_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_HTLX_FORMAT_INCORRECT',
        'title'=>'合同类型格式不正确, 请按照提示重新输入',
        'detail'=>'合同类型格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'htlx'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_XMBH_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_XMBH_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_XMBH_FORMAT_INCORRECT',
        'title'=>'项目编号格式不正确, 请按照提示重新输入',
        'detail'=>'项目编号格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'xmbh'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_CGR_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_CGR_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_CGR_FORMAT_INCORRECT',
        'title'=>'采购人（甲方）格式不正确, 请按照提示重新输入',
        'detail'=>'采购人（甲方）格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'cgr'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_JFZTTYSHXYDM_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_JFZTTYSHXYDM_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_JFZTTYSHXYDM_FORMAT_INCORRECT',
        'title'=>'甲方主体统一社会信用代码格式不正确, 请按照提示重新输入',
        'detail'=>'甲方主体统一社会信用代码格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'jfzttyshxydm'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_CGRDZ_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_CGRDZ_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_CGRDZ_FORMAT_INCORRECT',
        'title'=>'采购人地址格式不正确, 请按照提示重新输入',
        'detail'=>'采购人地址格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'cgrdz'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_GYS_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_GYS_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_GYS_FORMAT_INCORRECT',
        'title'=>'供应商（乙方）格式不正确, 请按照提示重新输入',
        'detail'=>'供应商（乙方）格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'gys'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_YFTYSHXYDM_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_YFTYSHXYDM_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_YFTYSHXYDM_FORMAT_INCORRECT',
        'title'=>'乙方统一社会信用代码格式不正确, 请按照提示重新输入',
        'detail'=>'乙方统一社会信用代码格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'yftyshxydm'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_GYSDZ_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_GYSDZ_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_GYSDZ_FORMAT_INCORRECT',
        'title'=>'供应商地址格式不正确, 请按照提示重新输入',
        'detail'=>'供应商地址格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'gysdz'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_GYSLXFS_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_GYSLXFS_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_GYSLXFS_FORMAT_INCORRECT',
        'title'=>'供应商联系方式格式不正确, 请按照提示重新输入',
        'detail'=>'供应商联系方式格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'gyslxfs'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_ZYBDMC_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_ZYBDMC_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_ZYBDMC_FORMAT_INCORRECT',
        'title'=>'主要标的名称格式不正确, 请按照提示重新输入',
        'detail'=>'主要标的名称格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'zybdmc'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_GGXH_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_GGXH_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_GGXH_FORMAT_INCORRECT',
        'title'=>'规格型号（或服务要求）格式不正确, 请按照提示重新输入',
        'detail'=>'规格型号（或服务要求）格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'ggxh'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_ZYBDSL_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_ZYBDSL_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_ZYBDSL_FORMAT_INCORRECT',
        'title'=>'主要标的数量格式不正确, 请按照提示重新输入',
        'detail'=>'主要标的数量格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'zybdsl'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_ZYBDDJ_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_ZYBDDJ_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_ZYBDDJ_FORMAT_INCORRECT',
        'title'=>'主要标的单价格式不正确, 请按照提示重新输入',
        'detail'=>'主要标的单价格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'zybddj'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_HTJE_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_HTJE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_HTJE_FORMAT_INCORRECT',
        'title'=>'合同金额（万元）格式不正确, 请按照提示重新输入',
        'detail'=>'合同金额（万元）格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'htje'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_LYQX_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_LYQX_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_LYQX_FORMAT_INCORRECT',
        'title'=>'履约期限格式不正确, 请按照提示重新输入',
        'detail'=>'履约期限格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'lyqx'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_QZDD_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_QZDD_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_QZDD_FORMAT_INCORRECT',
        'title'=>'签证地点格式不正确, 请按照提示重新输入',
        'detail'=>'签证地点格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'qzdd'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_CGFS_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_CGFS_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_CGFS_FORMAT_INCORRECT',
        'title'=>'采购方式格式不正确, 请按照提示重新输入',
        'detail'=>'采购方式格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'cgfs'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_HTQDRQ_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_HTQDRQ_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_HTQDRQ_FORMAT_INCORRECT',
        'title'=>'合同签订日期格式不正确, 请按照提示重新输入',
        'detail'=>'合同签订日期格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'htqdrq'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_HTGGRQ_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_HTGGRQ_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_HTGGRQ_FORMAT_INCORRECT',
        'title'=>'合同公告日期格式不正确, 请按照提示重新输入',
        'detail'=>'合同公告日期格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'htggrq'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_QTBCSY_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_QTBCSY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_QTBCSY_FORMAT_INCORRECT',
        'title'=>'其他补充事宜格式不正确, 请按照提示重新输入',
        'detail'=>'其他补充事宜格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'qtbcsy'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_LYZT_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_LYZT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_LYZT_FORMAT_INCORRECT',
        'title'=>'履约状态格式不正确, 请按照提示重新输入',
        'detail'=>'履约状态格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'lyzt'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_SSQY_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_SSQY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_SSQY_FORMAT_INCORRECT',
        'title'=>'所属区域格式不正确, 请按照提示重新输入',
        'detail'=>'所属区域格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'ssqy'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_SSHY_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_PERFORMANCE_SSHY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_SSHY_FORMAT_INCORRECT',
        'title'=>'所属行业格式不正确, 请按照提示重新输入',
        'detail'=>'所属行业格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'sshy'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_NOT_EXISTS=>
    array(
        'id'=>CONTRACT_PERFORMANCE_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_NOT_EXISTS',
        'title'=>'合同履约不存在, 请重新输入',
        'detail'=>'合同履约不存在, 请重新输入',
        'source'=>array(
            'pointer'=>'contractPerformance'
        ),
        'meta'=>array()
    ),
    CONTRACT_PERFORMANCE_EXISTS=>
    array(
        'id'=>CONTRACT_PERFORMANCE_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_PERFORMANCE_EXISTS',
        'title'=>'合同履约已存在, 请重新输入',
        'detail'=>'合同履约已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'contractPerformance'
        ),
        'meta'=>array()
    ),
    CONTRACT_FULFILLMENT_INFO_HTZXJD_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_FULFILLMENT_INFO_HTZXJD_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_FULFILLMENT_INFO_HTZXJD_FORMAT_INCORRECT',
        'title'=>'合同执行阶段格式不正确, 请按照提示重新输入',
        'detail'=>'合同执行阶段格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'htzxjd'
        ),
        'meta'=>array()
    ),
    CONTRACT_FULFILLMENT_INFO_HTZJSFQEZF_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_FULFILLMENT_INFO_HTZJSFQEZF_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_FULFILLMENT_INFO_HTZJSFQEZF_FORMAT_INCORRECT',
        'title'=>'合同资金是否全额支付格式不正确, 请按照提示重新输入',
        'detail'=>'合同资金是否全额支付格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'htzjsfqezf'
        ),
        'meta'=>array()
    ),
    CONTRACT_SJLYDW_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_SJLYDW_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_SJLYDW_FORMAT_INCORRECT',
        'title'=>'数据来源单位格式不正确, 请按照提示重新输入',
        'detail'=>'数据来源单位格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'sjlydw'
        ),
        'meta'=>array()
    ),
    CONTRACT_BREACH_INFO_WYF_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_BREACH_INFO_WYF_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_BREACH_INFO_WYF_FORMAT_INCORRECT',
        'title'=>'违约方格式不正确, 请按照提示重新输入',
        'detail'=>'违约方格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'wyf'
        ),
        'meta'=>array()
    ),
    CONTRACT_BREACH_INFO_WYSY_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_BREACH_INFO_WYSY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_BREACH_INFO_WYSY_FORMAT_INCORRECT',
        'title'=>'违约事由格式不正确, 请按照提示重新输入',
        'detail'=>'违约事由格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'wysy'
        ),
        'meta'=>array()
    ),
    CONTRACT_BREACH_INFO_WYYJ_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_BREACH_INFO_WYYJ_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_BREACH_INFO_WYYJ_FORMAT_INCORRECT',
        'title'=>'违约依据格式不正确, 请按照提示重新输入',
        'detail'=>'违约依据格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'wyyj'
        ),
        'meta'=>array()
    ),
    CONTRACT_BREACH_INFO_WYZT_FORMAT_INCORRECT=>
    array(
        'id'=>CONTRACT_BREACH_INFO_WYZT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CONTRACT_BREACH_INFO_WYZT_FORMAT_INCORRECT',
        'title'=>'违约状态格式不正确, 请按照提示重新输入',
        'detail'=>'违约状态格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'wyzt'
        ),
        'meta'=>array()
    ),
    FULFILLMENT_INFO_EXISTS=>
    array(
        'id'=>FULFILLMENT_INFO_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'FULFILLMENT_INFO_EXISTS',
        'title'=>'履约信息已存在, 请重新输入',
        'detail'=>'履约信息已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'fulfillmentInfo'
        ),
        'meta'=>array()
    ),
    BREACH_INFO_EXISTS=>
    array(
        'id'=>BREACH_INFO_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'BREACH_INFO_EXISTS',
        'title'=>'违约信息已存在, 请重新输入',
        'detail'=>'违约信息已存在, 请重新输入',
        'source'=>array(
            'pointer'=>'breachInfo'
        ),
        'meta'=>array()
    ),
    INTERACTION_CELLPHONE_FORMAT_INCORRECT=>
    array(
        'id'=>INTERACTION_CELLPHONE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'INTERACTION_CELLPHONE_FORMAT_INCORRECT',
        'title'=>'联系电话格式不正确, 请按照提示重新输入',
        'detail'=>'联系电话格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'cellphone'
        ),
        'meta'=>array()
    ),
    INTERACTION_CONTENT_FORMAT_INCORRECT=>
    array(
        'id'=>INTERACTION_CONTENT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'INTERACTION_CONTENT_FORMAT_INCORRECT',
        'title'=>'内容描述格式不正确, 请按照提示重新输入',
        'detail'=>'内容描述格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'content'
        ),
        'meta'=>array()
    ),
    INTERACTION_REPLY_CONTENT_FORMAT_INCORRECT=>
    array(
        'id'=>INTERACTION_REPLY_CONTENT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'INTERACTION_REPLY_CONTENT_FORMAT_INCORRECT',
        'title'=>'答复内容格式不正确, 请按照提示重新输入',
        'detail'=>'答复内容格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'replyContent'
        ),
        'meta'=>array()
    ),
    INTERACTION_EVIDENCES_FORMAT_INCORRECT=>
    array(
        'id'=>INTERACTION_EVIDENCES_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'INTERACTION_EVIDENCES_FORMAT_INCORRECT',
        'title'=>'佐证材料格式不正确, 请按照提示重新输入',
        'detail'=>'佐证材料格式不正确, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'evidences'
        ),
        'meta'=>array()
    ),
    INTERACTION_EVIDENCES_EXCEED_MAX_LIMIT=>
    array(
        'id'=>INTERACTION_EVIDENCES_EXCEED_MAX_LIMIT,
        'link'=>'',
        'status'=>403,
        'code'=>'INTERACTION_EVIDENCES_EXCEED_MAX_LIMIT',
        'title'=>'佐证材料上传数量超过最大限制, 请按照提示重新输入',
        'detail'=>'佐证材料上传数量超过最大限制, 请按照提示重新输入',
        'source'=>array(
            'pointer'=>'evidencesCount'
        ),
        'meta'=>array()
    ),
    INTERACTION_QUESTION_FORMAT_INCORRECT=>
    array(
        'id'=>INTERACTION_QUESTION_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'INTERACTION_QUESTION_FORMAT_INCORRECT',
        'title'=>'问题描述格式不正确, 请按照提示重新输入',
       'detail'=>'问题描述格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'question'
        ),
        'meta'=>array()
    ),
    CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT=>
    array(
        'id'=>CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT',
        'title'=>'自定义内容格式不正确, 请按照提示重新输入',
       'detail'=>'自定义内容格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'diyContent'
        ),
        'meta'=>array()
    ),
    CREDIT_REPORT_DOWNLOAD_RECORD_DOMAIN_FORMAT_INCORRECT=>
    array(
        'id'=>CREDIT_REPORT_DOWNLOAD_RECORD_DOMAIN_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CREDIT_REPORT_DOWNLOAD_RECORD_DOMAIN_FORMAT_INCORRECT',
        'title'=>'应用领域格式不正确, 请按照提示重新输入',
       'detail'=>'应用领域格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'domain'
        ),
        'meta'=>array()
    ),
    CREDIT_REPORT_DOWNLOAD_RECORD_TARGET_FORMAT_INCORRECT=>
    array(
        'id'=>CREDIT_REPORT_DOWNLOAD_RECORD_TARGET_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CREDIT_REPORT_DOWNLOAD_RECORD_TARGET_FORMAT_INCORRECT',
        'title'=>'使用对象格式不正确, 请按照提示重新输入',
       'detail'=>'使用对象格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'target'
        ),
        'meta'=>array()
    ),
    CREDIT_REPORT_DOWNLOAD_RECORD_DESCRIPTION_FORMAT_INCORRECT=>
    array(
        'id'=>CREDIT_REPORT_DOWNLOAD_RECORD_DESCRIPTION_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CREDIT_REPORT_DOWNLOAD_RECORD_DESCRIPTION_FORMAT_INCORRECT',
        'title'=>'说明格式不正确, 请按照提示重新输入',
       'detail'=>'说明格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'description'
        ),
        'meta'=>array()
    ),
    CREDIT_REPORT_DOWNLOAD_RECORD_SUBJECT_FORMAT_INCORRECT=>
    array(
        'id'=>CREDIT_REPORT_DOWNLOAD_RECORD_SUBJECT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CREDIT_REPORT_DOWNLOAD_RECORD_SUBJECT_FORMAT_INCORRECT',
        'title'=>'信用报告主体格式不正确, 请按照提示重新输入',
       'detail'=>'信用报告主体格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'subject'
        ),
        'meta'=>array()
    ),
    CREDIT_REPORT_SUBJECT_NOT_EXISTS=>
    array(
        'id'=>CREDIT_REPORT_SUBJECT_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'CREDIT_REPORT_SUBJECT_NOT_EXISTS',
        'title'=>'信用报告主体不存在, 请重新输入',
       'detail'=>'信用报告主体不存在, 请重新输入',
       'source'=>array(
            'pointer'=>'subject'
        ),
        'meta'=>array()
    ),
    CREDIT_REPORT_SUBJECT_CATEGORY_FORMAT_INCORRECT=>
    array(
        'id'=>CREDIT_REPORT_SUBJECT_CATEGORY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'CREDIT_REPORT_SUBJECT_CATEGORY_FORMAT_INCORRECT',
        'title'=>'主体类别格式不正确, 请按照提示重新输入',
       'detail'=>'主体类别格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'subjectCategory'
        ),
        'meta'=>array()
    ),
    RAP_MEMORANDUM_NAME_FORMAT_INCORRECT=>
    array(
        'id'=>RAP_MEMORANDUM_NAME_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_MEMORANDUM_NAME_FORMAT_INCORRECT',
        'title'=>'名称格式不正确, 请按照提示重新输入',
       'detail'=>'名称格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'name'
        ),
        'meta'=>array()
    ),
    RAP_MEMORANDUM_DOCUMENT_NO_FORMAT_INCORRECT=>
    array(
        'id'=>RAP_MEMORANDUM_DOCUMENT_NO_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_MEMORANDUM_DOCUMENT_NO_FORMAT_INCORRECT',
        'title'=>'文号格式不正确, 请按照提示重新输入',
       'detail'=>'文号格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'documentNo'
        ),
        'meta'=>array()
    ),
    RAP_MEMORANDUM_ORIGINATING_UNIT_FORMAT_INCORRECT=>
    array(
        'id'=>RAP_MEMORANDUM_ORIGINATING_UNIT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_MEMORANDUM_ORIGINATING_UNIT_FORMAT_INCORRECT',
        'title'=>'发起单位格式不正确, 请按照提示重新输入',
       'detail'=>'发起单位格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'originatingUnit'
        ),
        'meta'=>array()
    ),
    RAP_MEMORANDUM_RELEASE_DATE_FORMAT_INCORRECT=>
    array(
        'id'=>RAP_MEMORANDUM_RELEASE_DATE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_MEMORANDUM_RELEASE_DATE_FORMAT_INCORRECT',
        'title'=>'发布日期格式不正确, 请按照提示重新输入',
       'detail'=>'发布日期格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'releaseDate'
        ),
        'meta'=>array()
    ),
    RAP_MEMORANDUM_REWARD_TYPE_FORMAT_INCORRECT=>
    array(
        'id'=>RAP_MEMORANDUM_REWARD_TYPE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_MEMORANDUM_REWARD_TYPE_FORMAT_INCORRECT',
        'title'=>'奖惩类型格式不正确, 请按照提示重新输入',
       'detail'=>'奖惩类型格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'rewardType'
        ),
        'meta'=>array()
    ),
    RAP_MEMORANDUM_JOINT_SIGNING_DEPARTMENT_FORMAT_INCORRECT=>
    array(
        'id'=>RAP_MEMORANDUM_JOINT_SIGNING_DEPARTMENT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_MEMORANDUM_JOINT_SIGNING_DEPARTMENT_FORMAT_INCORRECT',
        'title'=>'联合签署部门格式不正确, 请按照提示重新输入',
       'detail'=>'联合签署部门格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'jointSigningDepartment'
        ),
        'meta'=>array()
    ),
    RAP_MEMORANDUM_CONTENT_FORMAT_INCORRECT=>
    array(
        'id'=>RAP_MEMORANDUM_CONTENT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_MEMORANDUM_CONTENT_FORMAT_INCORRECT',
        'title'=>'内容格式不正确, 请按照提示重新输入',
       'detail'=>'内容格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'content'
        ),
        'meta'=>array()
    ),
    RAP_MEMORANDUM_ATTACHMENTS_FORMAT_INCORRECT=>
    array(
        'id'=>RAP_MEMORANDUM_ATTACHMENTS_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_MEMORANDUM_ATTACHMENTS_FORMAT_INCORRECT',
        'title'=>'文件依据格式不正确, 请按照提示重新输入',
       'detail'=>'文件依据格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'attachments'
        ),
        'meta'=>array()
    ),
    RAP_MEMORANDUM_ATTACHMENTS_COUNT_INCORRECT=>
    array(
        'id'=>RAP_MEMORANDUM_ATTACHMENTS_COUNT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_MEMORANDUM_ATTACHMENTS_COUNT_INCORRECT',
        'title'=>'文件依据数量不正确, 请按照提示重新输入',
       'detail'=>'文件依据数量不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'attachmentsCount'
        ),
        'meta'=>array()
    ),
    RAP_MEASURE_NAME_FORMAT_INCORRECT=>
    array(
        'id'=>RAP_MEASURE_NAME_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_MEASURE_NAME_FORMAT_INCORRECT',
        'title'=>'名称格式不正确, 请按照提示重新输入',
       'detail'=>'名称格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'name'
        ),
        'meta'=>array()
    ),
    RAP_MEASURE_DESCRIPTION_FORMAT_INCORRECT=>
    array(
        'id'=>RAP_MEASURE_DESCRIPTION_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_MEASURE_DESCRIPTION_FORMAT_INCORRECT',
        'title'=>'描述格式不正确, 请按照提示重新输入',
       'detail'=>'描述格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'description'
        ),
        'meta'=>array()
    ),
    RAP_MEASURE_IMPLEMENTATION_UNITS_FORMAT_INCORRECT=>
    array(
        'id'=>RAP_MEASURE_IMPLEMENTATION_UNITS_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_MEASURE_IMPLEMENTATION_UNITS_FORMAT_INCORRECT',
        'title'=>'实施部门格式不正确, 请按照提示重新输入',
       'detail'=>'实施部门格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'implementationUnits'
        ),
        'meta'=>array()
    ),
    RAP_MEASURE_IMPLEMENTATION_UNITS_NOT_EXISTS=>
    array(
        'id'=>RAP_MEASURE_IMPLEMENTATION_UNITS_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_MEASURE_IMPLEMENTATION_UNITS_NOT_EXISTS',
        'title'=>'实施部门不存在, 请重新输入',
       'detail'=>'实施部门不存在, 请重新输入',
       'source'=>array(
            'pointer'=>'implementationUnits'
        ),
        'meta'=>array()
    ),
    RAP_MEASURE_MEMORANDUM_FORMAT_INCORRECT=>
    array(
        'id'=>RAP_MEASURE_MEMORANDUM_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_MEASURE_MEMORANDUM_FORMAT_INCORRECT',
        'title'=>'关联备忘录格式不正确, 请按照提示重新输入',
       'detail'=>'关联备忘录格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'memorandum'
        ),
        'meta'=>array()
    ),
    RAP_MEASURE_MEMORANDUM_NOT_EXISTS=>
    array(
        'id'=>RAP_MEASURE_MEMORANDUM_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_MEASURE_MEMORANDUM_NOT_EXISTS',
        'title'=>'关联备忘录不存在, 请重新输入',
       'detail'=>'关联备忘录不存在, 请重新输入',
       'source'=>array(
            'pointer'=>'memorandum'
        ),
        'meta'=>array()
    ),
    RAP_CASE_ZJLX_FORMAT_INCORRECT=>
    array(
        'id'=>RAP_CASE_ZJLX_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_CASE_ZJLX_FORMAT_INCORRECT',
        'title'=>'证件类型格式不正确, 请按照提示重新输入',
       'detail'=>'证件类型格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'zjlx'
        ),
        'meta'=>array()
    ),
    RAP_CASE_MEASURE_FORMAT_INCORRECT=>
    array(
        'id'=>RAP_CASE_MEASURE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_CASE_MEASURE_FORMAT_INCORRECT',
        'title'=>'关联措施不属于发布人员委办局',
       'detail'=>'关联措施不属于发布人员委办局',
       'source'=>array(
            'pointer'=>'measure'
        ),
        'meta'=>array()
    ),
    RAP_CASE_DATA_FORMAT_INCORRECT=>
    array(
        'id'=>RAP_CASE_DATA_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_CASE_DATA_FORMAT_INCORRECT',
        'title'=>'关联信用数据不属于红黑名单',
       'detail'=>'关联信用数据不属于红黑名单',
       'source'=>array(
            'pointer'=>'data'
        ),
        'meta'=>array()
    ),
    RAP_CASE_SJJE_FORMAT_INCORRECT=>
    array(
        'id'=>RAP_CASE_SJJE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_CASE_SJJE_FORMAT_INCORRECT',
        'title'=>'涉及金额格式不正确, 请按照提示重新输入',
       'detail'=>'涉及金额格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'sjje'
        ),
        'meta'=>array()
    ),
    RAP_CASE_JCSM_FORMAT_INCORRECT=>
    array(
        'id'=>RAP_CASE_JCSM_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_CASE_JCSM_FORMAT_INCORRECT',
        'title'=>'奖惩说明格式不正确, 请按照提示重新输入',
       'detail'=>'奖惩说明格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'jcsm'
        ),
        'meta'=>array()
    ),
    RAP_CASE_MEASURE_NOT_EXISTS=>
    array(
        'id'=>RAP_CASE_MEASURE_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_CASE_MEASURE_NOT_EXISTS',
        'title'=>'关联措施不存在, 请重新输入',
       'detail'=>'关联措施不存在, 请重新输入',
       'source'=>array(
            'pointer'=>'measure'
        ),
        'meta'=>array()
    ),
    RAP_CASE_DATA_NOT_EXISTS=>
    array(
        'id'=>RAP_CASE_DATA_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_CASE_DATA_NOT_EXISTS',
        'title'=>'关联信用数据不存在, 请重新输入',
       'detail'=>'关联信用数据不存在, 请重新输入',
       'source'=>array(
            'pointer'=>'data'
        ),
        'meta'=>array()
    ),
    RAP_CASE_FEEDBACK_ORGANIZATION_NOT_EXISTS=>
    array(
        'id'=>RAP_CASE_FEEDBACK_ORGANIZATION_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_CASE_FEEDBACK_ORGANIZATION_NOT_EXISTS',
        'title'=>'关联反馈委办局不存在, 请重新输入',
       'detail'=>'关联反馈委办局不存在, 请重新输入',
       'source'=>array(
            'pointer'=>'feedbackOrganization'
        ),
        'meta'=>array()
    ),
    RAP_CASE_FEEDBACK_ORGANIZATION_FORMAT_INCORRECT=>
    array(
        'id'=>RAP_CASE_FEEDBACK_ORGANIZATION_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'RAP_CASE_FEEDBACK_ORGANIZATION_FORMAT_INCORRECT',
        'title'=>'反馈委办局格式不正确, 请按照提示重新输入',
       'detail'=>'反馈委办局格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'feedbackOrganization'
        ),
        'meta'=>array()
    ),
    NATURAL_PERSON_CERTIFICATE_EXISTS=>
    array(
        'id'=>NATURAL_PERSON_CERTIFICATE_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'NATURAL_PERSON_CERTIFICATE_EXISTS',
        'title'=>'个人认证不能重复认证',
       'detail'=>'个人认证不能重复认证',
       'source'=>array(
            'pointer'=>'naturalPersonCertificate'
        ),
        'meta'=>array()
    ),
    NATURAL_PERSON_CERTIFICATE_FRONT_ID_CARD_PIC_FORMAT_INCORRECT=>
    array(
        'id'=>NATURAL_PERSON_CERTIFICATE_FRONT_ID_CARD_PIC_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'NATURAL_PERSON_CERTIFICATE_FRONT_ID_CARD_PIC_FORMAT_INCORRECT',
        'title'=>'身份证正面图片地址格式不正确, 请按照提示重新输入',
       'detail'=>'身份证正面图片地址格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'frontIdCardPic'
        ),
        'meta'=>array()
    ),
    NATURAL_PERSON_CERTIFICATE_BACK_ID_CARD_PIC_FORMAT_INCORRECT=>
    array(
        'id'=>NATURAL_PERSON_CERTIFICATE_BACK_ID_CARD_PIC_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'NATURAL_PERSON_CERTIFICATE_BACK_ID_CARD_PIC_FORMAT_INCORRECT',
        'title'=>'身份证反面图片地址格式不正确, 请按照提示重新输入',
       'detail'=>'身份证反面图片地址格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'backIdCardPic'
        ),
        'meta'=>array()
    ),
    NATURAL_PERSON_CERTIFICATE_HANDHELD_ID_CARD_PIC_FORMAT_INCORRECT=>
    array(
        'id'=>NATURAL_PERSON_CERTIFICATE_HANDHELD_ID_CARD_PIC_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'NATURAL_PERSON_CERTIFICATE_HANDHELD_ID_CARD_PIC_FORMAT_INCORRECT',
        'title'=>'手持身份证图片地址格式不正确, 请按照提示重新输入',
       'detail'=>'手持身份证图片地址格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'handheldIdCardPic'
        ),
        'meta'=>array()
    ),
    NATURAL_PERSON_CERTIFICATE_NOT_EXISTS=>
    array(
        'id'=>NATURAL_PERSON_CERTIFICATE_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'NATURAL_PERSON_CERTIFICATE_NOT_EXISTS',
        'title'=>'个人认证数据不存在, 请重新输入',
       'detail'=>'个人认证数据不存在, 请重新输入',
       'source'=>array(
            'pointer'=>'naturalPersonCertificate'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_ZTMC_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_ZTMC_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_ZTMC_FORMAT_INCORRECT',
        'title'=>'主体名称格式不正确, 请按照提示重新输入',
       'detail'=>'主体名称格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'ztmc'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_ZTLB_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_ZTLB_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_ZTLB_FORMAT_INCORRECT',
        'title'=>'主体类别格式不正确, 请按照提示重新输入',
       'detail'=>'主体类别格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'ztlb'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_TYSHXYDM_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_TYSHXYDM_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_TYSHXYDM_FORMAT_INCORRECT',
        'title'=>'统一社会信用代码格式不正确, 请按照提示重新输入',
       'detail'=>'统一社会信用代码格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'tyshxydm'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_FDDBR_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_FDDBR_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_FDDBR_FORMAT_INCORRECT',
        'title'=>'法定代表人格式不正确, 请按照提示重新输入',
       'detail'=>'法定代表人格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'fddbr'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_FDDBRZJLX_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_FDDBRZJLX_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_FDDBRZJLX_FORMAT_INCORRECT',
        'title'=>'法定代表人证件类型格式不正确, 请按照提示重新输入',
       'detail'=>'法定代表人证件类型格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'fddbrzjlx'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_FDDBRZJHM_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_FDDBRZJHM_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_FDDBRZJHM_FORMAT_INCORRECT',
        'title'=>'法定代表人证件号码格式不正确, 请按照提示重新输入',
       'detail'=>'法定代表人证件号码格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'fddbrzjhm'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_CLRQ_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_CLRQ_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_CLRQ_FORMAT_INCORRECT',
        'title'=>'成立日期格式不正确, 请按照提示重新输入',
       'detail'=>'成立日期格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'clrq'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_YXQ_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_YXQ_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_YXQ_FORMAT_INCORRECT',
        'title'=>'有效期格式不正确, 请按照提示重新输入',
       'detail'=>'有效期格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'yxq'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_DZ_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_DZ_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_DZ_FORMAT_INCORRECT',
        'title'=>'地址格式不正确, 请按照提示重新输入',
       'detail'=>'地址格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'dz'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_DJJG_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_DJJG_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_DJJG_FORMAT_INCORRECT',
        'title'=>'登记机关格式不正确, 请按照提示重新输入',
       'detail'=>'登记机关格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'djjg'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_GB_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_GB_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_GB_FORMAT_INCORRECT',
        'title'=>'国别格式不正确, 请按照提示重新输入',
       'detail'=>'国别格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'gb'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_ZCZB_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_ZCZB_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_ZCZB_FORMAT_INCORRECT',
        'title'=>'注册资本格式不正确, 请按照提示重新输入',
       'detail'=>'注册资本格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'zczb'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_ZCZBBZ_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_ZCZBBZ_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_ZCZBBZ_FORMAT_INCORRECT',
        'title'=>'注册资本币种格式不正确, 请按照提示重新输入',
       'detail'=>'注册资本币种格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'zczbbz'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_HYDM_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_HYDM_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_HYDM_FORMAT_INCORRECT',
        'title'=>'行业代码格式不正确, 请按照提示重新输入',
       'detail'=>'行业代码格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'hydm'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_LX_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_LX_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_LX_FORMAT_INCORRECT',
        'title'=>'类型格式不正确, 请按照提示重新输入',
       'detail'=>'类型格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'lx'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_JYFW_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_JYFW_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_JYFW_FORMAT_INCORRECT',
        'title'=>'经营范围格式不正确, 请按照提示重新输入',
       'detail'=>'经营范围格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'jyfw'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_JYZT_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_JYZT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_JYZT_FORMAT_INCORRECT',
        'title'=>'经营状态格式不正确, 请按照提示重新输入',
       'detail'=>'经营状态格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'jyzt'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_JYFWMS_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_JYFWMS_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_JYFWMS_FORMAT_INCORRECT',
        'title'=>'经营范围描述格式不正确, 请按照提示重新输入',
       'detail'=>'经营范围描述格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'jyfwms'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_BUSINESS_LICENSE_PICTURE_FORMAT_INCORRECT=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_BUSINESS_LICENSE_PICTURE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_BUSINESS_LICENSE_PICTURE_FORMAT_INCORRECT',
        'title'=>'营业执照图片格式不正确, 请按照提示重新输入',
       'detail'=>'营业执照图片格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'businessLicensePicture'
        ),
        'meta'=>array()
    ),
    ENTERPRISE_CERTIFICATE_EXISTS=>
    array(
        'id'=>ENTERPRISE_CERTIFICATE_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'ENTERPRISE_CERTIFICATE_EXISTS',
        'title'=>'企业认证不能重复认证',
       'detail'=>'企业认证不能重复认证',
       'source'=>array(
            'pointer'=>'enterpriseCertificate'
        ),
        'meta'=>array()
    ),
    SELF_DECLARATION_ATTACHMENTS_FORMAT_INCORRECT=>
    array(
        'id'=>SELF_DECLARATION_ATTACHMENTS_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'SELF_DECLARATION_ATTACHMENTS_FORMAT_INCORRECT',
        'title'=>'附件格式不正确, 请按照提示重新输入',
       'detail'=>'附件格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'attachments'
        ),
        'meta'=>array()
    ),
    SELF_DECLARATION_CERTIFICATE_TYPE_FORMAT_INCORRECT=>
    array(
        'id'=>SELF_DECLARATION_CERTIFICATE_TYPE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'SELF_DECLARATION_CERTIFICATE_TYPE_FORMAT_INCORRECT',
        'title'=>'用户认证类型格式不正确, 请按照提示重新输入',
       'detail'=>'用户认证类型格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'certificateType'
        ),
        'meta'=>array()
    ),
    SELF_DECLARATION_CERTIFICATE_ID_FORMAT_INCORRECT=>
    array(
        'id'=>SELF_DECLARATION_CERTIFICATE_ID_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'SELF_DECLARATION_CERTIFICATE_ID_FORMAT_INCORRECT',
        'title'=>'认证信息格式不正确, 请按照提示重新输入',
       'detail'=>'认证信息格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'certificateId'
        ),
        'meta'=>array()
    ),
    SELF_DECLARATION_CERTIFICATE_NOT_EXISTS=>
    array(
        'id'=>SELF_DECLARATION_CERTIFICATE_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'SELF_DECLARATION_CERTIFICATE_NOT_EXISTS',
        'title'=>'认证信息不存在, 请重新输入',
       'detail'=>'认证信息不存在, 请重新输入',
       'source'=>array(
            'pointer'=>'certificate'
        ),
        'meta'=>array()
    ),
    SELF_DECLARATION_ATTACHMENTS_COUNT_FORMAT_INCORRECT=>
    array(
        'id'=>SELF_DECLARATION_ATTACHMENTS_COUNT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'SELF_DECLARATION_ATTACHMENTS_COUNT_FORMAT_INCORRECT',
        'title'=>'附件数量不正确, 请按照提示重新输入',
       'detail'=>'附件数量不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'attachmentsCount'
        ),
        'meta'=>array()
    ),
    SELF_DECLARATION_CERTIFICATE_FORMAT_INCORRECT=>
    array(
        'id'=>SELF_DECLARATION_CERTIFICATE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'SELF_DECLARATION_CERTIFICATE_FORMAT_INCORRECT',
        'title'=>'未进行实名认证, 请先去认证',
       'detail'=>'未进行实名认证, 请先去认证',
       'source'=>array(
            'pointer'=>'certificate'
        ),
        'meta'=>array()
    ),
    EVALUATION_INDICATOR_NAME_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_INDICATOR_NAME_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_INDICATOR_NAME_FORMAT_INCORRECT',
        'title'=>'名称格式不正确, 请按照提示重新输入',
       'detail'=>'名称格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'name'
        ),
        'meta'=>array()
    ),
    EVALUATION_INDICATOR_CATEGORY_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_INDICATOR_CATEGORY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_INDICATOR_CATEGORY_FORMAT_INCORRECT',
        'title'=>'分类格式不正确, 请按照提示重新输入',
       'detail'=>'分类格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'category'
        ),
        'meta'=>array()
    ),
    EVALUATION_INDICATOR_INFO_CATEGORY_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_INDICATOR_INFO_CATEGORY_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_INDICATOR_INFO_CATEGORY_FORMAT_INCORRECT',
        'title'=>'评价类别格式不正确, 请按照提示重新输入',
       'detail'=>'评价类别格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'infoCategory'
        ),
        'meta'=>array()
    ),
    EVALUATION_INDICATOR_DESCRIPTION_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_INDICATOR_DESCRIPTION_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_INDICATOR_DESCRIPTION_FORMAT_INCORRECT',
        'title'=>'指标说明格式不正确, 请按照提示重新输入',
       'detail'=>'指标说明格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'description'
        ),
        'meta'=>array()
    ),
    EVALUATION_INDICATOR_SOURCE_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_INDICATOR_SOURCE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_INDICATOR_SOURCE_FORMAT_INCORRECT',
        'title'=>'信息项格式不正确, 请按照提示重新输入',
       'detail'=>'信息项格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'source'
        ),
        'meta'=>array()
    ),
    EVALUATION_INDICATOR_SOURCE_NOT_EXISTS=>
    array(
        'id'=>EVALUATION_INDICATOR_SOURCE_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_INDICATOR_SOURCE_NOT_EXISTS',
        'title'=>'信息项不存在, 请重新输入',
       'detail'=>'信息项不存在, 请重新输入',
       'source'=>array(
            'pointer'=>'source'
        ),
        'meta'=>array()
    ),
    EVALUATION_INDICATOR_SOURCE_INFO_CATEGORY_MISMATCH=>
    array(
        'id'=>EVALUATION_INDICATOR_SOURCE_INFO_CATEGORY_MISMATCH,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_INDICATOR_SOURCE_INFO_CATEGORY_MISMATCH',
        'title'=>'评价指标信息项的信息类别与信用评价指标评价类别不匹配',
       'detail'=>'评价指标信息项的信息类别与信用评价指标评价类别不匹配',
       'source'=>array(
            'pointer'=>'source'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_NAME_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_NAME_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_NAME_FORMAT_INCORRECT',
        'title'=>'名称格式不正确, 请按照提示重新输入',
       'detail'=>'名称格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'name'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_OBJECT_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_OBJECT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_OBJECT_FORMAT_INCORRECT',
        'title'=>'被评对象格式不正确, 请按照提示重新输入',
       'detail'=>'被评对象格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'object'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_DESCRIPTION_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_DESCRIPTION_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_DESCRIPTION_FORMAT_INCORRECT',
        'title'=>'说明格式不正确, 请按照提示重新输入',
       'detail'=>'说明格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'description'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_MAX_SCORE_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_MAX_SCORE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_MAX_SCORE_FORMAT_INCORRECT',
        'title'=>'最高分数格式不正确, 请按照提示重新输入',
       'detail'=>'最高分数格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'maxScore'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_BASE_SCORE_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_BASE_SCORE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_BASE_SCORE_FORMAT_INCORRECT',
        'title'=>'信息项格式不正确, 请按照提示重新输入',
       'detail'=>'信息项格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'baseScore'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_RANKS_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_RANKS_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_RANKS_FORMAT_INCORRECT',
        'title'=>'评分等级格式不正确, 请按照提示重新输入',
       'detail'=>'评分等级格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'ranks'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_FORMAT_INCORRECT',
        'title'=>'评分指标权重格式不正确, 请按照提示重新输入',
       'detail'=>'评分指标权重格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'indicatorWeights'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_RANKS_NOT_EXISTS=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_RANKS_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_RANKS_NOT_EXISTS',
        'title'=>'评分等级不存在, 请重新输入',
       'detail'=>'评分等级不存在, 请重新输入',
       'source'=>array(
            'pointer'=>'ranks'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_NOT_EXISTS=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_NOT_EXISTS',
        'title'=>'评分指标权重不存在, 请重新输入',
       'detail'=>'评分指标权重不存在, 请重新输入',
       'source'=>array(
            'pointer'=>'indicatorWeights'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_RANKS_MAX_SCORE_BELOW_BASE_SCORE=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_RANKS_MAX_SCORE_BELOW_BASE_SCORE,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_RANKS_MAX_SCORE_BELOW_BASE_SCORE',
        'title'=>'信用评价模型的最高分低于基础分',
       'detail'=>'信用评价模型的最高分低于基础分',
       'source'=>array(
            'pointer'=>'maxScore'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_RANKS_RATING_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_RANKS_RATING_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_RANKS_RATING_FORMAT_INCORRECT',
        'title'=>'评分等级信用等级格式不正确, 请按照提示重新输入',
       'detail'=>'评分等级信用等级格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'ranks.rating'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_RANKS_REMINDER_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_RANKS_REMINDER_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_RANKS_REMINDER_FORMAT_INCORRECT',
        'title'=>'评分等级信用提示格式不正确, 请按照提示重新输入',
       'detail'=>'评分等级信用提示格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'ranks.reminder'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_RANKS_LEVEL_DESCRIPTION_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_RANKS_LEVEL_DESCRIPTION_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_RANKS_LEVEL_DESCRIPTION_FORMAT_INCORRECT',
        'title'=>'评分等级说明格式不正确, 请按照提示重新输入',
       'detail'=>'评分等级说明格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'ranks.levelDescription'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_RANKS_MIN_SCORE_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_RANKS_MIN_SCORE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_RANKS_MIN_SCORE_FORMAT_INCORRECT',
        'title'=>'评分等级最低分数格式不正确, 请按照提示重新输入',
       'detail'=>'评分等级最低分数格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'ranks.minScore'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_RANKS_MAX_SCORE_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_RANKS_MAX_SCORE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_RANKS_MAX_SCORE_FORMAT_INCORRECT',
        'title'=>'评分等级最高分数格式不正确, 请按照提示重新输入',
       'detail'=>'评分等级最高分数格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'ranks.maxScore'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_RANKS_MIN_SCORE_BELOW_MIN_SCORE=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_RANKS_MIN_SCORE_BELOW_MIN_SCORE,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_RANKS_MIN_SCORE_BELOW_MIN_SCORE',
        'title'=>'信用评价模型评价等级的最低分不能低于模型的最低分数, 请按照提示重新输入',
       'detail'=>'信用评价模型评价等级的最低分不能低于模型的最低分数, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'ranks.minScore'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_RANKS_MAX_SCORE_HIGHER_THAN_MAX_SCORE=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_RANKS_MAX_SCORE_HIGHER_THAN_MAX_SCORE,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_RANKS_MAX_SCORE_HIGHER_THAN_MAX_SCORE',
        'title'=>'信用评价模型评价等级的最高分不能高于模型的最高分数, 请按照提示重新输入',
       'detail'=>'信用评价模型评价等级的最高分不能高于模型的最高分数, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'ranks.maxScore'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_RANKS_MIN_SCORE_INCORRECT=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_RANKS_MIN_SCORE_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_RANKS_MIN_SCORE_INCORRECT',
        'title'=>'信用评价模型评价等级的最低分不正确, 请按照提示重新输入',
       'detail'=>'信用评价模型评价等级的最低分不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'ranks.minScore'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_RANKS_MAX_SCORE_INCORRECT=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_RANKS_MAX_SCORE_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_RANKS_MAX_SCORE_INCORRECT',
        'title'=>'信用评价模型评价等级的最高分不正确, 请按照提示重新输入',
       'detail'=>'信用评价模型评价等级的最高分不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'ranks.maxScore'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_RANKS_MIN_SCORE_HIGHER_THAN_RANKS_MAX_SCORE=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_RANKS_MIN_SCORE_HIGHER_THAN_RANKS_MAX_SCORE,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_RANKS_MIN_SCORE_HIGHER_THAN_RANKS_MAX_SCORE',
        'title'=>'信用评价模型评价等级的最低分不能高于评价等级的最高分, 请按照提示重新输入',
       'detail'=>'信用评价模型评价等级的最低分不能高于评价等级的最高分, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'ranks.minScore'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_RANKS_SCORE_INCOHERENCE=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_RANKS_SCORE_INCOHERENCE,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_RANKS_SCORE_INCOHERENCE',
        'title'=>'信用评价模型评分等级分数不连贯, 请按照提示重新输入',
       'detail'=>'信用评价模型评分等级分数不连贯, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'ranks.score'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_RANKS_SCORE_OVERLAP=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_RANKS_SCORE_OVERLAP,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_RANKS_SCORE_OVERLAP',
        'title'=>'信用评价模型评分等级分数有重叠, 请按照提示重新输入',
       'detail'=>'信用评价模型评分等级分数有重叠, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'ranks.score'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_PERCENTAGE_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_PERCENTAGE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_PERCENTAGE_FORMAT_INCORRECT',
        'title'=>'评分指标权重占比格式不正确, 请按照提示重新输入',
       'detail'=>'评分指标权重占比格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'indicatorWeights.percentage'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_SCORE_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_SCORE_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_SCORE_FORMAT_INCORRECT',
        'title'=>'评分指标权重单条分数格式不正确, 请按照提示重新输入',
       'detail'=>'评分指标权重单条分数格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'indicatorWeights.score'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_INDICATOR_ID_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_INDICATOR_ID_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_INDICATOR_ID_FORMAT_INCORRECT',
        'title'=>'评分指标权重评价指标格式不正确, 请按照提示重新输入',
       'detail'=>'评分指标权重评价指标格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'indicatorWeights.indicatorId'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_PERCENTAGE_SUM_NOT_EQUAL_EXPECTED=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_PERCENTAGE_SUM_NOT_EQUAL_EXPECTED,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_PERCENTAGE_SUM_NOT_EQUAL_EXPECTED',
        'title'=>'评价模型的指标权重百分比没有100%, 请按照提示重新输入',
       'detail'=>'评价模型的指标权重百分比没有100%, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'indicatorWeights'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_RANKS_RATING_EXISTS=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_RANKS_RATING_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_RANKS_RATING_EXISTS',
        'title'=>'评分等级信用等级已存在, 请按照提示重新输入',
       'detail'=>'评分等级信用等级已存在, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'ranks.rating'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_RANKS_COUNT_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_RANKS_COUNT_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_RANKS_COUNT_FORMAT_INCORRECT',
        'title'=>'评分等级数量不正确, 请按照提示重新输入',
       'detail'=>'评分等级数量不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'ranksCount'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_OBJECT_INDICATOR_SOURCE_SUBJECT_CATEGORY_MISMATCHING=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_OBJECT_INDICATOR_SOURCE_SUBJECT_CATEGORY_MISMATCHING,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_OBJECT_INDICATOR_SOURCE_SUBJECT_CATEGORY_MISMATCHING',
        'title'=>'评分模型的被评对象和指标的主体类别不匹配',
       'detail'=>'评分模型的被评对象和指标的主体类别不匹配',
       'source'=>array(
            'pointer'=>'object'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_INDICATOR_EXISTS=>
    array(
        'id'=>EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_INDICATOR_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_INDICATOR_EXISTS',
        'title'=>'评价模型的指标评价类别已存在, 请按照提示重新输入',
       'detail'=>'评价模型的指标评价类别已存在, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'object'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCENARIO_NAME_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_SCENARIO_NAME_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCENARIO_NAME_FORMAT_INCORRECT',
        'title'=>'场景名称格式不正确, 请按照提示重新输入',
       'detail'=>'场景名称格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'name'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCENARIO_DESCRIPTION_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_SCENARIO_DESCRIPTION_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCENARIO_DESCRIPTION_FORMAT_INCORRECT',
        'title'=>'场景说明格式不正确, 请按照提示重新输入',
       'detail'=>'场景说明格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'description'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCENARIO_SCORE_MODEL_FORMAT_INCORRECT=>
    array(
        'id'=>EVALUATION_SCENARIO_SCORE_MODEL_FORMAT_INCORRECT,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCENARIO_SCORE_MODEL_FORMAT_INCORRECT',
        'title'=>'评分模型格式不正确, 请按照提示重新输入',
       'detail'=>'评分模型格式不正确, 请按照提示重新输入',
       'source'=>array(
            'pointer'=>'scoreModel'
        ),
        'meta'=>array()
    ),
    EVALUATION_SCENARIO_SCORE_MODEL_NOT_EXISTS=>
    array(
        'id'=>EVALUATION_SCENARIO_SCORE_MODEL_NOT_EXISTS,
        'link'=>'',
        'status'=>403,
        'code'=>'EVALUATION_SCENARIO_SCORE_MODEL_NOT_EXISTS',
        'title'=>'评分模型不存在, 请重新输入',
       'detail'=>'评分模型不存在, 请重新输入',
       'source'=>array(
            'pointer'=>'scoreModel'
        ),
        'meta'=>array()
    ),
    CM_INDUSTRYORGEVA_SUBJECT_NAME_FORMAT_INCORRECT =>
    array(
        'id' => CM_INDUSTRYORGEVA_SUBJECT_NAME_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_INDUSTRYORGEVA_SUBJECT_NAME_FORMAT_INCORRECT',
        'title' => '企业名称格式不正确，请按照提示重新输入',
        'detail' => '企业名称格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'subjectName'
        ),
        'meta' => array()
    ),
    CM_INDUSTRYORGEVA_UNIFIED_IDENTIFIER_FORMAT_INCORRECT =>
    array(
        'id' => CM_INDUSTRYORGEVA_UNIFIED_IDENTIFIER_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_INDUSTRYORGEVA_UNIFIED_IDENTIFIER_FORMAT_INCORRECT',
        'title' => '统一社会信用代码格式不正确，请按照提示重新输入',
        'detail' => '统一社会信用代码格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'unifiedIdentifier'
        ),
        'meta' => array()
    ),
    CM_INDUSTRYORGEVA_INDUSTRY_NAME_FORMAT_INCORRECT =>
    array(
        'id' => CM_INDUSTRYORGEVA_INDUSTRY_NAME_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_INDUSTRYORGEVA_INDUSTRY_NAME_FORMAT_INCORRECT',
        'title' => '行业名称格式不正确，请按照提示重新输入',
        'detail' => '行业名称格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'industryName'
        ),
        'meta' => array()
    ),
    CM_INDUSTRYORGEVA_EVALUATION_TYPE_FORMAT_INCORRECT =>
    array(
        'id' => CM_INDUSTRYORGEVA_EVALUATION_TYPE_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_INDUSTRYORGEVA_EVALUATION_TYPE_FORMAT_INCORRECT',
        'title' => '评价类型格式不正确，请按照提示重新输入',
        'detail' => '评价类型格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'evaluationType'
        ),
        'meta' => array()
    ),
    CM_INDUSTRYORGEVA_EVALUATION_CONTENT_FORMAT_INCORRECT =>
    array(
        'id' => CM_INDUSTRYORGEVA_EVALUATION_CONTENT_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_INDUSTRYORGEVA_EVALUATION_CONTENT_FORMAT_INCORRECT',
        'title' => '评价内容格式不正确，请按照提示重新输入',
        'detail' => '评价内容格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'evaluationContent'
        ),
        'meta' => array()
    ),
    CM_CERTIFICATION_SUBJECT_NAME_FORMAT_INCORRECT =>
    array(
        'id' => CM_CERTIFICATION_SUBJECT_NAME_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_CERTIFICATION_SUBJECT_NAME_FORMAT_INCORRECT',
        'title' => '企业名称格式不正确，请按照提示重新输入',
        'detail' => '企业名称格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'subjectName'
        ),
        'meta' => array()
    ),
    CM_CERTIFICATION_UNIFIED_IDENTIFIER_FORMAT_INCORRECT =>
    array(
        'id' => CM_CERTIFICATION_UNIFIED_IDENTIFIER_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_CERTIFICATION_UNIFIED_IDENTIFIER_FORMAT_INCORRECT',
        'title' => '统一社会信用代码格式不正确，请按照提示重新输入',
        'detail' => '统一社会信用代码格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'unifiedIdentifier'
        ),
        'meta' => array()
    ),
    CM_CERTIFICATION_NAME_FORMAT_INCORRECT =>
    array(
        'id' => CM_CERTIFICATION_NAME_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_CERTIFICATION_NAME_FORMAT_INCORRECT',
        'title' => '证书名称格式不正确，请按照提示重新输入',
        'detail' => '证书名称格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'name'
        ),
        'meta' => array()
    ),
    CM_CERTIFICATION_PUB_DATE_FORMAT_INCORRECT =>
    array(
        'id' => CM_CERTIFICATION_PUB_DATE_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_CERTIFICATION_PUB_DATE_FORMAT_INCORRECT',
        'title' => '发证日期格式不正确，请按照提示重新输入',
        'detail' => '发证日期格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'pubDate'
        ),
        'meta' => array()
    ),
    CM_CERTIFICATION_VALIDATE_DATE_FORMAT_INCORRECT =>
    array(
        'id' => CM_CERTIFICATION_VALIDATE_DATE_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_CERTIFICATION_VALIDATE_DATE_FORMAT_INCORRECT',
        'title' => '证书有效期格式不正确，请按照提示重新输入',
        'detail' => '证书有效期格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'validateDate'
        ),
        'meta' => array()
    ),
    CM_COLLATERAL_SUBJECT_NAME_FORMAT_INCORRECT =>
    array(
        'id' => CM_COLLATERAL_SUBJECT_NAME_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_COLLATERAL_SUBJECT_NAME_FORMAT_INCORRECT',
        'title' => '企业名称格式不正确，请按照提示重新输入',
        'detail' => '企业名称格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'subjectName'
        ),
        'meta' => array()
    ),
    CM_COLLATERAL_UNIFIED_IDENTIFIER_FORMAT_INCORRECT =>
    array(
        'id' => CM_COLLATERAL_UNIFIED_IDENTIFIER_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_COLLATERAL_UNIFIED_IDENTIFIER_FORMAT_INCORRECT',
        'title' => '统一社会信用代码格式不正确，请按照提示重新输入',
        'detail' => '统一社会信用代码格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'unifiedIdentifier'
        ),
        'meta' => array()
    ),
    CM_COLLATERAL_REGISTRATION_NUMBER_FORMAT_INCORRECT =>
    array(
        'id' => CM_COLLATERAL_REGISTRATION_NUMBER_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_COLLATERAL_REGISTRATION_NUMBER_FORMAT_INCORRECT',
        'title' => '登记编号格式不正确，请按照提示重新输入',
        'detail' => '登记编号格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'registrationNumber'
        ),
        'meta' => array()
    ),
    CM_COLLATERAL_REGISTRATION_DATE_FORMAT_INCORRECT =>
    array(
        'id' => CM_COLLATERAL_REGISTRATION_DATE_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_COLLATERAL_REGISTRATION_DATE_FORMAT_INCORRECT',
        'title' => '登记日期格式不正确，请按照提示重新输入',
        'detail' => '登记日期格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'registrationDate'
        ),
        'meta' => array()
    ),
    CM_COLLATERAL_REGISTRATION_AGENCY_FORMAT_INCORRECT =>
    array(
        'id' => CM_COLLATERAL_REGISTRATION_AGENCY_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_COLLATERAL_REGISTRATION_AGENCY_FORMAT_INCORRECT',
        'title' => '登记机关格式不正确，请按照提示重新输入',
        'detail' => '登记机关格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'registrationAgency'
        ),
        'meta' => array()
    ),
    CM_COLLATERAL_SECURED_BOND_AMOUNT_FORMAT_INCORRECT =>
    array(
        'id' => CM_COLLATERAL_SECURED_BOND_AMOUNT_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_COLLATERAL_SECURED_BOND_AMOUNT_FORMAT_INCORRECT',
        'title' => '被担保债券数额格式不正确，请按照提示重新输入',
        'detail' => '被担保债券数额格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'securedBondAmount'
        ),
        'meta' => array()
    ),
    CM_COLLATERAL_MORTGAGE_STATUS_FORMAT_INCORRECT =>
    array(
        'id' => CM_COLLATERAL_MORTGAGE_STATUS_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_COLLATERAL_MORTGAGE_STATUS_FORMAT_INCORRECT',
        'title' => '抵押状态格式不正确，请按照提示重新输入',
        'detail' => '抵押状态格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'mortgageStatus'
        ),
        'meta' => array()
    ),
    CM_COPYRIGHT_SUBJECT_NAME_FORMAT_INCORRECT =>
    array(
        'id' => CM_COPYRIGHT_SUBJECT_NAME_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_COPYRIGHT_SUBJECT_NAME_FORMAT_INCORRECT',
        'title' => '企业名称格式不正确，请按照提示重新输入',
        'detail' => '企业名称格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'subjectName'
        ),
        'meta' => array()
    ),
    CM_COPYRIGHT_UNIFIED_IDENTIFIER_FORMAT_INCORRECT =>
    array(
        'id' => CM_COPYRIGHT_UNIFIED_IDENTIFIER_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_COPYRIGHT_UNIFIED_IDENTIFIER_FORMAT_INCORRECT',
        'title' => '统一社会信用代码格式不正确，请按照提示重新输入',
        'detail' => '统一社会信用代码格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'unifiedIdentifier'
        ),
        'meta' => array()
    ),
    CM_COPYRIGHT_TITLE_FORMAT_INCORRECT =>
    array(
        'id' => CM_COPYRIGHT_TITLE_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_COPYRIGHT_TITLE_FORMAT_INCORRECT',
        'title' => '著作名称格式不正确，请按照提示重新输入',
        'detail' => '著作名称格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'title'
        ),
        'meta' => array()
    ),
    CM_COPYRIGHT_REGISTRATION_NUMBER_FORMAT_INCORRECT =>
    array(
        'id' => CM_COPYRIGHT_REGISTRATION_NUMBER_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_COPYRIGHT_REGISTRATION_NUMBER_FORMAT_INCORRECT',
        'title' => '登记号格式不正确，请按照提示重新输入',
        'detail' => '登记号格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'registrationNumber'
        ),
        'meta' => array()
    ),
    CM_COPYRIGHT_CONDITIONS_FORMAT_INCORRECT =>
    array(
        'id' => CM_COPYRIGHT_CONDITIONS_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_COPYRIGHT_CONDITIONS_FORMAT_INCORRECT',
        'title' => '状况格式不正确，请按照提示重新输入',
        'detail' => '状况格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'conditions'
        ),
        'meta' => array()
    ),
    CM_COPYRIGHT_REGISTRATION_DATE_FORMAT_INCORRECT =>
    array(
        'id' => CM_COPYRIGHT_REGISTRATION_DATE_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_COPYRIGHT_REGISTRATION_DATE_FORMAT_INCORRECT',
        'title' => '登记日期格式不正确，请按照提示重新输入',
        'detail' => '登记日期格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'registrationDate'
        ),
        'meta' => array()
    ),
    CM_FINANCING_SUBJECT_NAME_FORMAT_INCORRECT =>
    array(
        'id' => CM_FINANCING_SUBJECT_NAME_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_FINANCING_SUBJECT_NAME_FORMAT_INCORRECT',
        'title' => '企业名称格式不正确，请按照提示重新输入',
        'detail' => '企业名称格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'subjectName'
        ),
        'meta' => array()
    ),
    CM_FINANCING_UNIFIED_IDENTIFIER_FORMAT_INCORRECT =>
    array(
        'id' => CM_FINANCING_UNIFIED_IDENTIFIER_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_FINANCING_UNIFIED_IDENTIFIER_FORMAT_INCORRECT',
        'title' => '统一社会信用代码格式不正确，请按照提示重新输入',
        'detail' => '统一社会信用代码格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'unifiedIdentifier'
        ),
        'meta' => array()
    ),
    CM_FINANCING_FINANCED_AT_FORMAT_INCORRECT =>
    array(
        'id' => CM_FINANCING_FINANCED_AT_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_FINANCING_FINANCED_AT_FORMAT_INCORRECT',
        'title' => '融资时间格式不正确，请按照提示重新输入',
        'detail' => '融资时间格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'financedAt'
        ),
        'meta' => array()
    ),
    CM_FINANCING_STAGE_FORMAT_INCORRECT =>
    array(
        'id' => CM_FINANCING_STAGE_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_FINANCING_STAGE_FORMAT_INCORRECT',
        'title' => '融资阶段格式不正确，请按照提示重新输入',
        'detail' => '融资阶段格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'stage'
        ),
        'meta' => array()
    ),
    CM_FINANCING_AMOUNT_FORMAT_INCORRECT =>
    array(
        'id' => CM_FINANCING_AMOUNT_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_FINANCING_AMOUNT_FORMAT_INCORRECT',
        'title' => '融资金额格式不正确，请按照提示重新输入',
        'detail' => '融资金额格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'amount'
        ),
        'meta' => array()
    ),
    CM_SOFTWARERIGHT_SUBJECT_NAME_FORMAT_INCORRECT =>
    array(
        'id' => CM_SOFTWARERIGHT_SUBJECT_NAME_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_SOFTWARERIGHT_SUBJECT_NAME_FORMAT_INCORRECT',
        'title' => '企业名称格式不正确，请按照提示重新输入',
        'detail' => '企业名称格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'subjectName'
        ),
        'meta' => array()
    ),
    CM_SOFTWARERIGHT_UNIFIED_IDENTIFIER_FORMAT_INCORRECT =>
    array(
        'id' => CM_SOFTWARERIGHT_UNIFIED_IDENTIFIER_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_SOFTWARERIGHT_UNIFIED_IDENTIFIER_FORMAT_INCORRECT',
        'title' => '统一社会信用代码格式不正确，请按照提示重新输入',
        'detail' => '统一社会信用代码格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'unifiedIdentifier'
        ),
        'meta' => array()
    ),
    CM_SOFTWARERIGHT_TITLE_FORMAT_INCORRECT =>
    array(
        'id' => CM_SOFTWARERIGHT_TITLE_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_SOFTWARERIGHT_TITLE_FORMAT_INCORRECT',
        'title' => '软件名称格式不正确，请按照提示重新输入',
        'detail' => '软件名称格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'title'
        ),
        'meta' => array()
    ),
    CM_SOFTWARERIGHT_VERSION_FORMAT_INCORRECT =>
    array(
        'id' => CM_SOFTWARERIGHT_VERSION_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_SOFTWARERIGHT_VERSION_FORMAT_INCORRECT',
        'title' => '版本号格式不正确，请按照提示重新输入',
        'detail' => '版本号格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'version'
        ),
        'meta' => array()
    ),
    CM_SOFTWARERIGHT_CATEGORY_FORMAT_INCORRECT =>
    array(
        'id' => CM_SOFTWARERIGHT_CATEGORY_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_SOFTWARERIGHT_CATEGORY_FORMAT_INCORRECT',
        'title' => '分类号格式不正确，请按照提示重新输入',
        'detail' => '分类号格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'category'
        ),
        'meta' => array()
    ),
    CM_SOFTWARERIGHT_REGISTRATION_NUMBER_FORMAT_INCORRECT =>
    array(
        'id' => CM_SOFTWARERIGHT_REGISTRATION_NUMBER_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_SOFTWARERIGHT_REGISTRATION_NUMBER_FORMAT_INCORRECT',
        'title' => '登记号格式不正确，请按照提示重新输入',
        'detail' => '登记号格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'registrationNumber'
        ),
        'meta' => array()
    ),
    CM_SOFTWARERIGHT_REGISTRATION_APPROVAL_DATE_FORMAT_INCORRECT =>
    array(
        'id' => CM_SOFTWARERIGHT_REGISTRATION_APPROVAL_DATE_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_SOFTWARERIGHT_REGISTRATION_APPROVAL_DATE_FORMAT_INCORRECT',
        'title' => '登记批准日期格式不正确，请按照提示重新输入',
        'detail' => '登记批准日期格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'registrationApprovalDate'
        ),
        'meta' => array()
    ),
    CM_TAXATION_SUBJECT_NAME_FORMAT_INCORRECT =>
    array(
        'id' => CM_TAXATION_SUBJECT_NAME_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_TAXATION_SUBJECT_NAME_FORMAT_INCORRECT',
        'title' => '企业名称格式不正确，请按照提示重新输入',
        'detail' => '企业名称格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'subjectName'
        ),
        'meta' => array()
    ),
    CM_TAXATION_UNIFIED_IDENTIFIER_FORMAT_INCORRECT =>
    array(
        'id' => CM_TAXATION_UNIFIED_IDENTIFIER_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_TAXATION_UNIFIED_IDENTIFIER_FORMAT_INCORRECT',
        'title' => '统一社会信用代码格式不正确，请按照提示重新输入',
        'detail' => '统一社会信用代码格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'unifiedIdentifier'
        ),
        'meta' => array()
    ),
    CM_TAXATION_IDENTIFICATION_NUMBER_FORMAT_INCORRECT =>
    array(
        'id' => CM_TAXATION_IDENTIFICATION_NUMBER_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_TAXATION_IDENTIFICATION_NUMBER_FORMAT_INCORRECT',
        'title' => '纳税人识别号格式不正确，请按照提示重新输入',
        'detail' => '纳税人识别号格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'identificationNumber'
        ),
        'meta' => array()
    ),
    CM_TAXATION_OUTSTANDING_TAX_BALANCE_FORMAT_INCORRECT =>
    array(
        'id' => CM_TAXATION_OUTSTANDING_TAX_BALANCE_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_TAXATION_OUTSTANDING_TAX_BALANCE_FORMAT_INCORRECT',
        'title' => '欠税余额格式不正确，请按照提示重新输入',
        'detail' => '欠税余额格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'outstandingTaxBalance'
        ),
        'meta' => array()
    ),
    CM_TAXATION_TOTAL_TAX_AMOUNT_FORMAT_INCORRECT =>
    array(
        'id' => CM_TAXATION_TOTAL_TAX_AMOUNT_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'CM_TAXATION_TOTAL_TAX_AMOUNT_FORMAT_INCORRECT',
        'title' => '纳税总额格式不正确，请按照提示重新输入',
        'detail' => '纳税总额格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'totalTaxAmount'
        ),
        'meta' => array()
    ),
    MONITOR_OPINION_NAME_FORMAT_INCORRECT =>
    array(
        'id' => MONITOR_OPINION_NAME_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'MONITOR_OPINION_NAME_FORMAT_INCORRECT',
        'title' => '主题名称格式不正确，请按照提示重新输入',
        'detail' => '主题名称格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'name'
        ),
        'meta' => array()
    ),
    MONITOR_OPINION_KEYWORD_FORMAT_INCORRECT =>
    array(
        'id' => MONITOR_OPINION_KEYWORD_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'MONITOR_OPINION_KEYWORD_FORMAT_INCORRECT',
        'title' => '主题关键词格式不正确，请按照提示重新输入',
        'detail' => '主题关键词格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'keyword'
        ),
        'meta' => array()
    ),
    MONITOR_OPINION_CATEGORY_FORMAT_INCORRECT =>
    array(
        'id' => MONITOR_OPINION_CATEGORY_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'MONITOR_OPINION_CATEGORY_FORMAT_INCORRECT',
        'title' => '情感类别格式不正确，请按照提示重新输入',
        'detail' => '情感类别格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'category'
        ),
        'meta' => array()
    ),
    MONITOR_OPINION_SOURCE_FORMAT_INCORRECT =>
    array(
        'id' => MONITOR_OPINION_SOURCE_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'MONITOR_OPINION_SOURCE_FORMAT_INCORRECT',
        'title' => '来源格式不正确，请按照提示重新输入',
        'detail' => '来源格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'source'
        ),
        'meta' => array()
    ),
    MONITOR_OPINION_PUB_DATE_FORMAT_INCORRECT =>
    array(
        'id' => MONITOR_OPINION_PUB_DATE_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'MONITOR_OPINION_PUB_DATE_FORMAT_INCORRECT',
        'title' => '发布时间格式不正确，请按照提示重新输入',
        'detail' => '发布时间格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'pubDate'
        ),
        'meta' => array()
    ),
    MONITOR_OPINION_CONTENT_FORMAT_INCORRECT =>
    array(
        'id' => MONITOR_OPINION_CONTENT_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'MONITOR_OPINION_CONTENT_FORMAT_INCORRECT',
        'title' => '内容格式不正确，请按照提示重新输入',
        'detail' => '内容格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'content'
        ),
        'meta' => array()
    ),
    MONITOR_FOCUS_MONITOR_IDENTIFY_FORMAT_INCORRECT =>
    array(
        'id' => MONITOR_FOCUS_MONITOR_IDENTIFY_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'MONITOR_FOCUS_MONITOR_IDENTIFY_FORMAT_INCORRECT',
        'title' => '主体代码格式不正确，请按照提示重新输入',
        'detail' => '主体代码格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'identify'
        ),
        'meta' => array()
    ),
    MONITOR_FOCUS_MONITOR_SUBJECT_CATEGORY_FORMAT_INCORRECT =>
    array(
        'id' => MONITOR_FOCUS_MONITOR_SUBJECT_CATEGORY_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'MONITOR_FOCUS_MONITOR_SUBJECT_CATEGORY_FORMAT_INCORRECT',
        'title' => '主体类别格式不正确，请按照提示重新输入',
        'detail' => '主体类别格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'subjectCategory'
        ),
        'meta' => array()
    ),
    MONITOR_FOCUS_MONITOR_PENALTY_THRESHOLD_FORMAT_INCORRECT =>
    array(
        'id' => MONITOR_FOCUS_MONITOR_PENALTY_THRESHOLD_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'MONITOR_FOCUS_MONITOR_PENALTY_THRESHOLD_FORMAT_INCORRECT',
        'title' => '行政处罚阈值格式不正确，请按照提示重新输入',
        'detail' => '行政处罚阈值格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'penaltyThreshold'
        ),
        'meta' => array()
    ),
    MONITOR_FOCUS_MONITOR_DISHONESTY_THRESHOLD_FORMAT_INCORRECT =>
    array(
        'id' => MONITOR_FOCUS_MONITOR_DISHONESTY_THRESHOLD_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'MONITOR_FOCUS_MONITOR_DISHONESTY_THRESHOLD_FORMAT_INCORRECT',
        'title' => '严重失信阈值格式不正确，请按照提示重新输入',
        'detail' => '严重失信阈值格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'dishonestyThreshold'
        ),
        'meta' => array()
    ),
    MONITOR_FOCUS_MONITOR_IDENTIFY_EXISTS =>
    array(
        'id' => MONITOR_FOCUS_MONITOR_IDENTIFY_EXISTS,
        'link' => '',
        'status' => 403,
        'code' => 'MONITOR_FOCUS_MONITOR_IDENTIFY_EXISTS',
        'title' => '主体代码已存在，请重新输入',
        'detail' => '主体代码已存在，请重新输入',
        'source' => array(
            'pointer' => 'identify'
        ),
        'meta' => array()
    ),
    SENSITIVE_WORD_NAME_FORMAT_INCORRECT =>
    array(
        'id' => SENSITIVE_WORD_NAME_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'SENSITIVE_WORD_NAME_FORMAT_INCORRECT',
        'title' => '词名格式不正确，请按照提示重新输入',
        'detail' => '词名格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'name'
        ),
        'meta' => array()
    ),
    SENSITIVE_WORD_SOURCE_FORMAT_INCORRECT =>
    array(
        'id' => SENSITIVE_WORD_SOURCE_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'SENSITIVE_WORD_SOURCE_FORMAT_INCORRECT',
        'title' => '来源格式不正确，请按照提示重新输入',
        'detail' => '来源格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'source'
        ),
        'meta' => array()
    ),
    SENSITIVE_WORD_REMARK_FORMAT_INCORRECT =>
    array(
        'id' => SENSITIVE_WORD_REMARK_FORMAT_INCORRECT,
        'link' => '',
        'status' => 403,
        'code' => 'SENSITIVE_WORD_REMARK_FORMAT_INCORRECT',
        'title' => '备注格式不正确，请按照提示重新输入',
        'detail' => '备注格式不正确，请按照提示重新输入',
        'source' => array(
            'pointer' => 'remark'
        ),
        'meta' => array()
    ),
    SENSITIVE_WORD_NAME_EXISTS =>
    array(
        'id' => SENSITIVE_WORD_NAME_EXISTS,
        'link' => '',
        'status' => 403,
        'code' => 'SENSITIVE_WORD_NAME_EXISTS',
        'title' => '词名已存在，请重新输入',
        'detail' => '词名已存在，请重新输入',
        'source' => array(
            'pointer' => 'name'
        ),
        'meta' => array()
    ),
];
