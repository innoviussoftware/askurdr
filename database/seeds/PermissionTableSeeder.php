<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('permissions')->insert(
                ['name' => 'home', 'display_name' => 'Home','parent_id'=>0]
        );
        DB::table('permissions')->insert(
                ['name' => 'sitemap', 'display_name' => 'Sitemap','parent_id'=>1]
        );
        DB::table('permissions')->insert(
                ['name' => 'edit_profile', 'display_name' => 'Edit Profile','parent_id'=>1]
        );
        DB::table('permissions')->insert(
                ['name' => 'change_password', 'display_name' => 'Change Password','parent_id'=>1]
        );
        DB::table('permissions')->insert(
                ['name' => 'dashboard', 'display_name' => 'Dashboard','parent_id'=>1]
        );
        DB::table('permissions')->insert(
                ['name' => 'user_management', 'display_name' => 'User Management','parent_id'=>0]
        );
        DB::table('permissions')->insert(
                ['name' => 'admin', 'display_name' => 'Admin','parent_id'=>6]
        );
        DB::table('permissions')->insert(
                ['name' => 'roles_permissions', 'display_name' => 'Roles & Permissions','parent_id'=>6]
        );
        DB::table('permissions')->insert(
                ['name' => 'customer', 'display_name' => 'Customer','parent_id'=>6]
        );
        DB::table('permissions')->insert(
                ['name' => 'vendor', 'display_name' => 'Vendor','parent_id'=>6]
        );
        DB::table('permissions')->insert(
                ['name' => 'review_ratings', 'display_name' => 'Reviews & Ratings','parent_id'=>6]
        );
        DB::table('permissions')->insert(
                ['name' => 'master', 'display_name' => 'Master','parent_id'=>0]
        );
        DB::table('permissions')->insert(
                ['name' => 'category', 'display_name' => 'Category','parent_id'=>12]
        );
        DB::table('permissions')->insert(
                ['name' => 'sub_category', 'display_name' => 'Sub Category','parent_id'=>12]
        );
        DB::table('permissions')->insert(
                ['name' => 'state', 'display_name' => 'State','parent_id'=>12]
        );
        DB::table('permissions')->insert(
                ['name' => 'city', 'display_name' => 'City','parent_id'=>12]
        );
        DB::table('permissions')->insert(
                ['name' => 'job_service_request', 'display_name' => 'Jobs/Service Request','parent_id'=>0]
        );
        DB::table('permissions')->insert(
        		['name'=>'open_jobs','display_name'=>'Open Jobs','parent_id'=>17]
        );
        DB::table('permissions')->insert(
        		['name'=>'completed_jobs','display_name'=>'Completed Jobs','parent_id'=>17]
        );
        DB::table('permissions')->insert(
        		['name'=>'dispute_jobs','display_name'=>'Dispute Jobs','parent_id'=>17]
        );
        DB::table('permissions')->insert(
        		['name'=>'reports','display_name'=>'Reports','parent_id'=>0]
        );
        DB::table('permissions')->insert(
        		['name'=>'conversion_report','display_name'=>'Conversion Report','parent_id'=>21]
        );
        DB::table('permissions')->insert(
        		['name'=>'rating_report','display_name'=>'Rating Report','parent_id'=>21]
        );
        DB::table('permissions')->insert(
        		['name'=>'contact_us','display_name'=>'Contact Us','parent_id'=>21]
        );
        DB::table('permissions')->insert(
        		['name'=>'settings','display_name'=>'Settings','parent_id'=>0]
        );
        DB::table('permissions')->insert(
        		['name'=>'master_settings','display_name'=>'Master Settings','parent_id'=>25]
        );
        DB::table('permissions')->insert(
        		['name'=>'company','display_name'=>'Company','parent_id'=>25]
        );
        DB::table('permissions')->insert(
        		['name'=>'email','display_name'=>'Email','parent_id'=>25]
        );
        DB::table('permissions')->insert(
        		['name'=>'sms','display_name'=>'SMS','parent_id'=>25]
        );
        DB::table('permissions')->insert(
        		['name'=>'social_media','display_name'=>'Social Media','parent_id'=>25]
        );
        DB::table('permissions')->insert(
        		['name'=>'static_page','display_name'=>'Static Pages','parent_id'=>25]
        );
        DB::table('permissions')->insert(
        		['name'=>'email_notification_broadcast_message','display_name'=>'Email, Notification & Broadcast message','parent_id'=>0]
        );
        DB::table('permissions')->insert(
        		['name'=>'email_templates','display_name'=>'Email Temmplates','parent_id'=>32]
        );
        DB::table('permissions')->insert(
        		['name'=>'notification_template','display_name'=>'Notification Templates','parent_id'=>32]
        );
        DB::table('permissions')->insert(
        		['name'=>'broadcast_message','display_name'=>'Broadcast Message','parent_id'=>32]
        );


    }
}
