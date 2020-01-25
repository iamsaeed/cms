<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new App\User;
        $user->name = 'Super Admin';
        $user->email = 'superadmin@app.com';
        $user->password = bcrypt('password');
        $user->save();

        // $this->call(UsersTableSeeder::class);
        factory(App\User::class, 10)->create();
        factory(App\Category::class, 50)->create();
        factory(App\Blog::class, 200)->create();
    }
}
