<?php declare(strict_types=1);
/**
 * Controller 控制器基类
 *
 * @todo     控制器基类，所有控制器继承
 * @package  App\Http\Controller 控制器
 * @link     http://www.zhaoliangji.com/
 * @author   找靓机 PHP DEV TEAM jry(jirenyou@aliyun.com)
 * @datetime 2019/6/13 16:14
 */

namespace App\Http\Controller;

use Swoft\Http\Server\Annotation\Mapping\Controller;

/**
 * Class BaseController
 * @Controller()
 *
 * @package App\Http\Controller
 */
class BaseController
{
    /**
     * 响应请求
     *
     * @param string|array $data       响应数据
     * @param int          $statusCode 响应状态码
     * @param array        $headers    响应头信息
     *
     * @return \Swoft\Http\Message\Response
     */
    public function response($data = null, int $statusCode = STATUS_CODE_SUCCESS, array $headers = [])
    {
        $response = response();

        // 设置状态码
        $response = $response->withStatus($statusCode);

        // 设置头信息
        $response = $response->withHeaders($headers);

        // 设置响应数据
        $response = is_string($data) ? $response->withContent($data) : $response->withData($data);

        return $response;
    }

    /**
     * 请求处理成功
     *
     * @param array       $data 成功数据
     * @param string|null $msg  成功信息
     *
     * @return \Swoft\Http\Message\Response
     */
    public function success(array $data = [], string $msg = null)
    {
        $response = [
            'code'   => API_CODE_SUCCESS
            , 'msg'  => is_null($msg) ? '请求处理成功！' : $msg
            , 'data' => $data
        ];
        return $this->response($response);
    }

    /**
     * 请求处理失败
     *
     * @param string|null $msg  失败信息
     * @param array       $data 失败数据
     *
     * @return \Swoft\Http\Message\Response
     */
    public function failure(string $msg = null, array $data = [])
    {
        $response = [
            'code'   => API_CODE_FAILURE
            , 'msg'  => is_null($msg) ? '请求处理失败！' : $msg
            , 'data' => $data
        ];
        return $this->response($response);
    }
}