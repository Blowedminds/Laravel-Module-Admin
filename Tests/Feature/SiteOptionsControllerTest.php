<?php

namespace App\Modules\Admin\Tests\Feature;

use App\Modules\Admin\SiteOption;

class SiteOptionsControllerTest extends AdminModuleTestDriver
{
    protected $prefix = 'option/';

    public function testRoutes(): void
    {
        $this->assertTrue($this->checkRoute($this->getUrl('options')));
        $this->assertTrue($this->checkRoute($this->getUrl('option'), 'post'));
        $this->assertTrue($this->checkRoute($this->getUrl('option/{option_key}'), 'put'));
        $this->assertTrue($this->checkRoute($this->getUrl('option/{option_key}'), 'delete'));
    }

    public function testGetOptions(): void
    {
        $this->getManyTest(SiteOption::class, $this->getUrl('options'), $this->user);
    }

    public function testPostOption(): void
    {
        $this->postTest(SiteOption::class, $this->getUrl('option'), $this->user);
    }

    public function testPutOption(): void
    {
        $this->putTest(SiteOption::class, $this->getUrl('option/'), 'key', $this->user, [], ['key', 'type']);
    }

    public function testDeleteOption(): void
    {
        $this->deleteTest(SiteOption::class, $this->getUrl('option/'), 'key', $this->user);
    }
}
