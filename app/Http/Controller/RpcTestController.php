<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/15
 * Time: 23:38
 */

namespace App\Http\Controller;

use Jirry\Rpc\Services\Interfaces\TestInterface;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Rpc\Client\Annotation\Mapping\Reference;

/**
 * RPC 测试控制器
 * @Controller()
 *
 * @package App\Http\Controller
 */
class RpcTestController extends BaseController
{
    /**
     * 测试服务
     * @Reference(pool="test.pool")
     *
     * @var TestInterface
     */
    private $testService;

    /**
     * 获取数据
     * @RequestMapping(method={RequestMethod::GET},route="getData")
     *
     * @return \Swoft\Http\Message\Response
     */
    public function getData()
    {
        $id   = getData('id', 0);
        $data = $this->testService->selectRow((int)$id);
        return $this->success($data);
    }
}