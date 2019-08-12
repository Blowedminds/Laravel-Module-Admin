<?php

namespace App\Modules\Admin\Tests\Feature;

use App\Modules\Core\Tests\TestCase;
use App\Modules\Core\User;

abstract class AdminModuleTestDriver extends TestCase
{
    protected $user;

    protected $prefix;

    public function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware([\App\Modules\Core\Http\Middleware\Permission::class]);

        $this->user = factory(User::class)->make();
    }

    protected function getUrl($path): string
    {
        return $this->adminRoute . $this->prefix . $path;
    }
}
