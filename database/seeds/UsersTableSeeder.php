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
        \App\Models\AdminUser::create([
            'first_name' => 'Kamlesh',
            'last_name' => 'S',
            'email' => 'kamleshh.bms@gmail.com',
            'username' => 'kamlesh',
            'password' => bcrypt('admin')
        ]);
    }
}
