<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\{ManagePasswordController, DetailsController, UserController};
use App\Http\Controllers\Auth\{AuthenticatedSessionController};
use App\Http\Controllers\Admin\{
    FaqController,
    TopicsController,
    SettingsController,
    SiteContentController,
    InfoModalController,
    CityController,
    SubTopicController,
    DiseaseController,
    WidgetController,
    ArticleController,
    TagsController,
    SpecialityController,
    ServiceController,
    LanguageController,
    MenuController,
    ContentTestController,
    PageController,
    SubscriptionManagementController,
    RightsController,
    AdminController,
    DoctorManagementController,
    FaqCategoryController,
    AdController,
    FooterMenuController,
    ArticleBadgeController,
    HealthScanController,
    AppointmentController,
    ApprovedCustomers,
    ArticleFactController,
    ChatController,
    DrugController,
    QuestionaireController,
    CustomerController,
    CustomerExportsController,
    CustomerLogsController,
    ReportRequestController,
    ReportsController,
    CustomerNotesController,
    CustomerPhoneModificationLogsController,
    LeadcenterController,
    MIdsController,
    NotificationController,
    OfficesController,
    PersonnelController,
    PhoneValidationLogsController,
    WhitelistedIpsController,
    ScriptsController
};
use App\Http\Controllers\Artist\{
    ArtworkController
};
use App\Http\Controllers\{
    ExternalCallLogsController,
    NewsletterController,
    SendMessages
};
use App\Http\Controllers\TestMailController;
use App\Http\Common\Queue;
use Illuminate\Http\Request;



Route::get('/validate/number/{number}', [App\Http\Controllers\Admin\AdminController::class, 'validatePhoneNumber'])->name('validate_number');
Route::get('/assign_agent_regarding_logs', [App\Http\Controllers\Admin\AdminController::class, 'assignLeadsToCustomer'])->name('assign_agent_regarding_logs');

Route::get('get-ip', function (Request $request) {
    return $request->ip();
});

Route::get('get-ini', function (Request $request) {
    phpinfo();
});


Route::middleware(['auth', 'whitelistIps'])->prefix('admin')->group(function () {

    Route::get('home', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.home');

    Route::get('notifications/ajax/{offset?}', [App\Http\Controllers\Admin\NotificationController::class, 'notificationsAjax'])->name('admin.notifications_ajax');
    Route::get('notifications/{limit?}/{offset?}', [App\Http\Controllers\Admin\NotificationController::class, 'notifications'])->name('admin.notifications');

    Route::post('notifications/read', [App\Http\Controllers\Admin\NotificationController::class, 'readNotifications'])->name('admin.read_notifications');

    Route::post('toggle-status/{id}/{val}/{table}', function () {
        return "Code to toggle status";
        // DB::table()->where('id',$id);
    })->name('toggle_status');
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy_get']);
    Route::get('/', function () {
        return redirect()->route('admin.home');
    });



    //--------- Right Management -----------------------------//
    Route::get('/roles-and-permission/roles', [RightsController::class, 'show_roles'])->name('roles.show');
    Route::get('/roles-and-permission/roles/add', [RightsController::class, 'add_role'])->name('role.add');
    Route::post('/roles-and-permission/roles/add', [RightsController::class, 'create_role'])->name('role.create');
    Route::get('/roles-and-permission/roles/edit/{role}', [RightsController::class, 'edit_role'])->name('roles.edit');
    Route::post('/roles-and-permission/roles/update/{role}', [RightsController::class, 'update_role'])->name('role.update');


    //  password management
    Route::get('manage-password', [ManagePasswordController::class, 'show_update'])->name('manage-password');
    Route::post('manage-password', [ManagePasswordController::class, 'update'])->name('manage-password');
    // user management
    Route::get('user/view', [DetailsController::class, 'show_all']);
    Route::get('user/edit', [DetailsController::class, 'edit_profile'])->name('updateProfile');
    Route::post('user/edit', [DetailsController::class, 'edit_profile'])->name('updateProfile');
    Route::get('user/{id}/profile', [DetailsController::class, 'show']);

    Route::get('users', [UserController::class, 'view'])->name('user_management-view');
    Route::get('user/fetch', [UserController::class, 'fetch'])->name('user_management-fetch');

    // settings managements
    Route::get('settings/list', [SettingsController::class, 'index'])->name('settings');
    Route::post('settings/list', [SettingsController::class, 'update'])->name('settings');

    // // CHAT

    // THIRD PARTY CHAT
    // Route::get('chat', [ChatController::class, 'redirect'])->name('tp-chat');
    
    // //send message 
    // Route::get('chat/search', [SendMessages::class, 'search'])->name('chat.search');
    // Route::post("/send", [SendMessages::class, 'sendMessage'])->name('send');

    // //show room  
    // Route::get("/get-chat/{id}", [SendMessages::class, 'getChat'])->name('get-chat');
    // Route::get('chat', [SendMessages::class, 'chat'])->name('chat');
    // Route::get('list/{id}', [SendMessages::class, 'list'])->name('list');
    // Route::get('/all-chat-list', [SendMessages::class, 'allChatList'])->name('all.list');
    // Route::get('list/', [SendMessages::class, 'adminMyList'])->name('admin.mylist');
    // Route::get('/all-group-chat/{user_1}/{user_2}', [SendMessages::class, 'getAllChatMessages'])->name('all.messages');

    // //read_messages 
    // Route::post("/read_all", [SendMessages::class, 'read_all_messages']);
    // Route::get('new-chat-users', [SendMessages::class, 'getUsers'])->name('get-users-for-new-chat');
    // Route::get('new-chat/{id}', [SendMessages::class, 'newChat'])->name('new-chat');
    // Route::get('new-message/{id}', [SendMessages::class, 'newMessage'])->name('new-message');


    // EMPLOYEE
    Route::get('admin-users', [AdminController::class, 'view'])->name('admin_users-view');
    Route::get('admin-user/fetch', [AdminController::class, 'fetch'])->name('admin_users-fetch');

    Route::get('admin-user/add', [AdminController::class, 'add'])->name('admin_users-add');
    Route::post('admin-user/add', [AdminController::class, 'add'])->name('admin_users-add');

    Route::get('admin-user/edit/{id}', [AdminController::class, 'edit'])->name('admin_users-edit');
    Route::post('admin-user/edit/{id}', [AdminController::class, 'edit'])->name('admin_users-edit');

    Route::get('admin-user/reports/{id}', [AdminController::class, 'reports'])->name('admin_users-reports');

    Route::post('admin-user/upload', [AdminController::class, 'upload'])->name('admin_users-upload');


    Route::post('fcm_token/save', [AdminController::class, 'saveFcmToken'])->name('save_fcm_token');

    Route::get('notification/test', [NotificationController::class, 'test'])->name('test_notification');
    Route::get('notification/redirect/{module}/{supporting_id}', [NotificationController::class, 'redirect'])->name('redirect_notification');

    Route::get('admin-user/force-logout/{id?}', [AdminController::class, 'Forcelogout'])->name('admin_users-force_logout');



    // ARTOWRK MANAGEMENT
    Route::prefix('artwork')->controller(ArtworkController::class)->name('artwork-')->group(function () {
        include('general_routes.php');
    });

    // CUSTOMER management
    Route::prefix('customer')->controller(CustomerController::class)->name('customer-')->group(function () {
        Route::get('profile/{customer_id}', 'profile')->name('profile');
        Route::post('metadata', 'metadata')->name('metadata');
        Route::post('upload', 'upload')->name('upload');
        Route::post('complete', 'complete')->name('complete');
        Route::get('incomplete/{customer_id}', 'incomplete')->name('in_complete');
        Route::get('completed', 'completed')->name('completed');
        Route::get('fetch-completed', 'fetchCompleted')->name('fetch_completed');
        Route::get('download/{customer_id}', 'download')->name('download');
        Route::get('get-lead', 'getLead')->name('get_lead');


        Route::post('mark-phone-as-primary', 'markPhoneAsPrimary')->name('mark_phone_as_primary');


        Route::post('assign-agent', 'assignCustomerToAgent')->name('assign_customer_to_agent');


        Route::post('move-to-rework', 'moveToRework')->name('move_to_rework');
        Route::get('re-work', 'inRework')->name('in_rework');
        Route::get('fetch-re-work', 'fetchInRework')->name('fetch_in_rework');


        Route::post('download-in-csv', 'downloadInCsv')->name('download_in_csv');
        Route::post('download-in-txt-zip', 'downloadInTxtZip')->name('download_in_txt_zip');

        Route::post('export-as-rcl', 'exportAsRcl')->name('export_as_rcl');

        Route::get('play/{foldername}/{filename}', 'play')->name('play_recording');



        include('general_routes.php');
    });

    Route::prefix('customer-logs')->controller(CustomerLogsController::class)->name('customer_logs-')->group(function () {

        Route::get('list/{customer_id}', 'getLogs')->name('get_logs');

        Route::post('add', 'createLog')->name('create_log');
    });

    // CUSTOMER APPROVED management
    Route::prefix('approved-customer')->controller(ApprovedCustomers::class)->name('approved_customer-')->group(function () {
        Route::get('view', 'view')->name('view');
        Route::get('fetch', 'fetch')->name('fetch');
        Route::post('edit/{id}', 'edit')->name('edit');
        Route::post('account/edit/{id}', 'editAccount')->name('edit_account');

        Route::post('change-bulk-status', 'changeBulkStatus')->name('change_bulk_status');

        Route::get('get/specialist/{type}', 'getSpecialist')->name('get_specialist');
        Route::post('assign/specialist', 'assignSpecialist')->name('assign_specialist');
    });
    Route::prefix('re-approval-customer')->controller(ApprovedCustomers::class)->name('re_approval_customer-')->group(function () {
        Route::get('view', 'viewReApprovalCustomers')->name('view');
        Route::get('fetch', 'fetchReApprovalCustomers')->name('fetch');

        Route::get('proceed-for-approval/{customer_id}', 'proceedForApproval')->name('proceed_for_approval');
    });


    // CUSTOMER EXPORTS management
    Route::prefix('customer-exports')->controller(CustomerExportsController::class)->name('customer_exports-')->group(function () {
        Route::get('view', 'view')->name('view');
        Route::get('download/{export_id}', 'download')->name('download');

        Route::get('rcl', 'rcl')->name('rcl');
        Route::post('rcl', 'rcl')->name('rcl');
    });



    // CUSTOMER NOTES management
    Route::prefix('customer-notes')->controller(CustomerNotesController::class)->name('customer_notes-')->group(function () {
        Route::post('add/{customer_id}', 'add')->name('add');
        Route::get('get/{customer_id}', 'get')->name('get');
    });

    // LEADCENTER management
    Route::prefix('leadcenter')->controller(LeadcenterController::class)->name('leadcenter-')->group(function () {
        Route::get('fetch', 'fetch')->name('fetch');
        Route::get('view', 'view')->name('view');

        Route::post('upload', 'upload')->name('upload');

        Route::get('get-agents', 'getAgents')->name('get_agents');
        Route::post('assign-agent', 'assignAgent')->name('assign_agent');
        Route::post('unassign-agent', 'unassignAgent')->name('unassign_agent');

        Route::get('get-rnd-agents', 'getRnDAgents')->name('get_rnd_agents');
        Route::post('move-to-rnd', 'moveToRnd')->name('move_to_rnd');
        Route::post('assign-to-rnd-agent', 'assignToRnDAgent')->name('assign_to_rnd_Agent');
        Route::post('unassign-to-rnd', 'UnassignToRnd')->name('unassign_to_rnd');

        Route::get('get-offices', 'getOffices')->name('get_offices');
        Route::post('assign-office', 'assignOffice')->name('assign_office');

        Route::get('fill-details/{id}', 'fillDetails')->name('fill_details');
        Route::post('fill-details/{id}', 'fillDetails')->name('fill_details');

        Route::post('delete', 'delete')->name('delete');

        Route::get('complete/{leadcenter_id}', 'complete')->name('complete');
        Route::get('incomplete/{leadcenter_id}', 'incomplete')->name('incomplete');

        Route::post('bulk-complete', 'bulkComplete')->name('bulk_complete');


        Route::post('download-in-csv', 'downloadInCsv')->name('download_in_csv');
        Route::post('download-in-txt-zip', 'downloadInTxtZip')->name('download_in_txt_zip');


        Route::get('find-person', 'findPersons')->name('find_person');
    });

    // Report Request management
    Route::prefix('report_request')->controller(ReportRequestController::class)->name('report_request-')->group(function () {
        Route::get('fetch', 'fetch')->name('fetch');

        Route::post('attach', 'attach')->name('attach');

        Route::post('approval_status', 'approvalStatus')->name('approval_status');
        include('general_routes.php');
    });

    // M IDs management
    Route::prefix('m_ids')->controller(MIdsController::class)->name('m_ids-')->group(function () {
        Route::get('get', 'get')->name('get');
        Route::get('delete/{id}', 'delete')->name('delete');
        include('general_routes.php');
    });


    // Scripts management
    Route::prefix('scripts-management')->controller(ScriptsController::class)->name('scripts_management-')->group(function () {
        include('general_routes.php');
    });

    // Report management
    Route::prefix('report')->controller(ReportsController::class)->name('report-')->group(function () {
        Route::get('get/{customer_id}', 'get')->name('get');
        Route::get('detail/{id}', 'detail')->name('detail');
        Route::get('fetch/{customer_id}', 'fetch')->name('fetch');
        Route::Post('fetch/{customer_id}', 'fetch')->name('fetch');
    });

    // WHITELISTED IPs
    Route::prefix('whitelisted-ips')->controller(WhitelistedIpsController::class)->name('whitelisted_ips-')->group(function () {
        Route::get('delete/{id}', 'delete')->name('delete');
        include('general_routes.php');
    });

    // Offices Management
    Route::prefix('offices')->controller(OfficesController::class)->name('offices-')->group(function () {
        include('general_routes.php');
    });


    Route::prefix('personnel')->controller(PersonnelController::class)->name('personnel-')->group(function () {
        include('general_routes.php');
    });

    // PHONE VALIDATION LOGS
    Route::prefix('phone-validation-logs')->controller(PhoneValidationLogsController::class)->name('phone_validation_logs-')->group(function () {
        Route::get('view', 'view')->name('view');
        Route::get('fetch', 'fetch')->name('fetch');
    });

    // CUSTOMER PHONE MODIFICATION LOGS
    Route::prefix('customer-phone-modification-logs')->controller(CustomerPhoneModificationLogsController::class)->name('customer_phone_modification_logs-')->group(function () {
        Route::get('view', 'view')->name('view');
        Route::get('fetch', 'fetch')->name('fetch');
    });


    // EXTERNAL CALL LOGS
    Route::prefix('daily-call-logs')->controller(ExternalCallLogsController::class)->name('external_call_logs-')->group(function () {
        Route::get('view', 'view')->name('view');
        Route::get('fetch', 'fetch')->name('fetch');
    });

    // content management
    Route::prefix('info-model')->controller(InfoModalController::class)->name('info-model-')->group(function () {
        include('general_routes.php');
    });

    Route::prefix('faq-category')->controller(FaqCategoryController::class)->name('faq-category-')->group(function () {
        include('general_routes.php');
    });

    Route::prefix('faq')->controller(FaqController::class)->name('faq-')->group(function () {
        include('general_routes.php');
    });

    Route::prefix('city')->controller(CityController::class)->name('city-')->group(function () {
        include('general_routes.php');
    });


    Route::prefix('site-content')->controller(ContentTestController::class)->name('site-content-')->group(function () {
        include('general_routes.php');
    });

    Route::prefix('topics')->controller(TopicsController::class)->name('topics-')->group(function () {
        Route::get('linking-page/{id}', 'linkWithPage')->name('linking-page');
        Route::get('get-topics-parent-by-type',  'getParentByType')->name('get-parent-by-type');
        Route::get('fetch', [TopicsController::class, 'fetch'])->name('topics-fetch');
        include('general_routes.php');
    });

    Route::prefix('sub_topic')->controller(SubTopicController::class)->name('sub_topic-')->group(function () {
        include('general_routes.php');
    });

    Route::prefix('disease')->controller(DiseaseController::class)->name('disease-')->group(function () {
        Route::get('linking-page/{id}/{lang_id?}',  'linkWithPage')->name('linking-page');
        include('general_routes.php');
    });

    Route::prefix('drug')->controller(DrugController::class)->name('drug-')->group(function () {
        Route::get('linking-page/{id}/{lang_id?}',  'linkWithPage')->name('linking-page');
        include('general_routes.php');
    });

    Route::prefix('widget')->controller(WidgetController::class)->name('widget-')->group(function () {
        include('general_routes.php');
    });

    Route::prefix('article')->controller(ArticleController::class)->name('article-')->group(function () {
        Route::get('get-article-parent-by-type',  'getArticleParentByType')->name('get-parent-by-type');
        Route::get('fetch', [ArticleController::class, 'fetch'])->name('article-fetch');
        Route::get('delete-widget/{reference_id}', [ArticleController::class, 'deleteWidgetByReference'])->name('delete-widget');
        include('general_routes.php');
    });

    Route::prefix('tag')->controller(TagsController::class)->name('tag-')->group(function () {
        include('general_routes.php');
    });

    Route::prefix('speciality')->controller(SpecialityController::class)->name('speciality-')->group(function () {
        Route::get('fetch', [SpecialityController::class, 'fetch'])->name('speciality-fetch');
        include('general_routes.php');
    });

    Route::prefix('service')->controller(ServiceController::class)->name('service-')->group(function () {
        Route::get('fetch', [ServiceController::class, 'fetch'])->name('service-fetch');
        include('general_routes.php');
    });

    Route::prefix('language')->controller(LanguageController::class)->name('language-')->group(function () {
        include('general_routes.php');
    });

    Route::prefix('menu')->controller(MenuController::class)->name('menu-')->group(function () {
        Route::get('get-menu-parent-by-type',  'getParentsByType')->name('get-parent-by-type');

        Route::get('view/{lang_id}', 'view')->name('view');
        Route::get('fetch/{lang_id}', 'fetch')->name('fetch');

        Route::post('update-sequence/{lang_id}/', 'update_sequence')->name('update_sequence');

        Route::get('add/{lang_id}', 'add')->name('add');
        Route::post('add/{lang_id}', 'add')->name('add');

        Route::get('edit/{id}/{lang_id}', 'edit')->name('edit');
        Route::post('edit/{id}/{lang_id}', 'edit')->name('edit');
    });

    Route::prefix('page')->controller(PageController::class)->name('page-')->group(function () {
        Route::get('linking-page/{id}/{lang_id?}',  'linkWithPage')->name('linking-page');
        Route::get('get-page-parent-by-type',  'getPageParentByType')->name('get-parent-by-type');
        Route::get('fetch', [PageController::class, 'fetch'])->name('page-fetch');
        Route::get('delete-widget/{reference_id}', [PageController::class, 'deleteWidgetByReference'])->name('delete-widget');
        include('general_routes.php');
    });

    Route::prefix('subscription')->controller(SubscriptionManagementController::class)->name('subscription-')->group(function () {
        include('general_routes.php');
    });

    // Route::get('rearrange/{reference_widget_id}',[ArticleController::class,'reArrangeReferenceWidgets']);
    Route::post('move-widget', [ArticleController::class, 'repositionWidget'])->name('repositionWidget');
    Route::post('add-widget', [ArticleController::class, 'addWidget'])->name('article-addWidget');
    Route::post('page/add-widget', [PageController::class, 'addWidget'])->name('page-addWidget');
    Route::post('delete-widget', [ArticleController::class, 'deleteWidget'])->name('deleteWidget');

    // Doctor management Routes
    Route::prefix('doctor')->controller(DoctorManagementController::class)->name('doctor-')->group(function () {
        include('general_routes.php');

        Route::get('reviews/{doctor_id}', 'reviews')->name('reviews');

        // UPDATE SERVICES
        Route::get('services/update/{doctor_id}', 'updateServices')->name('update-services');
        Route::post('services/update/{doctor_id}', 'updateServices')->name('update-services');

        // UPDATE SPECIALITIES
        Route::get('specialities/update/{doctor_id}', 'updateSpecialities')->name('update-specialities');
        Route::post('specialities/update/{doctor_id}', 'updateSpecialities')->name('update-specialities');


        // UPDATE SPECIALITIES
        Route::get('experiences/update/{doctor_id}', 'updateExperiences')->name('update-experiences');
        Route::post('experiences/update/{doctor_id}', 'updateExperiences')->name('update-experiences');


        // UPDATE SPECIALITIES
        Route::get('educations/update/{doctor_id}', 'updateEducations')->name('update-educations');
        Route::post('educations/update/{doctor_id}', 'updateEducations')->name('update-educations');
    });

    // Doctor management Routes
    Route::prefix('ads')->controller(AdController::class)->name('ads-')->group(function () {
        include('general_routes.php');
    });

    Route::prefix('footer')->controller(FooterMenuController::class)->name('footer-')->group(function () {
        Route::get('view/{lang_id}', 'view')->name('view');
        Route::get('fetch/{lang_id}', 'fetch')->name('fetch');

        Route::post('update-sequence', 'update_sequence')->name('update_sequence');

        Route::get('add/{lang_id}', 'add')->name('add');
        Route::post('add/{lang_id}', 'add')->name('add');

        Route::get('edit/{id}/{lang_id}', 'edit')->name('edit');
        Route::post('edit/{id}/{lang_id}', 'edit')->name('edit');
    });

    Route::prefix('article-badge')->controller(ArticleBadgeController::class)->name('article_badge-')->group(function () {
        include('general_routes.php');
    });

    Route::prefix('health-scan-management')->controller(HealthScanController::class)->name('health-scan-management-')->group(function () {
        include('general_routes.php');
    });

    Route::prefix('appointment')->controller(AppointmentController::class)->name('appointment-')->group(function () {
        Route::get('get-form/{appointment_id}', 'getQuestionaireForm')->name('get_questionaire_form');
        Route::post('get-form/{appointment_id}', 'getQuestionaireForm')->name('get_questionaire_form');
        Route::get('detail/{id}', 'detail')->name('detail');
        include('general_routes.php');
    });

    Route::prefix('questionaire-form')->controller(QuestionaireController::class)->name('questionaire_form-')->group(function () {
        include('general_routes.php');
    });

    Route::get('send-mail', [TestMailController::class, 'sendMail'])->name('sendMail');
    Route::get('send-sms', [TestMailController::class, 'sendSms'])->name('sendSms');
    Route::get('create-admin-notification', [TestMailController::class, 'createAdminNotification'])->name('create_admin_notification');
    Route::get('push-notification', [TestMailController::class, 'sendPushNotification'])->name('push_notification');

    Route::prefix('report')->controller(ReportController::class)->name('report-')->group(function () {
        Route::get('sehat-scan', 'SehatScanReports')->name('sehat_scan_report');
        Route::get('sehat-scan/fetch', 'FetchSehatScanReports')->name('sehat_scan_report-fetch');
    });

    Route::prefix('newsletter')->controller(NewsletterController::class)->name('newsletter-')->group(function () {
        include('general_routes.php');
    });

    Route::prefix('article-fact')->controller(ArticleFactController::class)->name('article-fact-')->group(function () {
        include('general_routes.php');
    });
});
