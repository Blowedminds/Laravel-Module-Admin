<?php

namespace App\Modules\Admin\Tests\Feature;

use App\Modules\Core\Permission;

class PermissionController extends AdminModuleTestDriver
{
    protected $prefix = 'permission/';

    public function testRoutes(): void
    {
        $this->assertTrue($this->checkRoute($this->getUrl('permissions')));
        $this->assertTrue($this->checkRoute($this->getUrl('permission'), 'post'));
        $this->assertTrue($this->checkRoute($this->getUrl('permission/{permission_id}'), 'put'));
        $this->assertTrue($this->checkRoute($this->getUrl('permission/{permission_id}'), 'delete'));
    }

    public function testGetPermissions(): void
    {
        $this->getManyTest(Permission::class, $this->getUrl('permissions'), $this->user);
    }

    public function testPostPermission(): void
    {
        $this->postTest(Permission::class, $this->getUrl('permission'), $this->user);
    }

    public function testPutPermission(): void
    {
        $this->putTest(Permission::class, $this->getUrl('permission/'), 'id', $this->user);
    }

    public function testDeletePermission(): void
    {
        $this->deleteTest(Permission::class, $this->getUrl('permission/'), 'id', $this->user);
    }
}
