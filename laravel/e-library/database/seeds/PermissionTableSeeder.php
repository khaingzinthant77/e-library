<?php

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
           'dashboard',
           'book_issue_list',
           'book_issue_create',
           'book_issue_edit',
           'book_issue_delete',

           'member_list',
           'member_create',
           'member_edit',
           'member_delete',

           'ebook_list',
           'ebook_create',
           'ebook_edit',
           'ebook_delete',

           'author_list',
           'author_create',
           'author_edit',
           'author_delete',

           'book_list',
           'book_create',
           'book_edit',
           'book_delete',

           'rack_list',
           'rack_create',
           'rack_edit',
           'rack_delete',

           'category_list',
           'category_create',
           'category_edit',
           'category_delete',

           'slider_list',
           'slider_create',
           'slider_edit',
           'slider_delete',

           'user_list',
           'user_create',
           'user_edit',
           'user_delete',

           'role_list',
           'role_create',
           'role_edit',
           'role_delete',


        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }

    }
}
