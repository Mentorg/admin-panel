<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'postShow',
            'postList',
            'postCreate',
            'postEdit',
            'postDelete',
            'fileShow',
            'fileList',
            'fileCreate',
            'fileEdit',
            'fileDownload',
            'fileDelete',
            'userShow',
            'userList',
            'userCreate',
            'userEdit',
            'userDelete',
            'roleShow',
            'roleList',
            'roleCreate',
            'roleEdit',
            'roleDelete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
