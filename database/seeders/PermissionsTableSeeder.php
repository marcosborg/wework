<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'company_create',
            ],
            [
                'id'    => 18,
                'title' => 'company_edit',
            ],
            [
                'id'    => 19,
                'title' => 'company_show',
            ],
            [
                'id'    => 20,
                'title' => 'company_delete',
            ],
            [
                'id'    => 21,
                'title' => 'company_access',
            ],
            [
                'id'    => 22,
                'title' => 'country_create',
            ],
            [
                'id'    => 23,
                'title' => 'country_edit',
            ],
            [
                'id'    => 24,
                'title' => 'country_show',
            ],
            [
                'id'    => 25,
                'title' => 'country_delete',
            ],
            [
                'id'    => 26,
                'title' => 'country_access',
            ],
            [
                'id'    => 27,
                'title' => 'state_create',
            ],
            [
                'id'    => 28,
                'title' => 'state_edit',
            ],
            [
                'id'    => 29,
                'title' => 'state_show',
            ],
            [
                'id'    => 30,
                'title' => 'state_delete',
            ],
            [
                'id'    => 31,
                'title' => 'state_access',
            ],
            [
                'id'    => 32,
                'title' => 'funnel_create',
            ],
            [
                'id'    => 33,
                'title' => 'funnel_edit',
            ],
            [
                'id'    => 34,
                'title' => 'funnel_show',
            ],
            [
                'id'    => 35,
                'title' => 'funnel_delete',
            ],
            [
                'id'    => 36,
                'title' => 'funnel_access',
            ],
            [
                'id'    => 37,
                'title' => 'step_create',
            ],
            [
                'id'    => 38,
                'title' => 'step_edit',
            ],
            [
                'id'    => 39,
                'title' => 'step_show',
            ],
            [
                'id'    => 40,
                'title' => 'step_delete',
            ],
            [
                'id'    => 41,
                'title' => 'step_access',
            ],
            [
                'id'    => 42,
                'title' => 'category_create',
            ],
            [
                'id'    => 43,
                'title' => 'category_edit',
            ],
            [
                'id'    => 44,
                'title' => 'category_show',
            ],
            [
                'id'    => 45,
                'title' => 'category_delete',
            ],
            [
                'id'    => 46,
                'title' => 'category_access',
            ],
            [
                'id'    => 47,
                'title' => 'management_access',
            ],
            [
                'id'    => 48,
                'title' => 'client_create',
            ],
            [
                'id'    => 49,
                'title' => 'client_edit',
            ],
            [
                'id'    => 50,
                'title' => 'client_show',
            ],
            [
                'id'    => 51,
                'title' => 'client_delete',
            ],
            [
                'id'    => 52,
                'title' => 'client_access',
            ],
            [
                'id'    => 53,
                'title' => 'item_create',
            ],
            [
                'id'    => 54,
                'title' => 'item_edit',
            ],
            [
                'id'    => 55,
                'title' => 'item_show',
            ],
            [
                'id'    => 56,
                'title' => 'item_delete',
            ],
            [
                'id'    => 57,
                'title' => 'item_access',
            ],
            [
                'id'    => 58,
                'title' => 'input_create',
            ],
            [
                'id'    => 59,
                'title' => 'input_edit',
            ],
            [
                'id'    => 60,
                'title' => 'input_show',
            ],
            [
                'id'    => 61,
                'title' => 'input_delete',
            ],
            [
                'id'    => 62,
                'title' => 'input_access',
            ],
            [
                'id'    => 63,
                'title' => 'project_create',
            ],
            [
                'id'    => 64,
                'title' => 'project_edit',
            ],
            [
                'id'    => 65,
                'title' => 'project_show',
            ],
            [
                'id'    => 66,
                'title' => 'project_delete',
            ],
            [
                'id'    => 67,
                'title' => 'project_access',
            ],
            [
                'id'    => 68,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
