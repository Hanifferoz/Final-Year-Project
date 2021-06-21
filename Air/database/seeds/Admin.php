<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=new User();
        $data->name='Admin';
        $data->email='admin@admin.com';
        $data->password=Hash::make('7890poiu');
        $data->save();
    }
}
