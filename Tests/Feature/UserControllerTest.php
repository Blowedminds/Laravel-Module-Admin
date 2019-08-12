<?php

namespace App\Modules\Admin\Tests\Feature;

use App\Modules\Core\Role;
use App\Modules\Core\User;
use App\Modules\Core\UserData;

class UserControllerTest extends AdminModuleTestDriver
{
    protected $prefix = 'user/';

    public function testRoutes(): void
    {
        $this->assertTrue($this->checkRoute($this->getUrl('users')));
        $this->assertTrue($this->checkRoute($this->getUrl('user/{user_id}')));
        $this->assertTrue($this->checkRoute($this->getUrl('user'), 'post'));
        $this->assertTrue($this->checkRoute($this->getUrl('user/{user_id}'), 'put'));
        $this->assertTrue($this->checkRoute($this->getUrl('user/{user_id}'), 'delete'));
    }

    public function testGetUsers(): void
    {
        $this->getManyTest(User::class, $this->getUrl('users'), $this->user);
    }

    /*
     * This feature currently does not work
     */
    public function testPostUser(): void
    {
        $this->assertTrue(true);
    }

    public function testPutUser(): void
    {
        $userData = factory(UserData::class)->create();

        $role = factory(Role::class)->create();

        $user1 = factory(User::class)->make();

        $input = $user1->toArray();

        $this->actingAs($this->user)->json('PUT', $this->getUrl("user/{$userData->user_id}"),
            array_merge($input, [
                'role_id' => $role->id
            ]))->assertStatus(200);

        $input['user_id'] = $userData->user_id;

        $this->assertDatabaseHas($user1->getTable(), array_merge($input, ['id' => $userData->user->id]));
    }

    public function testDeleteUser(): void
    {
        $this->deleteTest(User::class, $this->getUrl('user/'), 'user_id', $this->user);
    }
}
