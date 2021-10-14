<?php

Route::redirect('/admin', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Slider
    Route::delete('sliders/destroy', 'SliderController@massDestroy')->name('sliders.massDestroy');
    Route::post('sliders/media', 'SliderController@storeMedia')->name('sliders.storeMedia');
    Route::post('sliders/ckmedia', 'SliderController@storeCKEditorImages')->name('sliders.storeCKEditorImages');
    Route::resource('sliders', 'SliderController');

    // About Us
    Route::delete('aboutuses/destroy', 'AboutUsController@massDestroy')->name('aboutuses.massDestroy');
    Route::post('aboutuses/media', 'AboutUsController@storeMedia')->name('aboutuses.storeMedia');
    Route::post('aboutuses/ckmedia', 'AboutUsController@storeCKEditorImages')->name('aboutuses.storeCKEditorImages');
    Route::resource('aboutuses', 'AboutUsController');

    // Medical Opinions
    Route::delete('medical-opinions/destroy', 'MedicalOpinionsController@massDestroy')->name('medical-opinions.massDestroy');
    Route::post('medical-opinions/media', 'MedicalOpinionsController@storeMedia')->name('medical-opinions.storeMedia');
    Route::post('medical-opinions/ckmedia', 'MedicalOpinionsController@storeCKEditorImages')->name('medical-opinions.storeCKEditorImages');
    Route::resource('medical-opinions', 'MedicalOpinionsController');

    // Champions
    Route::delete('champions/destroy', 'ChampionsController@massDestroy')->name('champions.massDestroy');
    Route::post('champions/media', 'ChampionsController@storeMedia')->name('champions.storeMedia');
    Route::post('champions/ckmedia', 'ChampionsController@storeCKEditorImages')->name('champions.storeCKEditorImages');
    Route::resource('champions', 'ChampionsController');

    // Languages
    Route::delete('languages/destroy', 'LanguagesController@massDestroy')->name('languages.massDestroy');
    Route::resource('languages', 'LanguagesController');

    // Special Tools
    Route::delete('special-tools/destroy', 'SpecialToolsController@massDestroy')->name('special-tools.massDestroy');
    Route::post('special-tools/media', 'SpecialToolsController@storeMedia')->name('special-tools.storeMedia');
    Route::post('special-tools/ckmedia', 'SpecialToolsController@storeCKEditorImages')->name('special-tools.storeCKEditorImages');
    Route::resource('special-tools', 'SpecialToolsController');

    // Contactus
    Route::delete('contactus/destroy', 'ContactusController@massDestroy')->name('contactus.massDestroy');
    Route::resource('contactus', 'ContactusController', ['except' => ['create', 'store', 'edit', 'update', 'show']]);

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Practical Solutions
    Route::delete('practical-solutions/destroy', 'PracticalSolutionsController@massDestroy')->name('practical-solutions.massDestroy');
    Route::post('practical-solutions/media', 'PracticalSolutionsController@storeMedia')->name('practical-solutions.storeMedia');
    Route::post('practical-solutions/ckmedia', 'PracticalSolutionsController@storeCKEditorImages')->name('practical-solutions.storeCKEditorImages');
    Route::resource('practical-solutions', 'PracticalSolutionsController');

    // Staff
    Route::delete('staff/destroy', 'StaffController@massDestroy')->name('staff.massDestroy');
    Route::post('staff/media', 'StaffController@storeMedia')->name('staff.storeMedia');
    Route::post('staff/ckmedia', 'StaffController@storeCKEditorImages')->name('staff.storeCKEditorImages');
    Route::resource('staff', 'StaffController');

    // Problems
    Route::delete('problems/destroy', 'ProblemsController@massDestroy')->name('problems.massDestroy');
    Route::resource('problems', 'ProblemsController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
//frontend
Route::group([ 'namespace' => 'Frontend'], function () {

Route::get('/', 'HomeController@index')->name('home');

Route::get('/about', 'AboutUsController@about')->name('frontend.about_us');

Route::get('/PracticalSolution', 'PracticalSolutionsController@all')->name('frontend.practical_solutions');
Route::get('/Show_PracticalSolution/{id}', 'PracticalSolutionsController@show')->name('frontend.practical_solution_show');
Route::get('/medical_opinions', 'MedicalOpinionsController@opinions')->name('frontend.medical_opinions');
Route::get('/champions', 'ChampionsController@champions')->name('frontend.champions');
Route::get('/champion_single/{id}', 'ChampionsController@champion_single')->name('frontend.champion_single');
Route::get('/tools', 'SpecialToolsController@tools')->name('frontend.tools');
Route::get('/contact_us', 'ContactusController@contactus')->name('frontend.contactus');
Route::Post('/contact_us/store', 'ContactusController@store')->name('frontend.contactus-store');



});