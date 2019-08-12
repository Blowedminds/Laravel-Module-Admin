<?php

namespace App\Modules\Admin\Tests\Feature;

use App\Modules\Core\Category;

class CategoryControllerTest extends AdminModuleTestDriver
{
    protected $prefix = 'category/';

    public function testRoutes(): void
    {
        $this->assertTrue($this->checkRoute($this->getUrl('categories')));
        $this->assertTrue($this->checkRoute($this->getUrl('category'), 'post'));
        $this->assertTrue($this->checkRoute($this->getUrl('category/{category_id}'), 'put'));
        $this->assertTrue($this->checkRoute($this->getUrl('category/{category_id}'), 'delete'));
    }

    public function testGetCategories(): void
    {
        $this->getManyTest(Category::class, $this->getUrl('categories'), $this->user);
    }

    public function testPostCategory(): void
    {
        $this->postTest(Category::class, $this->getUrl('category'), $this->user);
    }

    public function testPutCategory(): void
    {
        $this->putTest(Category::class, $this->getUrl('category/'), 'id', $this->user);
    }

    public function testDeleteCategory(): void
    {
        $this->deleteTest(Category::class, $this->getUrl('category/'), 'id', $this->user);
    }
}
