<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('user_login',[App\Http\Controllers\Api\user\userscontroller::class,'user_login']);

Route::group(['middleware' => ['auth:sanctum']], function() {
Route::get('user_logout',[App\Http\Controllers\Api\user\userscontroller::class,'user_logout']);
});
Route::post('role_create',[App\Http\Controllers\Api\role\rolecontroller::class,'role_create']);
Route::get('role_list',[App\Http\Controllers\Api\role\rolecontroller::class,'role_list']);
Route::post('role_delete',[App\Http\Controllers\Api\role\rolecontroller::class,'role_delete']);
Route::post('user_insert',[App\Http\Controllers\Api\user\userscontroller::class,'user_insert']);
Route::get('user_list',[App\Http\Controllers\Api\user\userscontroller::class,'user_list']);
Route::post('user_delete',[App\Http\Controllers\Api\user\userscontroller::class,'user_delete']);
Route::post('system_setting_create',[App\Http\Controllers\Api\system_settings\system_setting::class,'system_setting_create']);
Route::get('system_setting_list',[App\Http\Controllers\Api\system_settings\system_setting::class,'system_setting_list']);
Route::post('system_setting_delete',[App\Http\Controllers\Api\system_settings\system_setting::class,'system_setting_delete']);
Route::post('course_create',[App\Http\Controllers\Api\course\coursecontroller::class,'course_create']);
Route::get('course_list',[App\Http\Controllers\Api\course\coursecontroller::class,'course_list']);
Route::post('course_delete',[App\Http\Controllers\Api\course\coursecontroller::class,'course_delete']);
Route::post('category_create',[App\Http\Controllers\Api\category\categorycontroller::class,'category_create']);
Route::get('category_show',[App\Http\Controllers\Api\category\categorycontroller::class,'category_show']);
Route::post('category_delete',[App\Http\Controllers\Api\category\categorycontroller::class,'category_delete']);
Route::post('language_create',[App\Http\Controllers\Api\language\languagecontroller::class,'language_create']);
Route::get('language_list',[App\Http\Controllers\Api\language\languagecontroller::class,'language_list']);
Route::post('language_delete',[App\Http\Controllers\Api\language\languagecontroller::class,'language_delete']);
Route::post('main_category_store',[App\Http\Controllers\Api\main_category\main_categorycontroller::class,'main_category_store']);
Route::get('main_category_list',[App\Http\Controllers\Api\main_category\main_categorycontroller::class,'main_category_list']);
Route::post('main_category_delete',[App\Http\Controllers\Api\main_category\main_categorycontroller::class,'main_category_delete']);
Route::post('sub_category_store',[App\Http\Controllers\Api\sub_category\sub_categorycontroller::class,'sub_category_store']);
Route::get('sub_category_list',[App\Http\Controllers\Api\sub_category\sub_categorycontroller::class,'sub_category_list']);
Route::post('sub_category_delete',[App\Http\Controllers\Api\sub_category\sub_categorycontroller::class,'sub_category_delete']);
Route::post('child_category_store',[App\Http\Controllers\Api\child_category\child_categorycontroller::class,'child_category_store']);
Route::get('child_category_list',[App\Http\Controllers\Api\child_category\child_categorycontroller::class,'child_category_list']);
Route::post('child_category_delete',[App\Http\Controllers\Api\child_category\child_categorycontroller::class,'child_category_delete']);
Route::post('lession_store',[App\Http\Controllers\Api\lession\lessioncontroller::class,'lession_store']);
Route::get('lession_list',[App\Http\Controllers\Api\lession\lessioncontroller::class,'lession_list']);
Route::post('lession_delete',[App\Http\Controllers\Api\lession\lessioncontroller::class,'lession_delete']);
Route::post('module_store',[App\Http\Controllers\Api\modules\modulecontroller::class,'module_store']);
Route::get('module_list',[App\Http\Controllers\Api\modules\modulecontroller::class,'module_list']);
Route::post('module_delete',[App\Http\Controllers\Api\modules\modulecontroller::class,'module_delete']);
Route::post('teacher_store',[App\Http\Controllers\Api\teacher\teachercontroller::class,'teacher_store']);
Route::get('teacher_list',[App\Http\Controllers\Api\teacher\teachercontroller::class,'teacher_list']);
Route::post('teacher_delete',[App\Http\Controllers\Api\teacher\teachercontroller::class,'teacher_delete']);
Route::post('subject_store',[App\Http\Controllers\Api\subject\subjectcontroller::class,'subject_store']);
Route::get('subject_list',[App\Http\Controllers\Api\subject\subjectcontroller::class,'subject_list']);
Route::post('subject_delete',[App\Http\Controllers\Api\subject\subjectcontroller::class,'subject_delete']);
Route::post('course_video_store',[App\Http\Controllers\Api\add_lecture\coursevideo::class,'course_video_store']);
Route::get('course_video_show',[App\Http\Controllers\Api\add_lecture\coursevideo::class,'course_video_show']);
Route::post('course_video_delete',[App\Http\Controllers\Api\add_lecture\coursevideo::class,'course_video_delete']);
Route::post('video_store',[App\Http\Controllers\Api\add_lecture\videocontroller::class,'video_store']);
Route::get('video_show',[App\Http\Controllers\Api\add_lecture\videocontroller::class,'video_show']);
Route::post('video_delete',[App\Http\Controllers\Api\add_lecture\videocontroller::class,'video_delete']);
Route::post('audio_store',[App\Http\Controllers\Api\add_lecture\audiocontroller::class,'audio_store']);
Route::get('audio_show',[App\Http\Controllers\Api\add_lecture\audiocontroller::class,'audio_show']);
Route::post('audio_delete',[App\Http\Controllers\Api\add_lecture\audiocontroller::class,'audio_delete']);
Route::post('document_store',[App\Http\Controllers\Api\add_lecture\documentcontroller::class,'document_store']);
Route::get('document_show',[App\Http\Controllers\Api\add_lecture\documentcontroller::class,'document_show']);
Route::post('document_delete',[App\Http\Controllers\Api\add_lecture\documentcontroller::class,'document_delete']);
Route::post('text_store',[App\Http\Controllers\Api\add_lecture\textcontroller::class,'text_store']);
Route::get('text_show',[App\Http\Controllers\Api\add_lecture\textcontroller::class,'text_show']);
Route::post('text_delete',[App\Http\Controllers\Api\add_lecture\textcontroller::class,'text_delete']);
Route::post('image_store',[App\Http\Controllers\Api\add_lecture\imagecontroller::class,'image_store']);
Route::get('image_show',[App\Http\Controllers\Api\add_lecture\imagecontroller::class,'image_show']);
Route::post('image_delete',[App\Http\Controllers\Api\add_lecture\imagecontroller::class,'image_delete']);
Route::post('other_video_store',[App\Http\Controllers\Api\add_lecture\othercontroller::class,'other_video_store']);
Route::get('other_video_show',[App\Http\Controllers\Api\add_lecture\othercontroller::class,'other_video_show']);
Route::post('other_video_delete',[App\Http\Controllers\Api\add_lecture\othercontroller::class,'other_video_delete']);
Route::post('assessment_store',[App\Http\Controllers\Api\add_assessment\assessmentcontroller::class,'assessment_store']);
Route::get('assessment_show',[App\Http\Controllers\Api\add_assessment\assessmentcontroller::class,'assessment_show']);
Route::post('assessment_delete',[App\Http\Controllers\Api\add_assessment\assessmentcontroller::class,'assessment_delete']);
Route::post('homework_store',[App\Http\Controllers\Api\add_homework\homeworkcontroller::class,'homework_store']);
Route::get('homework_show',[App\Http\Controllers\Api\add_homework\homeworkcontroller::class,'homework_show']);
Route::post('homework_delete',[App\Http\Controllers\Api\add_homework\homeworkcontroller::class,'homework_delete']);
Route::post('text_homework_store',[App\Http\Controllers\Api\add_homework\textcontroller::class,'text_homework_store']);
Route::get('text_homework_show',[App\Http\Controllers\Api\add_homework\textcontroller::class,'text_homework_show']);
Route::post('text_homework_delete',[App\Http\Controllers\Api\add_homework\textcontroller::class,'text_homework_delete']);
Route::post('multiple_choice_store',[App\Http\Controllers\Api\add_homework\multiplecontroller::class,'multiple_choice_store']);
Route::get('multiple_choice_show',[App\Http\Controllers\Api\add_homework\multiplecontroller::class,'multiple_choice_show']);
Route::post('multiple_choice_delete',[App\Http\Controllers\Api\add_homework\multiplecontroller::class,'multiple_choice_delete']);
Route::post('document_homework_store',[App\Http\Controllers\Api\add_homework\documentcontroller::class,'document_homework_store']);
Route::get('document_homework_show',[App\Http\Controllers\Api\add_homework\documentcontroller::class,'document_homework_show']);
Route::post('document_homework_delete',[App\Http\Controllers\Api\add_homework\documentcontroller::class,'document_homework_delete']);
Route::post('video_homework_store',[App\Http\Controllers\Api\add_homework\videocontroller::class,'video_homework_store']);
Route::get('video_homework_show',[App\Http\Controllers\Api\add_homework\videocontroller::class,'video_homework_show']);
Route::post('video_homework_delete',[App\Http\Controllers\Api\add_homework\videocontroller::class,'video_homework_delete']);
Route::post('smtp_setting_store',[App\Http\Controllers\Api\smtp_setting\smtpcontroller::class,'smtp_setting_store']);
Route::get('smtp_setting_list',[App\Http\Controllers\Api\smtp_setting\smtpcontroller::class,'smtp_setting_list']);
Route::post('smtp_setting_delete',[App\Http\Controllers\Api\smtp_setting\smtpcontroller::class,'smtp_setting_delete']);
Route::post('site_setting_store',[App\Http\Controllers\Api\site_settings\sitecontroller::class,'site_setting_store']);
Route::get('site_setting_list',[App\Http\Controllers\Api\site_settings\sitecontroller::class,'site_setting_list']);
Route::post('site_setting_delete',[App\Http\Controllers\Api\site_settings\sitecontroller::class,'site_setting_delete']);
Route::post('permission_store',[App\Http\Controllers\Api\permission\permisioncontroller::class,'permission_store']);
Route::get('permission_list',[App\Http\Controllers\Api\permission\permisioncontroller::class,'permission_list']);
Route::post('permission_delete',[App\Http\Controllers\Api\permission\permisioncontroller::class,'permission_delete']);
Route::post('course_filter',[App\Http\Controllers\Api\filter\filtercontroller::class,'course_filter']);
Route::post('user_filter',[App\Http\Controllers\Api\filter\filtercontroller::class,'user_filter']);
Route::post('main_category_filter',[App\Http\Controllers\Api\filter\filtercontroller::class,'main_category_filter']);
Route::post('sub_category_filter',[App\Http\Controllers\Api\filter\filtercontroller::class,'sub_category_filter']);
Route::post('child_category_filter',[App\Http\Controllers\Api\filter\filtercontroller::class,'child_category_filter']);
Route::post('subject_filter',[App\Http\Controllers\Api\filter\filtercontroller::class,'subject_filter']);
Route::post('modules_filter',[App\Http\Controllers\Api\filter\filtercontroller::class,'modules_filter']);
Route::post('lession_filter',[App\Http\Controllers\Api\filter\filtercontroller::class,'lession_filter']);

////////////////forntend....................................
Route::post('admin_signup',[App\Http\Controllers\Api\admin\admincontroller::class,'admin_signup']);
Route::post('admin_login',[App\Http\Controllers\Api\admin\admincontroller::class,'admin_login']);
// Route::group(['middleware' => ['CheckScopes']], function() {
Route::get('admin_logout',[App\Http\Controllers\Api\admin\admincontroller::class,'admin_logout']);
// });
Route::post('admin_forget',[App\Http\Controllers\Api\forgot\forgotpasswordcontroller::class,'admin_forget']);
Route::get('popular_course_list',[App\Http\Controllers\Api\course\popularcourse::class,'popular_course_list']);
Route::get('top_category_list',[App\Http\Controllers\Api\main_category\topcategory::class,'top_category_list']);
Route::get('latest_course_list',[App\Http\Controllers\Api\course\latestcontroller::class,'latest_course_list']);
Route::post('course_type_filter',[App\Http\Controllers\Api\filter\filtercontroller::class,'course_type_filter']);
Route::post('review_store',[App\Http\Controllers\Api\review\reviewcontroller::class,'review_store']);
Route::get('review_list',[App\Http\Controllers\Api\review\reviewcontroller::class,'review_list']);
Route::post('review_delete',[App\Http\Controllers\Api\review\reviewcontroller::class,'review_delete']);
