<?php

namespace App\Modules\Admin\Tests\Feature;

use App\Modules\Core\Language;

class LanguageControllerTest extends AdminModuleTestDriver
{
    protected $prefix = 'language/';

    public function testRoutes(): void
    {
        $this->assertTrue($this->checkRoute($this->getUrl('languages')));
        $this->assertTrue($this->checkRoute($this->getUrl('language'), 'post'));
        $this->assertTrue($this->checkRoute($this->getUrl('language/{language_id}'), 'put'));
        $this->assertTrue($this->checkRoute($this->getUrl('language/{language_id}'), 'delete'));
    }

    public function testGetLanguages(): void
    {
        $this->getManyTest(Language::class, $this->getUrl('languages'), $this->user);
    }

    public function testPostLanguage(): void
    {
        $this->postTest(Language::class, $this->getUrl('language'), $this->user);
    }

    public function testPutLanguage(): void
    {
        $this->putTest(Language::class, $this->getUrl('language/'), 'id', $this->user);
    }

    public function testDeleteLanguage(): void
    {
        $this->deleteTest(Language::class, $this->getUrl('language/'), 'id', $this->user);
    }
}
