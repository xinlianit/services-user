<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\Validator;
use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\IsString;

/**
 * Class AppUserValidator
 * @Validator()
 */
class AppUserValidator
{
    /**
     * 用户ID
     * @IsInt(message="用户ID必须且整数")
     *
     * @var int
     */
    protected $id;

    /**
     * 账号
     * @IsString(message="账号不能为空")
     *
     * @var string
     */
    protected $account;

    /**
     * 密码
     * @IsString(message="密码不能为空")
     *
     * @var string
     */
    protected $password;

    /**
     * 名称
     * @IsString(message="名称不能为空")
     *
     * @var string
     */
    protected $name;

    /**
     * 性别
     * @IsInt(message="性别必须")
     *
     * @var int
     */
    protected $sex = 1;
}