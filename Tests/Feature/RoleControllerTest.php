<?php

namespace App\Modules\Admin\Tests\Feature;

use App\Modules\Core\Role;

class RoleControllerTest extends AdminModuleTestDriver
{
    protected $prefix = 'role/';

    public function testRoutes(): void
    {
        $this->assertTrue($this->checkRoute($this->getUrl('roles')));
        $this->assertTrue($this->checkRoute($this->getUrl('role/{role_id}')));
        $this->assertTrue($this->checkRoute($this->getUrl('role'), 'post'));
        $this->assertTrue($this->checkRoute($this->getUrl('role/{role_id}'), 'put'));
        $this->assertTrue($this->checkRoute($this->getUrl('role/{role_id}'), 'delete'));
    }

    public function testGetRoles(): void
    {
        $this->getManyTest(Role::class, $this->getUrl('roles'), $this->user);
    }

    public function testPostRole(): void
    {
        $this->postTest(Role::class, $this->getUrl('role'), $this->user, ['permissions' => [random_int(0, 1000), random_int(0, 1000)]]);
    }

    public function testPutRole(): void
    {
        $this->putTest(Role::class, $this->getUrl('role/'), 'id', $this->user, ['permissions' => [random_int(0, 1000), random_int(0, 1000)]]);
    }

    public function testDeleteRole(): void
    {
        $this->deleteTest(Role::class, $this->getUrl('role/'), 'id', $this->user);
    }
}
