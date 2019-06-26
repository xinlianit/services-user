<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/17
 * Time: 23:27
 */

namespace App\Model\Logic;

use App\Model\Entity\AppUser;

class AppUserLogic
{
    /**
     * 获取用户信息
     *
     * @param int $userId 用户ID
     *
     * @return \Swoft\Db\Eloquent\Collection
     * @throws \Swoft\Db\Exception\DbException
     */
    public function userInfo(int $userId)
    {
        $userModel = new AppUser();
        return $userModel->getUserInfo($userId);
    }
}