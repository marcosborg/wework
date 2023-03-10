<?php

Route::redirect('/', '/login');
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

    // Company
    Route::delete('companies/destroy', 'CompanyController@massDestroy')->name('companies.massDestroy');
    Route::post('companies/media', 'CompanyController@storeMedia')->name('companies.storeMedia');
    Route::post('companies/ckmedia', 'CompanyController@storeCKEditorImages')->name('companies.storeCKEditorImages');
    Route::resource('companies', 'CompanyController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountriesController');

    // State
    Route::delete('states/destroy', 'StateController@massDestroy')->name('states.massDestroy');
    Route::resource('states', 'StateController');

    // Funnel
    Route::delete('funnels/destroy', 'FunnelController@massDestroy')->name('funnels.massDestroy');
    Route::post('funnels/media', 'FunnelController@storeMedia')->name('funnels.storeMedia');
    Route::post('funnels/ckmedia', 'FunnelController@storeCKEditorImages')->name('funnels.storeCKEditorImages');
    Route::resource('funnels', 'FunnelController');
    Route::get('funnels/funnels/{company_id}', 'FunnelController@funnels');

    // Step
    Route::delete('steps/destroy', 'StepController@massDestroy')->name('steps.massDestroy');
    Route::resource('steps', 'StepController');

    // Category
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoryController');

    // Client
    Route::delete('clients/destroy', 'ClientController@massDestroy')->name('clients.massDestroy');
    Route::resource('clients', 'ClientController');

    // Item
    Route::delete('items/destroy', 'ItemController@massDestroy')->name('items.massDestroy');
    Route::post('items/media', 'ItemController@storeMedia')->name('items.storeMedia');
    Route::post('items/ckmedia', 'ItemController@storeCKEditorImages')->name('items.storeCKEditorImages');
    Route::resource('items', 'ItemController');

    // Input
    Route::delete('inputs/destroy', 'InputController@massDestroy')->name('inputs.massDestroy');
    Route::resource('inputs', 'InputController');

    // Project
    Route::get('projects/{category_id?}', 'ProjectController@index')->name('projects.index');
    Route::get('projectsAjax/{category_id?}', 'ProjectController@ajax');
    Route::post('projectsUpdate', 'ProjectController@projectsUpdate');

    // District
    Route::delete('districts/destroy', 'DistrictController@massDestroy')->name('districts.massDestroy');
    Route::resource('districts', 'DistrictController');

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
Route::prefix('products')->group(function () {
    Route::get('/{company_id}/{funnel_id}', 'ProductController@index');
    Route::post('submit', 'ProductController@submit');
});

Route::get('teste', function(){
    return view('teste');
});