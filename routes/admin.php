<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\ExtensionController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\AllCategoryController;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\Admin\PageBuilderController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\SupportTicketController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Request\AuctionFormRequestController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AuthorityController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\OpportunityController;
use App\Http\Controllers\Admin\PreviousWorkController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\OrderController;

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'Login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

//     Admin Password Reset
Route::prefix('password')->name('password.')->group(function () {
    Route::get('reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('reset');
    Route::post('reset', [ForgotPasswordController::class, 'sendResetCodeEmail']);
    Route::get('code-verify', [ForgotPasswordController::class, 'codeVerify'])->name('code.verify');
    Route::post('verify-code', [ForgotPasswordController::class, 'verifyCode'])->name('verify.code');
});

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset.form');
Route::post('password/reset/change', [ResetPasswordController::class, 'reset'])->name('password.change');

Route::middleware('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('profile', [AdminController::class, 'profileUpdate'])->name('profile.update');
    Route::get('password', [AdminController::class, 'password'])->name('password');
    Route::post('password', [AdminController::class, 'passwordUpdate'])->name('password.update');

    //Notification
    Route::get('notifications', [AdminController::class, 'notifications'])->name('notifications');
    Route::get('notification/read/{id}', [AdminController::class, 'notificationRead'])->name('notification.read');
    Route::get('notifications/read-all', [AdminController::class, 'readAll'])->name('notifications.readAll');
    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('profile', [AdminController::class, 'profileUpdate'])->name('profile.update');
    Route::get('password', [AdminController::class, 'password'])->name('password');
    Route::post('password', [AdminController::class, 'passwordUpdate'])->name('password.update');

    // Users Manager
    Route::name('users.')->prefix('users')->group(function () {
        Route::get('/', [ManageUsersController::class, 'allUsers'])->name('all');
        Route::get('active', [ManageUsersController::class, 'activeUsers'])->name('active');
        Route::get('banned', [ManageUsersController::class, 'bannedUsers'])->name('banned');
        Route::get('email-verified', [ManageUsersController::class, 'emailVerifiedUsers'])->name('email.verified');
        Route::get('email-unverified', [ManageUsersController::class, 'emailUnverifiedUsers'])->name('email.unverified');
        Route::get('mobile-unverified', [ManageUsersController::class, 'mobileUnverifiedUsers'])->name('mobile.unverified');
        Route::get('detail/{id}', [ManageUsersController::class, 'detail'])->name('detail');
        Route::post('update/{id}', [ManageUsersController::class, 'update'])->name('update');
        Route::get('send-notification/{id}', [ManageUsersController::class, 'showNotificationSingleForm'])->name('notification.single');
        Route::post('send-notification/{id}', [ManageUsersController::class, 'sendNotificationSingle'])->name('notification.single');
        Route::get('login/{id}', [ManageUsersController::class, 'login'])->name('login');
        Route::post('status/{id}', [ManageUsersController::class, 'status'])->name('status');

        Route::get('send-notification', [ManageUsersController::class, 'showNotificationAllForm'])->name('notification.all');
        Route::post('send-notification', [ManageUsersController::class, 'sendNotificationAll'])->name('notification.all.send');
        Route::get('list', [ManageUsersController::class, 'list'])->name('list');
        Route::get('notification-log/{id}', [ManageUsersController::class, 'notificationLog'])->name('notification.log');
        Route::get('user-export-excel', [ManageUsersController::class, 'exportExcel'])->name('export.excel');
        Route::get('download-pdf/{id}', [ManageUsersController::class, 'downloadPdf'])->name('download.pdf');
        Route::get('download-excel/{id?}', [ManageUsersController::class, 'downloadExcel'])->name('download.excel');
    });

    // Admin Support
    Route::prefix('support')->name('support.')->group(function () {
        Route::get('/', [SupportTicketController::class, 'tickets'])->name('index');
        Route::get('pending', [SupportTicketController::class, 'pendingTicket'])->name('pending');
        Route::get('closed', [SupportTicketController::class, 'closedTicket'])->name('closed');
        Route::get('answered', [SupportTicketController::class, 'answeredTicket'])->name('answered');
        Route::get('view/{id}', [SupportTicketController::class, 'ticketReply'])->name('view');
        Route::post('reply/{id}', [SupportTicketController::class, 'replyTicket'])->name('reply');
        Route::post('close/{id}', [SupportTicketController::class, 'closeTicket'])->name('close');
        Route::get('download/{ticket}', [SupportTicketController::class, 'ticketDownload'])->name('download');
        Route::post('delete/{id}', [SupportTicketController::class, 'ticketDelete'])->name('delete');
    });

    // Report
    Route::prefix('report')->name('report.')->group(function () {
        Route::get('login/history', [ReportController::class, 'loginHistory'])->name('login.history');
        Route::get('login/ipHistory/{ip}', [ReportController::class, 'loginIpHistory'])->name('login.ipHistory');
        Route::get('notification/history', [ReportController::class, 'notificationHistory'])->name('notification.history');
        Route::get('email/detail/{id}', [ReportController::class, 'emailDetails'])->name('email.details');
    });

    // Subscriber
    Route::prefix('subscriber')->name('subscriber.')->group(function () {
        Route::get('/', [SubscriberController::class, 'index'])->name('index');
        Route::get('send-email', [SubscriberController::class, 'sendEmailForm'])->name('send.email');
        Route::post('remove/{id}', [SubscriberController::class, 'remove'])->name('remove');
        Route::post('send-email', [SubscriberController::class, 'sendEmail'])->name('send.email');
    });

    // General Setting
    Route::get('general-setting', [GeneralSettingController::class, 'index'])->name('setting.index');
    Route::post('general-setting', [GeneralSettingController::class, 'update'])->name('setting.update');

    //configuration
    Route::get('setting/system-configuration', [GeneralSettingController::class, 'systemConfiguration'])->name('setting.system.configuration');
    Route::post('setting/system-configuration', [GeneralSettingController::class, 'systemConfigurationSubmit']);

    // Logo-Icon
    Route::get('setting/logo-icon', [GeneralSettingController::class, 'logoIcon'])->name('setting.logo.icon');
    Route::post('setting/logo-icon', [GeneralSettingController::class, 'logoIconUpdate'])->name('setting.logo.icon');

    //Custom CSS
    Route::get('custom-css', [GeneralSettingController::class, 'customCss'])->name('setting.custom.css');
    Route::post('custom-css', [GeneralSettingController::class, 'customCssSubmit']);

    //Cookie
    Route::get('cookie', [GeneralSettingController::class, 'cookie'])->name('setting.cookie');
    Route::post('cookie', [GeneralSettingController::class, 'cookieSubmit']);

    //maintenance_mode
    Route::get('maintenance-mode', [GeneralSettingController::class, 'maintenanceMode'])->name('maintenance.mode');
    Route::post('maintenance-mode', [GeneralSettingController::class, 'maintenanceModeSubmit']);

    // Plugin
    Route::prefix('extensions')->name('extensions.')->group(function () {
        Route::get('/', [ExtensionController::class, 'index'])->name('index');
        Route::post('update/{id}', [ExtensionController::class, 'update'])->name('update');
        Route::post('status/{id}', [ExtensionController::class, 'status'])->name('status');
    });

    // Language Manager
    Route::prefix('language')->name('language.')->group(function () {
        Route::get('/', [LanguageController::class, 'langManage'])->name('manage');
        Route::post('/', [LanguageController::class, 'langStore'])->name('manage.store');
        Route::post('delete/{id}', [LanguageController::class, 'langDelete'])->name('manage.delete');
        Route::post('update/{id}', [LanguageController::class, 'langUpdate'])->name('manage.update');
        Route::get('edit/{id}', [LanguageController::class, 'langEdit'])->name('key');
        Route::post('import', [LanguageController::class, 'langImport'])->name('import.lang');
        Route::post('store/key/{id}', [LanguageController::class, 'storeLanguageJson'])->name('store.key');
        Route::post('delete/key/{id}', [LanguageController::class, 'deleteLanguageJson'])->name('delete.key');
        Route::post('update/key/{id}', [LanguageController::class, 'updateLanguageJson'])->name('update.key');
        Route::get('get-keys', [LanguageController::class, 'getKeys'])->name('get.key');
    });

    // Frontend
    Route::name('frontend.')->prefix('frontend')->group(function () {
        Route::get('frontend-sections/{key}', [FrontendController::class, 'frontendSections'])->name('sections');
        Route::post('frontend-content/{key}', [FrontendController::class, 'frontendContent'])->name('sections.content');
        Route::get('frontend-element/{key}/{id?}', [FrontendController::class, 'frontendElement'])->name('sections.element');
        Route::post('remove/{id}', [FrontendController::class, 'remove'])->name('remove');

        // Page Builder
        Route::get('manage-pages', [PageBuilderController::class, 'managePages'])->name('manage.pages');
        Route::post('manage-pages', [PageBuilderController::class, 'managePagesSave'])->name('manage.pages.save');
        Route::post('manage-pages/update', [PageBuilderController::class, 'managePagesUpdate'])->name('manage.pages.update');
        Route::post('manage-pages/delete/{id}', [PageBuilderController::class, 'managePagesDelete'])->name('manage.pages.delete');
        Route::get('manage-section/{id}', [PageBuilderController::class, 'manageSection'])->name('manage.section');
        Route::post('manage-section/{id}', [PageBuilderController::class, 'manageSectionUpdate'])->name('manage.section.update');

    });

    Route::get('seo', [FrontendController::class, 'seoEdit'])->name('seo');

    Route::name('frontend.')->prefix('frontend')->group(function () {

        Route::get('templates', [FrontendController::class, 'templates'])->name('templates');
        Route::post('templates', [FrontendController::class, 'templatesActive'])->name('templates.active');
        Route::get('frontend-sections/{key}', [FrontendController::class, 'frontendSections'])->name('sections');
        Route::post('frontend-content/{key}', [FrontendController::class, 'frontendContent'])->name('sections.content');
        Route::get('frontend-element/{key}/{id?}', [FrontendController::class, 'frontendElement'])->name('sections.element');
        Route::post('remove/{id}', [FrontendController::class, 'remove'])->name('remove');

        // Page Builder
        Route::get('manage-pages', [PageBuilderController::class, 'managePages'])->name('manage.pages');
        Route::post('manage-pages', [PageBuilderController::class, 'managePagesSave'])->name('manage.pages.save');
        Route::post('manage-pages/update', [PageBuilderController::class, 'managePagesUpdate'])->name('manage.pages.update');
        Route::post('manage-pages/delete/{id}', [PageBuilderController::class, 'managePagesDelete'])->name('manage.pages.delete');
        Route::get('manage-section/{id}', [PageBuilderController::class, 'manageSection'])->name('manage.section');
        Route::post('manage-section/{id}', [PageBuilderController::class, 'manageSectionUpdate'])->name('manage.section.update');

    });

    //Notification Setting
    Route::name('setting.notification.')->controller('NotificationController')->prefix('notification')->group(function () {
        //Template Setting
        Route::get('global', [NotificationController::class, 'global'])->name('global');
        Route::post('global/update', [NotificationController::class, 'globalUpdate'])->name('global.update');
        Route::get('templates', [NotificationController::class, 'templates'])->name('templates');
        Route::get('template/edit/{id}', [NotificationController::class, 'templateEdit'])->name('template.edit');
        Route::post('template/update/{id}', [NotificationController::class, 'templateUpdate'])->name('template.update');

        //Email Setting
        Route::get('email/setting', [NotificationController::class, 'emailSetting'])->name('email');
        Route::post('email/setting', [NotificationController::class, 'emailSettingUpdate']);
        Route::post('email/test', [NotificationController::class, 'emailTest'])->name('email.test');

        //SMS Setting
        Route::get('sms/setting', [NotificationController::class, 'smsSetting'])->name('sms');
        Route::post('sms/setting', [NotificationController::class, 'smsSettingUpdate']);
        Route::post('sms/test', [NotificationController::class, 'smsTest'])->name('sms.test');
    });


    Route::prefix('city')->name('city.')->group(function () {
        Route::get('/', [CityController::class, 'index'])->name('index');
        Route::get('/create', [CityController::class, 'create'])->name('create');
        Route::post('/store/{id?}', [CityController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CityController::class, 'edit'])->name('edit');
    });

    // country route
    Route::prefix('country')->name('country.')->group(function () {
        Route::get('/', [CountryController::class, 'index'])->name('index');
        Route::post('/store/{id?}', [CountryController::class, 'store'])->name('store');
    });

    // blog route
    Route::group(['prefix' => 'blog-category', 'as' => 'blog.category.'], function () {
        Route::get('/', [BlogCategoryController::class, 'index'])->name('index');
        Route::post('/store/{id?}', [BlogCategoryController::class, 'store'])->name('store');
        Route::post('/status/{id}', [BlogCategoryController::class, 'status'])->name('status');
    });

    Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::get('/create', [BlogController::class, 'create'])->name('create');
        Route::post('/store/{id?}', [BlogController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('edit');
        Route::post('/status/{id}', [BlogController::class, 'status'])->name('status');
        Route::post('/delete/{id}', [BlogController::class, 'delete'])->name('delete');
    });


    Route::group(['prefix' => 'all-category', 'as' => 'all_category.'], function () {
        Route::get('/', [AllCategoryController::class, 'index'])->name('index');
        Route::get('/create', [AllCategoryController::class, 'create'])->name('create');
        Route::post('/store/{id?}', [AllCategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AllCategoryController::class, 'edit'])->name('edit');
        Route::get('/status/{id}', [AllCategoryController::class, 'status'])->name('status');
    });

    // Auction request route
    Route::group(['prefix' => 'auction-request', 'as' => 'auction.request.'], function () {
        Route::get('/', [AuctionFormRequestController::class, 'index'])->name('index');
        Route::get('/pending', [AuctionFormRequestController::class, 'pending'])->name('pending');
        Route::get('/published', [AuctionFormRequestController::class, 'accepted'])->name('accepted');
        Route::get('/rejected', [AuctionFormRequestController::class, 'rejected'])->name('rejected');
        Route::get('/status/{id}/{status}', [AuctionFormRequestController::class, 'status'])->name('status');
        Route::get('/show/{id}', [AuctionFormRequestController::class, 'show'])->name('show');
    });

    Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('/create', [ServiceController::class, 'create'])->name('create');
        Route::post('/store', [ServiceController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ServiceController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ServiceController::class, 'update'])->name('update');
        Route::get('/show/{slug}', [ServiceController::class, 'show'])->name('show');
        Route::delete('/delete/{id}', [ServiceController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::get('/show/{id}', [CategoryController::class, 'show'])->name('show');
        Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'authorities', 'as' => 'authorities.'], function () {
        Route::get('/', [AuthorityController::class, 'index'])->name('index');
        Route::get('/create', [AuthorityController::class, 'create'])->name('create');
        Route::post('/store', [AuthorityController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AuthorityController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AuthorityController::class, 'update'])->name('update');
        Route::get('/show/{id}', [AuthorityController::class, 'show'])->name('show');
        Route::delete('/delete/{id}', [AuthorityController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'opportunities', 'as' => 'opportunities.'], function () {
        Route::get('/', [OpportunityController::class, 'index'])->name('index');
        Route::get('/create', [OpportunityController::class, 'create'])->name('create');
        Route::post('/store', [OpportunityController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [OpportunityController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [OpportunityController::class, 'update'])->name('update');
        Route::get('/show/{id}', [OpportunityController::class, 'show'])->name('show');
        Route::delete('/delete/{id}', [OpportunityController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'previous-works', 'as' => 'previous-works.'], function () {
        Route::get('/', [PreviousWorkController::class, 'index'])->name('index');
        Route::get('/create', [PreviousWorkController::class, 'create'])->name('create');
        Route::post('/store', [PreviousWorkController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PreviousWorkController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PreviousWorkController::class, 'update'])->name('update');
        Route::get('/show/{id}', [PreviousWorkController::class, 'show'])->name('show');
        Route::delete('/delete/{id}', [PreviousWorkController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'projects', 'as' => 'projects.'], function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/create', [ProjectController::class, 'create'])->name('create');
        Route::post('/store', [ProjectController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ProjectController::class, 'update'])->name('update');
        Route::get('/show/{id}', [ProjectController::class, 'show'])->name('show');
        Route::delete('/delete/{id}', [ProjectController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/create', [OrderController::class, 'create'])->name('create');
        Route::post('/store', [OrderController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [OrderController::class, 'update'])->name('update');
        Route::get('/show/{id}', [OrderController::class, 'show'])->name('show');
        Route::delete('/delete/{id}', [OrderController::class, 'destroy'])->name('delete');
    });

     Route::group(['prefix' => 'messages', 'as' => 'messages.'], function () {
        Route::get('/', [MessageController::class, 'index'])->name('index');
        Route::get('/create', [MessageController::class, 'create'])->name('create');
        Route::post('/store', [MessageController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [MessageController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [MessageController::class, 'update'])->name('update');
        Route::get('/show/{id}', [MessageController::class, 'show'])->name('show');
        Route::delete('/delete/{id}', [MessageController::class, 'destroy'])->name('delete');
    });
    
    Route::get('service-requests', [\App\Http\Controllers\Admin\ServiceRequestController::class, 'index'])->name('service-request.index');
    Route::get('service-requests/show/{id}', [\App\Http\Controllers\Admin\ServiceRequestController::class, 'show'])->name('service-request.show');
    Route::post('service-requests/update-status/{id}', [\App\Http\Controllers\Admin\ServiceRequestController::class, 'updateStatus'])
        ->name('service-requests.update-status');
    Route::get('service-requests/download/{id}', [\App\Http\Controllers\Admin\ServiceRequestController::class, 'downloadAttachment'])
        ->name('service-requests.download');
});
