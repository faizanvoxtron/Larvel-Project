<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Temporarily disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $defaultRoles = [
            [
                'id' => User::SUPERADMIN_ROLE,
                'slug' => Str::slug('SuperAdmin'),
                'translation' => 'en',
                'name' => 'SuperAdmin',
                'is_system_default' => true
            ],
            [
                'id' => User::MANAGER_ROLE,
                'slug' => Str::slug('Manager'),
                'translation' => 'en',
                'name' => 'Manager',
                'is_system_default' => true
            ],
            [
                'id' => User::AGENT_ROLE,
                'slug' => Str::slug('Agent'),
                'translation' => 'en',
                'name' => 'Agent',
                'is_system_default' => true
            ],
            [
                'id' => User::RND_ROLE,
                'slug' => Str::slug('RnD'),
                'translation' => 'en',
                'name' => 'RnD',
                'is_system_default' => true
            ],
            [
                'id' => User::RND_ADMIN_ROLE,
                'slug' => Str::slug('RnD Admin'),
                'translation' => 'en',
                'name' => 'RnD Admin',
                'is_system_default' => true
            ],
            [
                'id' => User::FE_ROLE,
                'slug' => Str::slug('FE'),
                'translation' => 'en',
                'name' => 'FE',
                'is_system_default' => true
            ],
            [
                'id' => User::STAFF_ACCESS_CONTROL_ROLE,
                'slug' => Str::slug('Staff Access Control'),
                'translation' => 'en',
                'name' => 'Staff Access Control',
                'is_system_default' => true
            ],
            [
                'id' => User::CLOSER_ROLE,
                'slug' => Str::slug('Closer'),
                'translation' => 'en',
                'name' => 'Closer',
                'is_system_default' => true
            ],
            [
                'id' => User::TEAM_LEAD_ROLE,
                'slug' => Str::slug('Team Lead'),
                'translation' => 'en',
                'name' => 'Team Lead',
                'is_system_default' => true
            ],
            [
                'id' => User::RNA_SPECIALIST_ROLE,
                'slug' => Str::slug('RNA Specialist'),
                'translation' => 'en',
                'name' => 'RNA Specialist',
                'is_system_default' => true
            ],
            [
                'id' => User::CB_SPECIALIST_ROLE,
                'slug' => Str::slug('Chg Bck Specialist'),
                'translation' => 'en',
                'name' => 'Chg Bck Specialist',
                'is_system_default' => true
            ],
            [
                'id' => User::DECLINE_SPECIALIST_ROLE,
                'slug' => Str::slug('Decline Specialist'),
                'translation' => 'en',
                'name' => 'Decline Specialist',
                'is_system_default' => true
            ],
        ];

        foreach ($defaultRoles as $role) {
            Role::updateOrCreate(['id' => $role['id']], $role);
        }

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Ensure auto-increment starts from 101 if there are no roles with IDs >= 101
        $maxId = Role::max('id');
        if ($maxId < 101) {
            DB::statement('ALTER TABLE roles AUTO_INCREMENT = 101;');
        }
    }
}
