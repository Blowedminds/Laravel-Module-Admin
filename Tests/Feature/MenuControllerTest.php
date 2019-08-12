<?php

namespace App\Modules\Admin\Tests\Feature;

use App\Modules\Core\Menu;

class MenuControllerTest extends AdminModuleTestDriver
{
    protected $prefix = 'menu/';

    public function testRoutes(): void
    {
        $this->assertTrue($this->checkRoute($this->getUrl('menus')));
        $this->assertTrue($this->checkRoute($this->getUrl('menu'), 'post'));
        $this->assertTrue($this->checkRoute($this->getUrl('menu/{menu_id}'), 'put'));
        $this->assertTrue($this->checkRoute($this->getUrl('menu/{menu_id}'), 'delete'));
    }

    public function testGetMenus(): void
    {
        $this->getManyTest(Menu::class, $this->getUrl('menus'), $this->user);
    }

    public function testPostMenu(): void
    {
        $this->postTest(Menu::class, $this->getUrl('menu'), $this->user, ['roles' => [random_int(0, 100), random_int(0, 100)]]);
    }

    public function testPutMenu(): void
    {
        $this->putTest(Menu::class, $this->getUrl('menu/'), 'id', $this->user, ['roles' => [random_int(0, 100), random_int(0, 100)]]);
    }

    public function testDeleteMenu(): void
    {
        $this->deleteTest(Menu::class, $this->getUrl('menu/'), 'id', $this->user);
    }
}
