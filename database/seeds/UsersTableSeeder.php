<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            //'parent_id' => ,
            'status' => 'manager',
            'name' => 'Admin',
            'salary' => 2,
            'email' => 'admin@mail.ru',
            'password' => bcrypt('111111'),
            'phone' => '8-952-881-01-95',
            'about' => 'Some words about me. The short history last time, which tell us about some occasions. That is so interesting.',
        ]);

        DB::table('users')->insert([
            'parent_id' => 1,
            'status' => 'employee',
            'name' => 'Andrey',
            'salary' => 1,
            'email' => 'andrey@mail.ru',
            'password' => bcrypt('111111'),
            'phone' => '8-952-000-11-22',
            'about' => 'Some words about me. The short history last time, which tell us about some occasions. That is so interesting.',
        ]);

        DB::table('users')->insert([
            'parent_id' => 1,
            'status' => 'employee',
            'name' => 'Pavel',
            'salary' => 1,
            'email' => 'pavel@mail.ru',
            'password' => bcrypt('111111'),
            'phone' => '8-952-000-22-33',
            'about' => 'Some words about me. The short history last time, which tell us about some occasions. That is so interesting.',
        ]);

        DB::table('users')->insert([
            'parent_id' => 1,
            'status' => 'manager',
            'name' => 'Ivan',
            'salary' => 2,
            'email' => 'ivan@mail.ru',
            'password' => bcrypt('111111'),
            //'phone' => '',
            'about' => 'Some words about me. The short history last time, which tell us about some occasions. That is so interesting.',
        ]);

        DB::table('users')->insert([
            //'parent_id' => ,
            'status' => 'manager',
            'name' => 'Roman',
            'salary' => 1,
            'email' => 'roman@mail.ru',
            'password' => bcrypt('111111'),
            //'phone' => '',
            'about' => 'Some words about me. The short history last time, which tell us about some occasions. That is so interesting.',
        ]);

        DB::table('users')->insert([
            'parent_id' => 4,
            'status' => 'employee',
            'name' => 'Leonid',
            'salary' => 1,
            'email' => 'leonid@mail.ru',
            'password' => bcrypt('111111'),
            //'phone' => '',
            'about' => 'Some words about me. The short history last time, which tell us about some occasions. That is so interesting.',
        ]);

        DB::table('users')->insert([
            //'parent_id' => ,
            'status' => 'employee',
            'name' => 'Anton',
            'salary' => 1,
            'email' => 'anton@mail.ru',
            'password' => bcrypt('111111'),
            //'phone' => '',
            'about' => 'Some words about me. The short history last time, which tell us about some occasions. That is so interesting.',
        ]);
    }
}
