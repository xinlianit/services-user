<?php declare(strict_types=1);
/**
 * 测试控制器
 *
 * @package  App\Http\Controller 控制器
 * @link     http://www.zhaoliangji.com/
 * @author   找靓机 PHP DEV TEAM jry(jirenyou@aliyun.com)
 * @datetime 2019/6/13 16:31
 */

namespace App\Http\Controller;

use App\Model\Logic\AppUserLogic;
use App\Validator\AppUserValidator;
use swoft\base\Services;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\Middlewares;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Log\Helper\CLog;
use Swoft\Log\Helper\Log;
use Swoft\Redis\Pool;
use Swoft\Validator\Annotation\Mapping\Validate;
use Swoft\Validator\Annotation\Mapping\ValidateType;

/**
 * Class TestController
 * @Controller(prefix="/test")
 * @Middlewares({
 *     @Middleware(App\Http\Middleware\AuthMiddleware::class)
 * })
 *
 * @package App\Http\Controller
 */
class TestController extends BaseController
{
    /**
     * Redis 连接池
     * @Inject("redis.pool")
     *
     * @var Pool
     */
    private $redis;

    /**
     * 首页
     * @RequestMapping(route="index")
     *
     * @return \Swoft\Http\Message\Response
     */
    public function index()
    {
        $bean = bean('db');
        print_r($bean);
        $data = [
            'name'   => 'swoft'
            , 'age'  => 10
            , 'test' => bean('httpServer')
        ];
        return $this->success($data);
    }

    /**
     * 获取URL中Name
     * @RequestMapping(method={RequestMethod::GET},route="getUrlName[/{name}]")
     *
     * @param string $name 名称
     *
     * @return \Swoft\Http\Message\Response
     */
    public function getUrlName(string $name)
    {
        $data = [
            'name' => $name
        ];
        return $this->success($data);
    }

    /**
     * 获取请求数据
     * @RequestMapping(method={RequestMethod::GET,RequestMethod::POST},route="getRequest")
     *
     * @return \Swoft\Http\Message\Response
     */
    public function getRequest()
    {
        $name = getData('name');
        $data = [
            'header'               => headerData($name)
            , 'headers'            => headerData()
            , 'get'                => getData()
            , 'post'               => postData()
            , 'josn'               => request()->json()
            , 'raw'                => request()->raw()
            , 'server'             => request()->getServerParams()
            , 'server_request_uri' => request()->server('request_uri')
        ];
        return $this->success($data);
    }

    /**
     * 获取名称
     * @RequestMapping(method={RequestMethod::GET},route="getName")
     *
     * @return \Swoft\Http\Message\Response
     */
    public function getName()
    {
        $name = getData('name');

        $data = [
            'name' => $name
        ];
        return $this->success($data);
    }

    /**
     * 中间件参数验证
     * @RequestMapping(method={RequestMethod::GET},route="middlewareCheckParams")
     * @Middleware(App\Http\Middleware\ActionMiddleware::class)
     *
     * @return \Swoft\Http\Message\Response
     */
    public function middlewareCheckParams()
    {
        $getData = getData();
        return $this->success($getData);
    }

    /**
     * JWT 登录
     * @RequestMapping(method={RequestMethod::POST},route="jwtAuth")
     * @Middleware(App\Http\Middleware\JWTAuthMiddleware::class)
     *
     * @return \Swoft\Http\Message\Response
     */
    public function jwtAuth()
    {
        $data = [
            'user' => request()
        ];
        return $this->success($data);
    }

    /**
     * 获取用户信息
     * @RequestMapping(method={RequestMethod::GET},route="getUserInfo")
     *
     * @return \Swoft\Http\Message\Response
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getUserInfo()
    {
        $userId    = getData('user_id', 0);
        $userLogic = new AppUserLogic();

        $result = $userLogic->userInfo((int)$userId);

        return $this->success(['a' => $result]);
    }

    /**
     * 获取 redis 数据
     * @RequestMapping(method={RequestMethod::GET},route="getRedisData")
     *
     * @return \Swoft\Http\Message\Response
     */
    public function getRedisData()
    {
        $redisKey = 'user:id_1';
        $result   = $this->redis->set($redisKey, '123');
        $data     = [
            'result' => $result,
            'data'   => $this->redis->get($redisKey)
        ];
        return $this->success($data);
    }

    /**
     * 验证器
     * @RequestMapping(method={RequestMethod::GET,RequestMethod::POST},route="validator")
     * @Validate(validator="testValidator")
     *
     * @return \Swoft\Http\Message\Response
     */
    public function validator()
    {
        $params = queryData();
//        if ($params['error']) {
//            return $this->failure($params['error']['message']);
//        }
        $data[] = $params;
        return $this->success($data);
    }

    /**
     * 日志调试
     * @RequestMapping(method={RequestMethod::GET},route="logs")
     *
     * @return \Swoft\Http\Message\Response
     */
    public function logs()
    {
        Log::info("aaa111");
        $data = [];
        return $this->success($data);
    }
}