<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'owner'
        ]);

        DB::table('permissions')->insert([
            ['name' => 'dashboard','guard_name' => 'web'],
            ['name' => 'manajemen bisnis','guard_name' => 'web'],
            ['name' => 'manajemen produk','guard_name' => 'web'],
            ['name' => 'manajemen kasir','guard_name' => 'web'],
            ['name' => 'manajemen user','guard_name' => 'web'],
            ['name' => 'laporan','guard_name' => 'web'],
            ['name' => 'bahan baku','guard_name' => 'web'],
        ]);

        DB::table('role_has_permissions')->insert([
            ['role_id' => 1, 'permission_id' => 1],
            ['role_id' => 1, 'permission_id' => 2],
            ['role_id' => 1, 'permission_id' => 3],
            ['role_id' => 1, 'permission_id' => 4],
            ['role_id' => 1, 'permission_id' => 5],
            ['role_id' => 1, 'permission_id' => 6],
            ['role_id' => 1, 'permission_id' => 7],
        ]);
    }
}
