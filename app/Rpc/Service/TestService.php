<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/15
 * Time: 23:21
 */

namespace App\Rpc\Service;

use Jirry\Rpc\Services\Interfaces\TestInterface;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * RPC 测试服务
 * @Service()
 *
 * @package App\Rpc\Service
 */
class TestService implements TestInterface
{
    /**
     * 添加数据
     *
     * @param array $rowData 数据
     *
     * @return int
     */
    public function addRow(array $rowData = []): int
    {
        return 1;
    }

    /**
     * 查询数据
     *
     * @param int $id 数据ID
     *
     * @return array
     */
    public function selectRow(int $id): array
    {
        $data = [
            'id'   => 1,
            'name' => 'jirenyou',
            'age'  => 99
        ];
        return $data;
    }

    public function updateRow(int $id, array $data): bool
    {
        // TODO: Implement updateRow() method.
    }
}