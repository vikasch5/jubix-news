<?php

use App\Http\Controllers\Backend\AdsController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\CategoryContoller;
// use App\Http\Controllers\Backend\CategoryContoller;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/category/{catSlug?}/{subCatSlug?}', [FrontendController::class, 'categoryIndex'])->name('category');
Route::get('/news/{slug}', [FrontendController::class, 'newsDetail'])->name('news.detail');
Route::post('/comments/store', [FrontendController::class, 'v'])->name('comments.store');
Route::get('/video/{slug}', [FrontendController::class, 'videoDetail'])->name('video.detail');
Route::get('videos', [FrontendController::class, 'videoList'])->name('videos.list');
Route::get('privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('terms-conditions', [FrontendController::class, 'termsConditions'])->name('terms.conditions');
Route::get('search/{param}/{page?}', [FrontendController::class, 'search'])->name('search');
Route::get('contact-us', [FrontendController::class, 'contactUs'])->name('contact.us');
Route::post('contact-form-store', [FrontendController::class, 'contactUsStore'])->name('contact.store');
Route::get('classified-ads', [FrontendController::class, 'classifiedAds'])->name('classified.ads');
Route::get('live-tv', [FrontendController::class, 'liveTv'])->name('live.tv');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::middleware('auth')->group(function () {
        Route::get('edit-profile', [AuthController::class, 'editProfile'])->name('edit.profile.page');
        Route::post('update-profile_photo', [AuthController::class, 'updateProfilePhoto'])->name('user.updateProfilePhoto');
        Route::post('update-password', [AuthController::class, 'updatePassword'])->name('user.updatePassword');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('category-list', [CategoryContoller::class, 'index'])->name('admin.category.index');
        Route::get('category-add/{id?}', [CategoryContoller::class, 'categoryAddIndex'])->name('admin.category.add');
        Route::post('category-save', [CategoryContoller::class, 'storeOrUpdate'])->name('admin.category.store-or-update');
        Route::post('category-delete', [CategoryContoller::class, 'delete'])->name('admin.category.category');
        Route::get('sub-category-list', [CategoryContoller::class, 'subCategoryIndex'])->name('admin.sub.category.index');
        Route::get('sub-category-add/{id?}', [CategoryContoller::class, 'subCategoryAddIndex'])->name('admin.sub.category.add');
        Route::post('sub-category-save', [CategoryContoller::class, 'subCategoryStorOrUpdate'])->name('admin.sub.category.store-or-update');
        Route::post('sub-category-delete', [CategoryContoller::class, 'deleteSubCategory'])->name('admin.sub.category.delete');

        Route::get('news-list', [NewsController::class, 'index'])->name('admin.news.list');
        Route::get('news-add/{id?}', [NewsController::class, 'newsAddIndex'])->name('admin.news.add');
        Route::post('news-save', [NewsController::class, 'storeOrUpdate'])->name('admin.news.store-or-update');
        Route::post('news-image-remove', [NewsController::class, 'deleteImage'])->name('admin.news.delete-image');
        Route::post('news-delete', [NewsController::class, 'deleteNews'])->name('admin.news.delete');
        Route::get('comment-list', [NewsController::class, 'commentList'])->name('admin.comment.list');
        Route::get('settings/{id?}', [SettingController::class, 'index'])->name('admin.settings');
        Route::post('settings-save', [SettingController::class, 'update'])->name('admin.settings.save');
        Route::get('video-list', [VideoController::class, 'index'])->name('admin.video.list');
        Route::get('video-add/{id?}', [VideoController::class, 'videoAddIndex'])->name('admin.video.add');
        Route::post('video-save', [VideoController::class, 'storeOrUpdate'])->name('admin.video.store-or-update');
        Route::post('video-delete', [VideoController::class, 'delete'])->name('admin.video.delete');

        Route::get('ads-add/{id?}', [AdsController::class, 'addAdsIndex'])->name('admin.ads.add');
        Route::get('ads-list', [AdsController::class, 'index'])->name('admin.ads.list');
        Route::post('ads-save', [AdsController::class, 'storeOrUpdate'])->name('admin.ads.save');
        Route::post('ads-delete', [AdsController::class, 'deleteAds'])->name('admin.ads.delete');
        Route::post('ads-img-delete', [AdsController::class, 'deleteImage'])->name('admin.ads.delete-image');

        Route::get('classified-ads-add/{id?}', [AdsController::class, 'addClassifiedAdsIndex'])->name('admin.classified.ads.add');
        Route::get('classified-ads-list', [AdsController::class, 'ClassifiedIndex'])->name('admin.classified.ads.list');
        Route::post('classified-ads-save', [AdsController::class, 'ClassifiedstoreOrUpdate'])->name('admin.classified.ads.save');
        Route::post('classified-ads-delete', [AdsController::class, 'deleteClassifiedAds'])->name('admin.classified.ads.delete');
        Route::post('classified-ads-img-delete', [AdsController::class, 'deleteClassifiedImage'])->name('admin.classified.ads.delete-image');


        Route::get('/get-subcategories/{category_id?}', [CategoryContoller::class, 'getSubcategories'])->name('admin.get.subcategories');
        Route::get('/run-migrate', function () {
            Artisan::call('migrate', ['--force' => true]);
            return nl2br(Artisan::output());
        });
    });
});
