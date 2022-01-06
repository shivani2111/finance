<?php
Route::redirect('/', 'admin/home');

Auth::routes(['register' => false]);

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::delete('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
    Route::resource('roles', 'Admin\RolesController');
    Route::delete('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');
    Route::resource('users', 'Admin\UsersController');
    Route::delete('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');

    //************************************* Branch routes *************************************//
    //show branch
    Route::get('branch', 'BranchController@index');
    //Create branch
    Route::get('branch/create', 'BranchController@create');
    //get state wisw city
    Route::get('branch/getcity/{id}', 'BranchController@getcity');
    //Store branch
    Route::post('branch/store', 'BranchController@store');
    //Show branch details
    Route::get('branch/show/{id}', 'BranchController@show');

    //************************************* Loan routes *************************************//
    //show loan
    Route::get('loan', 'LoanController@index');
    //Create loan
    Route::get('loan/create', 'LoanController@create');
    //Store loan
    Route::post('loan/store', 'LoanController@store');
//    //Show branch details
//    Route::get('branch/show/{id}', 'BranchController@show');


});
