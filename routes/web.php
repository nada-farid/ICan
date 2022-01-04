<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth','staff']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

      // Users
      Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
      Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
      Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
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
    // Public Subjects
    Route::delete('public-subjects/destroy', 'PublicSubjectsController@massDestroy')->name('public-subjects.massDestroy');
    Route::post('public-subjects/media', 'PublicSubjectsController@storeMedia')->name('public-subjects.storeMedia');
    Route::post('public-subjects/ckmedia', 'PublicSubjectsController@storeCKEditorImages')->name('public-subjects.storeCKEditorImages');
    Route::resource('public-subjects', 'PublicSubjectsController');

    // Comments
    Route::delete('comments/destroy', 'CommentsController@massDestroy')->name('comments.massDestroy');
    Route::resource('comments', 'CommentsController');

    // Subjects Categories
    Route::delete('subjects-categories/destroy', 'SubjectsCategoriesController@massDestroy')->name('subjects-categories.massDestroy');
    Route::resource('subjects-categories', 'SubjectsCategoriesController');

    // Problems
    Route::delete('problems/destroy', 'ProblemsController@massDestroy')->name('problems.massDestroy');
    Route::resource('problems', 'ProblemsController');

    // Videos Participate
    Route::delete('videos-participates/destroy', 'VideosParticipateController@massDestroy')->name('videos-participates.massDestroy');
    Route::post('videos-participates/media', 'VideosParticipateController@storeMedia')->name('videos-participates.storeMedia');
    Route::post('videos-participates/ckmedia', 'VideosParticipateController@storeCKEditorImages')->name('videos-participates.storeCKEditorImages');
    Route::resource('videos-participates', 'VideosParticipateController');

    
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

    Route::get('/user/profile','HomeController@profile')->name('frontend.profile');
    Route::get('/user/profile_edit','HomeController@EditProfile')->name('frontend.profile_edit');
    Route::get('/user/profile_solves','HomeController@profile_solves')->name('frontend.profile_solves');
    Route::get('/user/profile_videos','HomeController@profile_videos')->name('frontend.profile_videos');
    Route::Post('/user/UpdateProfile','AuthController@UpdateProfile')->name('frontend.UpdateProfile');

    Route::get('/about', 'AboutUsController@about')->name('frontend.about_us');

    Route::get('/PracticalSolution', 'PracticalSolutionsController@all')->name('frontend.practical_solutions');
    Route::get('/Show_PracticalSolution/{id}', 'PracticalSolutionsController@show')->name('frontend.practical_solution_show');
    Route::get('/medical_opinions', 'MedicalOpinionsController@opinions')->name('frontend.medical_opinions');
    Route::get('/categories', 'PostController@index')->name('frontend.posts_categories');
    Route::get('/posts/{id}', 'PostController@posts')->name('frontend.posts');
    Route::get('/post_details/{post_id}', 'PostController@show')->name('frontend.post_details');
    Route::Post('/save_comment', 'PostController@StoreComment')->name('frontend.comment_store');
    Route::get('/champions', 'ChampionsController@champions')->name('frontend.champions');
    Route::get('/champion_single/{id}', 'ChampionsController@champion_single')->name('frontend.champion_single');
    Route::get('/tools', 'SpecialToolsController@tools')->name('frontend.tools');
    Route::get('/tool_detalis/{tool_id}', 'SpecialToolsController@show')->name('frontend.tool_single');

    Route::get('/contact_us', 'ContactusController@contactus')->name('frontend.contactus');
    Route::get('/problems/view', 'ProblemsController@view')->name('frontend.problem_view');
    Route::Post('/contact_us/save', 'ContactusController@store')->name('frontend.contactus-store');
    Route::Post('/problems/save', 'ProblemsController@store')->name('frontend.problem');
    Route::get('/register', 'AuthController@register')->name('frontend.register');
    Route::Post('/register', 'AuthController@store')->name('frontend.register_save');
    Route::post('users/media', 'AuthController@storeMedia')->name('frontend.storeMedia');
    Route::post('users/ckmedia', 'AuthController@storeCKEditorImages')->name('frontend.storeCKEditorImages');

    Route::post('/frontend/practical-solutions/media', 'PracticalSolutionsController@storeMedia')->name('frontend.practical-solutions.storeMedia');
    Route::post('/frontend/practical-solutions/ckmedia', 'PracticalSolutionsController@storeCKEditorImages')->name('frontend.practical-solutions.storeCKEditorImages'); 
    Route::post('practical-solutions/store', 'PracticalSolutionsController@store')->name('practical-solutions.store');
    Route::post('practical-solutions/edit', 'PracticalSolutionsController@edit')->name('practical-solutions.edit');
    Route::put('practical-solutions/update/{practicalSolution}', 'PracticalSolutionsController@update')->name('practical-solutions.update');
    Route::delete('practical-solutions/destroy/{practicalSolution}', 'PracticalSolutionsController@destroy')->name('practical-solutions.destroy');

    Route::post('videos-participates/media', 'VideosParticipateController@storeMedia')->name('frontend.videos-participates.storeMedia');
    Route::post('videos-participates/ckmedia', 'VideosParticipateController@storeCKEditorImages')->name('frontend.videos-participates.storeCKEditorImages');
    Route::post('videos-participates/store', 'VideosParticipateController@store')->name('videos-participates.store');
    Route::post('videos-participates/edit', 'VideosParticipateController@edit')->name('videos-participates.edit');
    Route::put('videos-participates/update/{videosParticipate}', 'VideosParticipateController@update')->name('videos-participates.update');
    Route::delete('videos-participates/destroy/{videosParticipate}', 'VideosParticipateController@destroy')->name('videos-participates.destroy');


});