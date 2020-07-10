<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where Prayush will register web routes for the application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Lets create something great!
|
*/

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'Admin\DashboardController@index')->name('admin');

    Route::get('/projects', 'Admin\ProjectsController@index')->name('admin-projects');
    Route::get('/projects/create', 'Admin\ProjectsController@create')->name('admin-projects-create');
    Route::post('/projects/store/{uuid}', 'Admin\ProjectsController@store')->name('admin-projects-store');
    Route::get('/projects/edit/{project}', 'Admin\ProjectsController@edit')->name('admin-projects-edit');
    Route::post('/projects/update/{project}', 'Admin\ProjectsController@update')->name('admin-projects-update');
    Route::get('/projects/hide/{project}', 'Admin\ProjectsController@hide')->name('admin-projects-hide');
    Route::get('/projects/unhide/{project}', 'Admin\ProjectsController@unhide')->name('admin-projects-unhide');

    Route::get('/categories', 'Admin\CategoriesController@index')->name('admin-categories');
    Route::get('/categories/create', 'Admin\CategoriesController@create')->name('admin-categories-create');
    Route::post('/categories/store', 'Admin\CategoriesController@store')->name('admin-categories-store');
    Route::get('/categories/edit/{category}', 'Admin\CategoriesController@edit')->name('admin-categories-edit');
    Route::post('/categories/update/{category}', 'Admin\CategoriesController@update')->name('admin-categories-update');

    Route::get('/project-years', 'Admin\ProjectYearsController@index')->name('admin-project-years');
    Route::get('/project-years/create', 'Admin\ProjectYearsController@create')->name('admin-project-years-create');
    Route::post('/project-years/store', 'Admin\ProjectYearsController@store')->name('admin-project-years-store');
    Route::get('/project-years/edit/{year}', 'Admin\ProjectYearsController@edit')->name('admin-project-years-edit');
    Route::post('/project-years/update/{year}', 'Admin\ProjectYearsController@update')->name('admin-project-years-update');
    Route::get('/project-years/hide/{year}', 'Admin\ProjectYearsController@hide')->name('admin-project-years-hide');
    Route::get('/project-years/publish/{year}', 'Admin\ProjectYearsController@publish')->name('admin-project-years-publish');

    Route::get('/gallery/{id}', 'Admin\GalleryController@getImages')->name('admin-project-gallery');
    Route::post('/gallery/{id}/upload', 'Admin\GalleryController@uploadFile')->name('admin-project-gallery-upload');
    Route::post('/gallery/delete', 'Admin\GalleryController@delete')->name('admin-project-photo-delete');

    Route::get('/settings', 'Admin\SettingsController@index')->name('admin-settings');
    Route::post('/settings/store', 'Admin\SettingsController@store')->name('admin-settings-store');

    Route::get('/team', 'Admin\TeamController@index')->name('admin-team');
    Route::get('/team/create', 'Admin\TeamController@create')->name('admin-team-create');
    Route::post('/team/store', 'Admin\TeamController@store')->name('admin-team-store');
    Route::get('/team/edit/{member}', 'Admin\TeamController@edit')->name('admin-team-edit');
    Route::post('/team/update/{member}', 'Admin\TeamController@update')->name('admin-team-update');
    Route::get('/team/hide/{member}', 'Admin\TeamController@hide')->name('admin-team-hide');
    Route::get('/team/publish/{member}', 'Admin\TeamController@publish')->name('admin-team-publish');
});


Route::get('/', 'LandingPageController@index')->name('landing-page');
Route::get('/about', 'AboutUsController@index')->name('about-us');
Route::get('/about/bio/{member}', 'BioController@index')->name('bio');
Route::get('/projects/{year}', 'ProjectsController@index')->name('projects-filtered');
Route::get('/projects/{year}/{project}', 'ProjectsController@read')->name('projects-read');
Route::get('/project/newsmedia/{new}', 'ProjectsController@new')->name('new-read');
Route::get('/contact-us', 'ContactusController@index')->name('contact-us');
