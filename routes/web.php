<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// Settings
Route::get('settings', 'UserController@settings')->name('settings');
Route::post('changePassword', 'UserController@changePassword')->name('changePassword');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Members
Route::get('members', 'MemberController@index')->name('members');
Route::get('member/{id}', 'MemberController@show')->name('member');
Route::post('addMember', 'MemberController@store')->name('addMember');
Route::post('addMembersFile', 'MemberController@storeFromFile')->name('addMembersFile');
Route::post('deleteMember', 'MemberController@delete')->name('deleteMember');

// Mailing lists
Route::get('mailing_lists', 'ListController@index')->name('mailing_lists');
Route::get('list/{id}', 'ListController@show')->name('list');
Route::post('addList', 'ListController@store')->name('addList');
Route::post('deleteList', 'ListController@delete')->name('deleteList');
Route::post('deleteListFull', 'ListController@deleteFull')->name('deleteListFull');

Route::post('addListMember', 'ListController@addMember')->name('addListMember');
Route::post('addListMembersFile', 'ListController@addFromFile')->name('addListMembersFile');
Route::post('deleteListMember', 'ListController@deleteMember')->name('deleteListMember');

// Templates
Route::get('templates', 'TemplateController@index')->name('templates');
Route::get('template/{id}', 'TemplateController@show')->name('template');
Route::post('addTemplate', 'TemplateController@store')->name('addTemplate');
Route::post('deleteTemplate', 'TemplateController@delete')->name('deleteTemplate');
Route::post('editTemplate', 'TemplateController@edit')->name('editTemplate');

// Campaigns
Route::get('campaigns', 'CampaignController@index')->name('campaigns');
Route::get('campaign/{id}', 'CampaignController@show')->name('campaign');
Route::post('addCampaign', 'CampaignController@store')->name('addCampaign');
Route::post('deleteCampaign', 'CampaignController@delete')->name('deleteCampaign');
Route::post('editCampaign', 'CampaignController@edit')->name('editCampaign');
Route::post('campaignStatus', 'CampaignController@status')->name('campaignStatus');