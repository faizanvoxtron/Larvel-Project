<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Permission};
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        // LATEST ID = 72 Start with ID+1

        Permission::create([
            'id' => 1,
            'parent_id' => null,
            'name' => 'Access Control',
            'slug' => \Str::slug('Access Control'),
        ]);

        Permission::create([
            'id' => 2,
            'parent_id' => 1,
            'name' => 'Admin Roles',
            'slug' => \Str::slug('Admin Roles'),
            'description' => "Access User permissions and roles"
        ]);

        Permission::create([
            'id' => 3,
            'parent_id' => 1,
            'name' => 'Manage Role Permissions',
            'slug' => \Str::slug('Manage Role Permissions'),
            'description' => "Can Allow or revoke access for roles"
        ]);

        Permission::create([
            'id' => 4,
            'parent_id' => 1,
            'name' => 'View all users',
            'slug' => \Str::slug('View all users'),
            'description' => "Can view all users including admins and agents"
        ]);

        Permission::create([
            'id' => 5,
            'parent_id' => 1,
            'name' => 'View RnD Agents',
            'slug' => \Str::slug('View RnD Agents'),
            'description' => "Can only view RnD Agents"
        ]);

        Permission::create([
            'id' => 46,
            'parent_id' => 1,
            'name' => 'View Agents',
            'slug' => \Str::slug('View Agents'),
            'description' => "Can only view Agents"
        ]);


        Permission::create([
            'id' => 63,
            'parent_id' => 1,
            'name' => 'View Closers',
            'slug' => \Str::slug('View Closers'),
            'description' => "Can only view Closers"
        ]);
        Permission::create([
            'id' => 64,
            'parent_id' => 1,
            'name' => 'View Team Leads',
            'slug' => \Str::slug('View Team Leads'),
            'description' => "Can only view Team Leads"
        ]);


        Permission::create([
            'id' => 65,
            'parent_id' => 1,
            'name' => 'View RNA Specialist',
            'slug' => \Str::slug('View RNA Specialist'),
            'description' => "Can only view RNA Specialist"
        ]);

        Permission::create([
            'id' => 66,
            'parent_id' => 1,
            'name' => 'View Chg Bck Specialist',
            'slug' => \Str::slug('View Chg Bck Specialist'),
            'description' => "Can only view Chg Bck Specialist"
        ]);

        Permission::create([
            'id' => 67,
            'parent_id' => 1,
            'name' => 'View Decline Specialist',
            'slug' => \Str::slug('View Decline Specialist'),
            'description' => "Can only view Decline Specialist"
        ]);





        Permission::create([
            'id' => 6,
            'parent_id' => 1,
            'name' => 'Access Whitelisted IPs',
            'slug' => \Str::slug('Access Whitelisted IPs'),
            // 'description' => "ssssssssssssss"
        ]);

        Permission::create([
            'id' => 7,
            'parent_id' => 1,
            'name' => 'Bypass Whitelisting',
            'slug' => \Str::slug('Bypass Whitelisting'),
            'description' => "Can access from any network and any device"
        ]);

        Permission::create([
            'id' => 47,
            'parent_id' => 1,
            'name' => 'View User Reports',
            'slug' => \Str::slug('View User Reports'),
            // 'description' => "Can only view Agents"
        ]);














        Permission::create([
            'id' => 8,
            'parent_id' => null,
            'name' => 'Customer Management',
            'slug' => \Str::slug('Customer Management'),
        ]);


        Permission::create([
            'id' => 9,
            'parent_id' => 8,
            'name' => 'Access Customers',
            'slug' => \Str::slug('Access Customers'),
            // 'description' => "ssssssssssssss"
        ]);
        Permission::create([
            'id' => 10,
            'parent_id' => 8,
            'name' => 'View Customer',
            'slug' => \Str::slug('View Customer'),
            'description' => "Can view customers profile"
        ]);

        Permission::create([
            'id' => 11,
            'parent_id' => 8,
            'name' => 'Add Customer',
            'slug' => \Str::slug('Add Customer'),
            // 'description' => "Can add customers"
        ]);

        Permission::create([
            'id' => 12,
            'parent_id' => 8,
            'name' => 'Bulk Add Customer',
            'slug' => \Str::slug('Bulk Add Customer'),
            'description' => "Can upload customers sheet"
        ]);

        Permission::create([
            'id' => 13,
            'parent_id' => 8,
            'name' => 'Edit Customer',
            'slug' => \Str::slug('Edit Customer'),
            // 'description' => "Can edit customers"
        ]);


        Permission::create([
            'id' => 14,
            'parent_id' => 8,
            'name' => 'Bulk Download Customer',
            'slug' => \Str::slug('Download Customer'),
            'description' => "Can create a customer exportable file which can later be exported to personal device."
        ]);


        Permission::create([
            'id' => 69,
            'parent_id' => 8,
            'name' => 'Export Customers as RCL',
            'slug' => \Str::slug('Export Customers as RCL'),
            'description' => "Can export customers to use as RC Leads."
        ]);

        Permission::create([
            'id' => 62,
            'parent_id' => 8,
            'name' => 'Download Single Customer In TXT',
            'slug' => \Str::slug('Download Single Customer In TXT'),
            'description' => "Can download a single customer in Txt FIle."
        ]);

        Permission::create([
            'id' => 48,
            'parent_id' => 8,
            'name' => 'Export Customer',
            'slug' => \Str::slug('Export Customer'),
            'description' => "Can export customers to personal device."
        ]);


        Permission::create([
            'id' => 15,
            'parent_id' => 8,
            'name' => 'View Customer Logs',
            'slug' => \Str::slug('View Customer Logs'),
            // 'description' => "Can view customer logs"
        ]);

        Permission::create([
            'id' => 16,
            'parent_id' => 8,
            'name' => 'Access Completed Customers',
            'slug' => \Str::slug('Access Completed Customers'),
            // 'description' => "Can access completed customers"
        ]);


        Permission::create([
            'id' => 17,
            'parent_id' => 8,
            'name' => 'Access Re-work Customers',
            'slug' => \Str::slug('Access Re-work Customers'),
            // 'description' => "ssssssssssssss"
        ]);
        Permission::create([
            'id' => 18,
            'parent_id' => 8,
            'name' => 'Move Customers To Re-work',
            'slug' => \Str::slug('Move Customers To Re-work'),
            // 'description' => "ssssssssssssss"
        ]);

        Permission::create([
            'id' => 45,
            'parent_id' => 8,
            'name' => 'View Same MID Customers',
            'slug' => \Str::slug('View Same MID Customers'),
            'description' => "Can only view customers that have matching MID to this User (Suitable For FE Role)."
        ]);

        Permission::create([
            'id' => 50,
            'parent_id' => 8,
            'name' => 'Hold After Leadcenter Import',
            'slug' => \Str::slug('Hold After Leadcenter Import'),
            'description' => "Will disable import from leadcenter button for 8 minutes after every click."
        ]);

        Permission::create([
            'id' => 55,
            'parent_id' => 8,
            'name' => 'Access Approved Customers',
            'slug' => \Str::slug('Access Approved Customers'),
            // 'description' => "Will disable import from leadcenter button for 8 minutes after every click."
        ]);


        Permission::create([
            'id' => 57,
            'parent_id' => 8,
            'name' => 'Access Customers Reapproval',
            'slug' => \Str::slug('Access Customers Reapproval'),
            'description' => "Suitable for specialists role."
        ]);

        Permission::create([
            'id' => 58,
            'parent_id' => 8,
            'name' => 'Assign Customers to Specialists',
            'slug' => \Str::slug('Assign Customers to Specialists'),
            'description' => "Assign Customers to RNA, CB, Decline Specialists for Customers' Re-approval."
        ]);

        Permission::create([
            'id' => 61,
            'parent_id' => 8,
            'name' => 'Access Customer Recordings',
            'slug' => \Str::slug('Access Customer Recordings'),
            // 'description' => "Assign Customers to RNA, CB, Decline Specialists for Customers' Re-approval."
        ]);

        Permission::create([
            'id' => 68,
            'parent_id' => 8,
            'name' => 'Bulk Assign Customer To Agent',
            'slug' => \Str::slug('Bulk Assign Customer To Agent'),
            // 'description' => "Assign Customers to RNA, CB, Decline Specialists for Customers' Re-approval."
        ]);




        Permission::create([
            'id' => 19,
            'parent_id' => null,
            'name' => 'Report Management',
            'slug' => \Str::slug('Report Management'),
        ]);

        Permission::create([
            'id' => 20,
            'parent_id' => 19,
            'name' => 'Fetch Report',
            'slug' => \Str::slug('Fetch Report'),
            // 'description' => "Can Fetch Report"
        ]);

        Permission::create([
            'id' => 60,
            'parent_id' => 19,
            'name' => 'View Reports',
            'slug' => \Str::slug('View Reports'),
            // 'description' => "Can Fetch Report"
        ]);















        Permission::create([
            'id' => 21,
            'parent_id' => null,
            'name' => 'Report Request Management',
            'slug' => \Str::slug('Report Request Management'),
        ]);



        Permission::create([
            'id' => 22,
            'parent_id' => 21,
            'name' => 'Access Report Request',
            'slug' => \Str::slug('Access Report Request'),
            'description' => "Can Access report requests module"
        ]);

        Permission::create([
            'id' => 23,
            'parent_id' => 21,
            'name' => 'Add Report Request',
            'slug' => \Str::slug('Add Report Request'),
            // 'description' => "Can create a report request"
        ]);

        Permission::create([
            'id' => 24,
            'parent_id' => 21,
            'name' => 'Edit Report Request',
            'slug' => \Str::slug('Edit Report Request'),
            // 'description' => "Can edit a report request"
        ]);

        Permission::create([
            'id' => 25,
            'parent_id' => 21,
            'name' => 'Attach Report to Report Request',
            'slug' => \Str::slug('Attach Report to Report Request'),
            'description' => "Can attach a report to request"
        ]);

        Permission::create([
            'id' => 26,
            'parent_id' => 21,
            'name' => 'View ALL Report Requests',
            'slug' => \Str::slug('View ALL Report Requests'),
            'description' => "Can view all report requests (Superadmin)"
        ]);



        Permission::create([
            'id' => 27,
            'parent_id' => 21,
            'name' => 'View Tagged in Report Requests',
            'slug' => \Str::slug('View Tagged in Report Requests'),
            'description' => "Can only view requests which are requested from them (Manager)"
        ]);

        Permission::create([
            'id' => 28,
            'parent_id' => 21,
            'name' => 'View Requested Report Requests',
            'slug' => \Str::slug('View Requested Report Requests'),
            'description' => "Can only view requests created by them (Agents)"
        ]);





















        Permission::create([
            'id' => 29,
            'parent_id' => null,
            'name' => 'Leadcenter Management',
            'slug' => \Str::slug('Leadcenter Management'),
        ]);


        Permission::create([
            'id' => 30,
            'parent_id' => 29,
            'name' => 'Access Leadcenter',
            'slug' => \Str::slug('Access Leadcenter'),
            // 'description' => "ssssssssssssss"
        ]);

        Permission::create([
            'id' => 31,
            'parent_id' => 29,
            'name' => 'Upload Leadcenter leads',
            'slug' => \Str::slug('Upload Leadcenter leads'),
            'description' => "Can upload leads file"
        ]);

        Permission::create([
            'id' => 32,
            'parent_id' => 29,
            'name' => 'Move Leadcenter leads to RnD',
            'slug' => \Str::slug('Move Leadcenter leads to RnD'),
            // 'description' => "ssssssssssssss"
        ]);

        Permission::create([
            'id' => 33,
            'parent_id' => 29,
            'name' => 'Unassign Leadcenter leads to RnD',
            'slug' => \Str::slug('Unassign Leadcenter leads to RnD'),
            // 'description' => "ssssssssssssss"
        ]);

        Permission::create([
            'id' => 34,
            'parent_id' => 29,
            'name' => 'Assign Leadcenter leads to Agents',
            'slug' => \Str::slug('Assign Leadcenter leads to Agents'),
            // 'description' => "ssssssssssssss"
        ]);

        Permission::create([
            'id' => 54,
            'parent_id' => 29,
            'name' => 'Assign Leadcenter leads to Office',
            'slug' => \Str::slug('Assign Leadcenter leads to Office'),
            // 'description' => "ssssssssssssss"
        ]);

        Permission::create([
            'id' => 35,
            'parent_id' => 29,
            'name' => 'Unassign Leadcenter leads to Agents',
            'slug' => \Str::slug('Unassign Leadcenter leads to Agents'),
            // 'description' => "ssssssssssssss"
        ]);

        Permission::create([
            'id' => 36,
            'parent_id' => 29,
            'name' => 'Complete Leadcenter leads',
            'slug' => \Str::slug('Complete Leadcenter leads'),
            // 'description' => "ssssssssssssss"
        ]);
        
        Permission::create([
            'id' => 71,
            'parent_id' => 29,
            'name' => 'Incomplete Leadcenter leads',
            'slug' => \Str::slug('Incomplete Leadcenter leads'),
            // 'description' => "ssssssssssssss"
        ]);

        Permission::create([
            'id' => 37,
            'parent_id' => 29,
            'name' => 'Delete Leadcenter leads',
            'slug' => \Str::slug('Delete Leadcenter leads'),
            // 'description' => "ssssssssssssss"
        ]);

        Permission::create([
            'id' => 38,
            'parent_id' => 29,
            'name' => 'Fill Details in Leadcenter leads',
            'slug' => \Str::slug('Fill Details in Leadcenter leads'),
            // 'description' => "ssssssssssssss"
        ]);

        Permission::create([
            'id' => 39,
            'parent_id' => 29,
            'name' => 'View only RnD leads',
            'slug' => \Str::slug('View only RnD leads'),
            'description' => "For RnD admin to only view leads that are in RnD."
        ]);

        Permission::create([
            'id' => 40,
            'parent_id' => 29,
            'name' => 'Assign Leadcenter leads to RnD Agents',
            'slug' => \Str::slug('Assign Leadcenter leads to RnD Agents'),
            'description' => "For RnD admin to further divide leads among RnD Agents"
        ]);
        Permission::create([
            'id' => 41,
            'parent_id' => 29,
            'name' => 'Download Leadcenter leads',
            'slug' => \Str::slug('Download Leadcenter leads'),
            // 'description' => "Can access from any network and any device"
        ]);

        Permission::create([
            'id' => 70,
            'parent_id' => 29,
            'name' => 'Upload RC leads',
            'slug' => \Str::slug('Upload RC leads'),
            // 'description' => "Can access from any network and any device"
        ]);








        Permission::create([
            'id' => 42,
            'name' => 'Access Dashboard',
            'slug' => \Str::slug('Access Dashboard'),
            // 'description' => "ssssssssssssss"
        ]);



        Permission::create([
            'id' => 43,
            'name' => 'Manage Offices',
            'slug' => \Str::slug('Manage Offices'),
            // 'description' => "Can Manage OFfices after it is completed."
        ]);



        Permission::create([
            'id' => 44,
            'name' => 'M Ids Management',
            'slug' => \Str::slug('M Ids Management'),
            // 'description' => "For RnD admin to further divide leads among RnD Agents"
        ]);

        Permission::create([
            'id' => 49,
            'name' => 'View Phone Validation Logs',
            'slug' => \Str::slug('View Phone Validation Logs'),
            // 'description' => "For RnD admin to further divide leads among RnD Agents"
        ]);


        Permission::create([
            'id' => 51,
            'name' => 'View Daily Call Logs',
            'slug' => \Str::slug('View Daily Call Logs'),
            // 'description' => "For RnD admin to further divide leads among RnD Agents"
        ]);

        Permission::create([
            'id' => 52,
            'name' => 'Scripts Management',
            'slug' => \Str::slug('Scripts Management'),
            // 'description' => "For RnD admin to further divide leads among RnD Agents"
        ]);

        Permission::create([
            'id' => 53,
            'name' => 'Personnel Management',
            'slug' => \Str::slug('Personnel Management'),
            // 'description' => "For RnD admin to further divide leads among RnD Agents"
        ]);

        Permission::create([
            'id' => 56,
            'name' => 'View Customer Phone Modification Logs',
            'slug' => \Str::slug('View Customer Phone Modification Logs'),
            // 'description' => "For RnD admin to further divide leads among RnD Agents"
        ]);





        // Permission::create([
        //     'id' => 1,
        //     'parent_id' => null,
        //     'name' => 'Admin Roles',
        //     'slug' => \Str::slug('Admin Roles'),
        // ]);
        //     Permission::create([
        //         'id' => 2,
        //         'parent_id' => 1,
        //         'name' => 'Add',
        //         'slug' => \Str::slug('Admin Roles')."-add",
        //     ]);
        //     Permission::create([
        //         'id' => 3,
        //         'parent_id' => 1,
        //         'name' => 'View',
        //         'slug' => \Str::slug('Admin Roles')."-view",
        //     ]);
        //     Permission::create([
        //         'id' => 4,
        //         'parent_id' => 1,
        //         'name' => 'Update',
        //         'slug' => \Str::slug('Admin Roles')."-update",
        //     ]);
    }
}
