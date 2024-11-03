<?php


use \Tests\TestCase;
use \Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    protected static $user = null;

    public static function setUpBeforeClass(): void
    {
        echo shell_exec('php artisan migrate:fresh');
    }

    public function test_store_user(): void
    {
        $userService = app()->make(\App\Services\UsersService::class);

        self::$user = $userService->create([
            'name' => 'emad.asgari',
            'email' => 'emad.asgari@gmail.com',
            'password' => '123456'
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'emad.asgari',
            'email' => 'emad.asgari@gmail.com'
        ]);
    }

    public function test_update_user(): void
    {
        $userService = app()->make(\App\Services\UsersService::class);

        self::$user = $userService->update(self::$user, [
            'name' => 'emad.asgari2',
            'email' => 'emad.asgari2@gmail.com'
        ]);

        $this->assertDatabaseHas('users', [
            'id' => self::$user->id,
            'name' => 'emad.asgari2',
            'email' => 'emad.asgari2@gmail.com'
        ]);
    }

    public function test_delete_user(): void
    {
        $userService = app()->make(\App\Services\UsersService::class);

        $userId = self::$user;

        $userService->delete(self::$user);

        $this->assertDatabaseMissing('users', [
            'id' => $userId
        ]);
    }
}
