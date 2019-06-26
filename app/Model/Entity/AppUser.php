<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/17
 * Time: 23:04
 */

namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;

/**
 * Class AppUser
 * @Entity(table="app_user",pool="db.pool")
 *
 * @package App\Model\Entity
 */
class AppUser extends Model
{
    /**
     * 自增主键ID
     * @Id(incrementing=true)
     * @Column(name="id",prop="id")
     *
     * @var int|null
     */
    private $id;

    /**
     * 用户账号
     * @Column(name="account",prop="account")
     *
     * @var string|null
     */
    private $account;

    /**
     * 密码
     * @Column(name="passwd",hidden=true)
     *
     * @var string|null
     */
    private $password;

    /**
     * 名称
     * @Column(name="name",prop="name")
     *
     * @var string|null
     */
    private $name;

    /**
     * 性别
     * @Column(name="sex",prop="sex")
     *
     * @var int|null
     */
    private $sex;

    public function getId()
    {
        return $this->id;
    }

    public function setId(?int $id)
    {
        $this->id = $id;
    }

    public function getAccount()
    {
        return $this->account;
    }

    public function setAccount(?string $account)
    {
        $this->account = $account;
    }

    /**
     * @return null|string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param null|string $password
     */
    public function setPassword(?string $password)
    {
        $this->password = $password;
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param int|null $sex
     */
    public function setSex(?int $sex)
    {
        $this->sex = $sex;
    }

    /**
     * 获取用户信息
     *
     * @param int $id 用户ID
     *
     * @return \Swoft\Db\Eloquent\Collection
     */
    public function getUserInfo(int $id)
    {
        return self::where('id', '=', $id)->get();
    }

}