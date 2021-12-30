<?php

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
                'title' => 'slider_create',
            ],
            [
                'id'    => 18,
                'title' => 'slider_edit',
            ],
            [
                'id'    => 19,
                'title' => 'slider_show',
            ],
            [
                'id'    => 20,
                'title' => 'slider_delete',
            ],
            [
                'id'    => 21,
                'title' => 'slider_access',
            ],
            [
                'id'    => 22,
                'title' => 'about_us_create',
            ],
            [
                'id'    => 23,
                'title' => 'about_us_edit',
            ],
            [
                'id'    => 24,
                'title' => 'about_us_show',
            ],
            [
                'id'    => 25,
                'title' => 'about_us_delete',
            ],
            [
                'id'    => 26,
                'title' => 'about_us_access',
            ],
            [
                'id'    => 27,
                'title' => 'medical_opinion_create',
            ],
            [
                'id'    => 28,
                'title' => 'medical_opinion_edit',
            ],
            [
                'id'    => 29,
                'title' => 'medical_opinion_show',
            ],
            [
                'id'    => 30,
                'title' => 'medical_opinion_delete',
            ],
            [
                'id'    => 31,
                'title' => 'medical_opinion_access',
            ],
            [
                'id'    => 32,
                'title' => 'champion_create',
            ],
            [
                'id'    => 33,
                'title' => 'champion_edit',
            ],
            [
                'id'    => 34,
                'title' => 'champion_show',
            ],
            [
                'id'    => 35,
                'title' => 'champion_delete',
            ],
            [
                'id'    => 36,
                'title' => 'champion_access',
            ],
            [
                'id'    => 37,
                'title' => 'setting_access',
            ],
            [
                'id'    => 38,
                'title' => 'language_create',
            ],
            [
                'id'    => 39,
                'title' => 'language_edit',
            ],
            [
                'id'    => 40,
                'title' => 'language_show',
            ],
            [
                'id'    => 41,
                'title' => 'language_delete',
            ],
            [
                'id'    => 42,
                'title' => 'language_access',
            ],
            [
                'id'    => 43,
                'title' => 'special_tool_create',
            ],
            [
                'id'    => 44,
                'title' => 'special_tool_edit',
            ],
            [
                'id'    => 45,
                'title' => 'special_tool_show',
            ],
            [
                'id'    => 46,
                'title' => 'special_tool_delete',
            ],
            [
                'id'    => 47,
                'title' => 'special_tool_access',
            ],
            [
                'id'    => 48,
                'title' => 'contactu_delete',
            ],
            [
                'id'    => 49,
                'title' => 'contactu_access',
            ],
            [
                'id'    => 50,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 51,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 52,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 53,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 54,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 55,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 56,
                'title' => 'practical_solution_create',
            ],
            [
                'id'    => 57,
                'title' => 'practical_solution_edit',
            ],
            [
                'id'    => 58,
                'title' => 'practical_solution_show',
            ],
            [
                'id'    => 59,
                'title' => 'practical_solution_delete',
            ],
            [
                'id'    => 60,
                'title' => 'practical_solution_access',
            ],
            [
                'id'    => 61,
                'title' => 'staff_create',
            ],
            [
                'id'    => 62,
                'title' => 'staff_edit',
            ],
            [
                'id'    => 63,
                'title' => 'staff_show',
            ],
            [
                'id'    => 64,
                'title' => 'staff_delete',
            ],
            [
                'id'    => 65,
                'title' => 'staff_access',
            ],
            [
                'id'    => 66,
                'title' => 'problem_create',
            ],
            [
                'id'    => 67,
                'title' => 'problem_edit',
            ],
            [
                'id'    => 68,
                'title' => 'problem_show',
            ],
            [
                'id'    => 69,
                'title' => 'problem_delete',
            ],
            [
                'id'    => 70,
                'title' => 'problem_access',
            ],
            [
                'id'    => 71,
                'title' => 'public_subject_create',
            ],
            [
                'id'    => 72,
                'title' => 'public_subject_edit',
            ],
            [
                'id'    => 73,
                'title' => 'public_subject_show',
            ],
            [
                'id'    => 74,
                'title' => 'public_subject_delete',
            ],
            [
                'id'    => 75,
                'title' => 'public_subject_access',
            ],
            [
                'id'    => 76,
                'title' => 'comment_create',
            ],
            [
                'id'    => 77,
                'title' => 'comment_edit',
            ],
            [
                'id'    => 78,
                'title' => 'comment_show',
            ],
            [
                'id'    => 79,
                'title' => 'comment_delete',
            ],
            [
                'id'    => 80,
                'title' => 'comment_access',
            ],
            [
                'id'    => 81,
                'title' => 'general_discussion_access',
            ],
            [
                'id'    => 82,
                'title' => 'subjects_category_create',
            ],
            [
                'id'    => 83,
                'title' => 'subjects_category_edit',
            ],
            [
                'id'    => 84,
                'title' => 'subjects_category_show',
            ],
            [
                'id'    => 85,
                'title' => 'subjects_category_delete',
            ],
            [
                'id'    => 86,
                'title' => 'subjects_category_access',
            ],
            [
                'id'    => 87,
                'title' => 'videos_participate_create',
            ],
            [
                'id'    => 88,
                'title' => 'videos_participate_edit',
            ],
            [
                'id'    => 89,
                'title' => 'videos_participate_show',
            ],
            [
                'id'    => 90,
                'title' => 'videos_participate_delete',
            ],
            [
                'id'    => 91,
                'title' => 'videos_participate_access',
            ],
            [
                'id'    => 92,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
