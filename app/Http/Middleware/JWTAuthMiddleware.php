<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/15
 * Time: 22:29
 */

namespace App\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Context\Context;
use Swoft\Http\Server\Contract\MiddlewareInterface;

/**
 * JWT 认证
 * @Bean()
 */
class JWTAuthMiddleware implements MiddlewareInterface
{

    /**
     * 中间件处理函数
     *
     * @param ServerRequestInterface  $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     * @inheritdoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // before request handle
        // 判断token
        $token  = $request->getHeaderLine("token");
        $type   = \config('jwt.type');
        $public = \config('jwt.publicKey');
        try {
            $auth          = JWT::decode($token, $public, ['type' => $type]);
            $request->user = $auth->user;
        } catch (\Exception $e) {
            $json     = ['code' => 0, 'msg' => '授权失败'];
            $response = Context::mustGet()->getResponse();
            return $response->withData($json);
        }
        $response = $handler->handle($request);
        return $response;
        // after request handle
    }
}