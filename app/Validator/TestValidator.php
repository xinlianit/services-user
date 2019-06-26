<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\Validator;
use Swoft\Validator\Contract\ValidatorInterface;

/**
 * Class TestValidator
 * @Validator(name="testValidator")
 *
 * @package App\Validator
 */
class TestValidator extends BaseValidator implements ValidatorInterface
{
    /**
     * 验证器
     *
     * @param array $data   输入数据
     * @param array $params 验证器参数
     *
     * @return array
     */
    public function validate(array $data, array $params): array
    {
        // 账号
        if (!isset($data['account']) || empty($data['account'])) {
            return $this->error('account', '账号不能为空！');
        }

        return $this->success($data);
    }
}