<?php declare(strict_types=1);
namespace App\Validator;

class BaseValidator
{
    /**
     * 验证错误
     *
     * @param string $param   参数
     * @param string $message 提示信息
     *
     * @return array
     */
    public function error(string $param, string $message)
    {
        $result = [
            'error' => [
                'param'   => $param,
                'message' => $message ? $message : $param . ' error'
            ]
        ];
        return $result;
    }

    /**
     * 验证成功
     *
     * @param array $data 返回数据
     *
     * @return array
     */
    public function success(array $data = [])
    {
        $result = [
            'error' => false,
            'data'  => $data,
        ];
        return $result;
    }
}