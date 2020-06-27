<?php

use Illuminate\Database\Seeder;
use app\Model\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Role::class, 1)->create();
    }
}