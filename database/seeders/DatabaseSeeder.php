<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $seeded = '';
        foreach (range(0,1) as $n) {
            $name = Str::random(10);
            $email = Str::random(10).'@hemulen.it';
            $password = Str::random(8);

            DB::table('users')->insert([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
            ]);
            $seeded .= sprintf("name: %s\nemail:%s\npassword: %s\n", $name, $email, $password);
        }
        file_put_contents("seed_users.txt",
            $seeded, FILE_APPEND);
        echo PHP_EOL . "PREDEFINED USERS:" . PHP_EOL . $seeded . PHP_EOL;
    }
}
