<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\CategoryContoller;
// use App\Http\Controllers\Backend\CategoryContoller;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/category/{catSlug?}/{subCatSlug?}', [FrontendController::class, 'categoryIndex'])->name('category');
Route::get('/news/{slug}', [FrontendController::class, 'newsDetail'])->name('news.detail');
Route::post('/comments/store', [FrontendController::class, 'commentStore'])->name('comments.store');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::middleware('auth')->group(function () {
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


        Route::get('/get-subcategories/{category_id?}', [CategoryContoller::class, 'getSubcategories'])->name('admin.get.subcategories');
    });
});
