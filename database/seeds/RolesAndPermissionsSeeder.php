<?php

use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    // Reset cached roles and permissions
    app()['cache']->forget('spatie.permission.cache');

    
    Role::create(['name' => 'user']);    /** @var \App\User $user */
    $user = factory(\app\User::class)->create();

    $user->assignRole('user');    Role::create(['name' => 'admin']);

    /** @var \App\User $user */
    $admin = factory(\app\User::class)->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);

    $admin->assignRole('admin');
}
}
