<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/15
 * Time: 23:16
 */

namespace App\Rpc\Lib;

/**
 * Interface TestInterface
 *
 * @package App\Rpc\Lib
 */
interface TestInterface
{
    /**
     * 添加数据
     *
     * @param array $rowData 数据
     *
     * @return int
     */
    public function addRow(array $rowData = []): int;

    /**
     * 查询数据
     *
     * @param int $id 数据ID
     *
     * @return array
     */
    public function selectRow(int $id): array;
}