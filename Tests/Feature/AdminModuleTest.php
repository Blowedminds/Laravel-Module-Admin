<?php


namespace App\Modules\Admin\Tests\Feature;

use App\Modules\Core\Category;
use App\Modules\Core\Language;
use App\Modules\Core\Menu;
use App\Modules\Core\Permission;
use App\Modules\Core\Role;
use App\Modules\Core\Tests\TestCase;
use App\Modules\Core\User;
use App\Modules\Core\UserData;

class AdminModuleTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware([\App\Modules\Core\Http\Middleware\Permission::class]);

        $this->user = factory(User::class)->make();
    }

    public function testRoutes(): void
    {
        $this->assertTrue($this->checkRoute($this->adminRoute . 'users'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'user/{user_id}'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'user', 'post'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'user/{user_id}', 'put'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'user/{user_id}', 'delete'));

        $this->assertTrue($this->checkRoute($this->adminRoute . 'menus'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'menu', 'post'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'menu/{menu_id}', 'put'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'menu/{menu_id}', 'delete'));

        $this->assertTrue($this->checkRoute($this->adminRoute . 'categories'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'category', 'post'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'category/{category_id}', 'put'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'category/{category_id}', 'delete'));

        $this->assertTrue($this->checkRoute($this->adminRoute . 'languages'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'language', 'post'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'language/{language_id}', 'put'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'language/{language_id}', 'delete'));

        $this->assertTrue($this->checkRoute($this->adminRoute . 'roles'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'role/{role_id}'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'role', 'post'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'role/{role_id}', 'put'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'role/{role_id}', 'delete'));

        $this->assertTrue($this->checkRoute($this->adminRoute . 'permissions'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'permission', 'post'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'permission/{permission_id}', 'put'));
        $this->assertTrue($this->checkRoute($this->adminRoute . 'permission/{permission_id}', 'delete'));
    }

    public function testGetMenus()
    {
        $this->getManyTest(Menu::class, $this->adminRoute . 'menus', $this->user);
    }

    public function testGetCategories()
    {
        $this->getManyTest(Category::class, $this->adminRoute . 'categories', $this->user);
    }

    public function testGetLanguages()
    {
        $this->getManyTest(Language::class, $this->adminRoute . 'languages', $this->user);
    }

    public function testGetPermissions()
    {
        $this->getManyTest(Permission::class, $this->adminRoute . 'permissions', $this->user);
    }

    public function testgetRoles()
    {
        $this->getManyTest(Role::class, $this->adminRoute . 'roles', $this->user);
    }

    public function testGetUsers()
    {
        $this->getManyTest(User::class, $this->adminRoute . 'users', $this->user);
    }

    public function testPostMenu()
    {
        $this->postTest(Menu::class, $this->adminRoute . 'menu', $this->user, ['roles' => [random_int(0, 100), random_int(0, 100)]]);
    }

    public function testPostCategory()
    {
        $this->postTest(Category::class, $this->adminRoute . 'category', $this->user);
    }

    public function testPostLanguage()
    {
        $this->postTest(Language::class, $this->adminRoute . 'language', $this->user);
    }

    public function testPostPermission()
    {
        $this->postTest(Permission::class, $this->adminRoute . 'permission', $this->user);
    }

    public function testPostRole()
    {
        $this->postTest(Role::class, $this->adminRoute . 'role', $this->user, ['permissions' => [random_int(0, 1000), random_int(0, 1000)]]);
    }

    /*
     * This feature currently does not work
     */
    public function testPostUser()
    {
        $this->assertTrue(true);
    }

    public function testPutMenu()
    {
        $this->putTest(Menu::class, $this->adminRoute . 'menu/', 'id', $this->user, ['roles' => [random_int(0, 100), random_int(0, 100)]]);
    }

    public function testPutCategory()
    {
        $this->putTest(Category::class, $this->adminRoute . 'category/', 'id', $this->user);
    }

    public function testPutLanguage()
    {
        $this->putTest(Language::class, $this->adminRoute . 'language/', 'id', $this->user);
    }

    public function testPutPermission()
    {
        $this->putTest(Permission::class, $this->adminRoute . 'permission/', 'id', $this->user);
    }

    public function testPutRole()
    {
        $this->putTest(Role::class, $this->adminRoute . 'role/', 'id', $this->user, ['permissions' => [random_int(0, 1000), random_int(0, 1000)]]);
    }

    public function testPutUser()
    {
        $userData = factory(UserData::class)->create();

        $role = factory(Role::class)->create();

        $user1 = factory(User::class)->make();

        $input = $user1->toArray();

        $this->actingAs($this->user)->json('PUT', $this->adminRoute . "user/{$userData->user_id}",
            array_merge($input, [
                'role_id' => $role->id
            ]))->assertStatus(200);

        $input['user_id'] = $userData->user_id;

        $this->assertDatabaseHas($user1->getTable(), array_merge($input, ['id' => $userData->user->id]));
    }

    public function testDeleteMenu()
    {
        $this->deleteTest(Menu::class, $this->adminRoute . 'menu/' , 'id', $this->user);
    }

    public function testDeleteCategory()
    {
        $this->deleteTest(Category::class, $this->adminRoute . 'category/', 'id', $this->user);
    }

    public function testDeleteLanguage()
    {
        $this->deleteTest(Language::class, $this->adminRoute . 'language/', 'id', $this->user);
    }

    public function testDeletePermission()
    {
        $this->deleteTest(Permission::class, $this->adminRoute . 'permission/', 'id', $this->user);
    }

    public function testDeleteRole()
    {
        $this->deleteTest(Role::class, $this->adminRoute . 'role/', 'id', $this->user);
    }

    public function testDeleteUser()
    {
        $this->deleteTest(User::class, $this->adminRoute . 'user/', 'user_id', $this->user);
    }
}
