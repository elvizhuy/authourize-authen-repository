<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // DB::statement('SET GLOBAL FOREIGN_KEY_CHECKS = 0');

        // $groupID = DB::table('groups')->insertGetId([
        //     'name' => 'Administrator',
        //     'user_id' => 0,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);
        // // DB::statement('SET GLOBAL FOREIGN_KEY_CHECKS = 1');
        // if ($groupID > 0) {
        //     $userID = DB::table('users')->insertGetId([
        //         'name' => 'Ngọc Huy',
        //         'email' => 'elvizhuy@gmail.com',
        //         'password' => Hash::make('123456'),
        //         'groups_id' => $groupID,
        //         'user_id' => 0,
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s')
        //     ]);
        //     if ($userID > 0) {
        //         for ($i = 1; $i <= 5; $i++) {
        //             DB::table('posts')->insertGetId([
        //                 'title' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.',
        //                 'content' => 'Quis commodo odio aenean sed. Lectus quam id leo in vitae turpis. Nunc sed blandit libero volutpat sed. Tortor id aliquet lectus proin nibh nisl. Cursus eget nunc scelerisque viverra mauris in aliquam. In dictum non consectetur a. Et magnis dis parturient montes nascetur. Cras tincidunt lobortis feugiat vivamus at augue eget arcu. Adipiscing enim eu turpis egestas. Mauris commodo quis imperdiet massa tincidunt nunc pulvinar sapien. Rhoncus mattis rhoncus urna neque viverra justo.',
        //                 'user_id' => $userID,
        //                 'created_at' => date('Y-m-d H:i:s'),
        //                 'updated_at' => date('Y-m-d H:i:s')
        //             ]);
        //         }
        //     }
        // }

        DB::table('modules')->insert([
            'name' => 'users',
            'title' => 'User Management',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('modules')->insert([
            'name' => 'groups',
            'title' => 'Group Management',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('modules')->insert([
            'name' => 'posts',
            'title' => 'Post Management',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
