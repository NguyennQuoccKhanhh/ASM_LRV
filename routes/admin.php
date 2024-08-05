<?php

use App\Http\Controllers\Admin\CatelogueController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth', IsAdmin::class])
    ->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/info', function () {
            return view('admin.info');
        })->name('info');


        Route::prefix('compoents')
            ->as('compoents.')
            ->group(function () {

                Route::prefix('catelogues')
                    ->as('catelogues.')
                    ->group(function () {
                        Route::get('/', [CatelogueController::class, 'index'])->name('index');
                        Route::get('create', [CatelogueController::class, 'create'])->name('create');
                        Route::post('store', [CatelogueController::class, 'store'])->name('store');
                        Route::get('show/{id}', [CatelogueController::class, 'show'])->name('show');
                        Route::get('{id}/edit', [CatelogueController::class, 'edit'])->name('edit');
                        Route::put('{id}/update', [CatelogueController::class, 'update'])->name('update');
                        Route::get('{id}/destroy', [CatelogueController::class, 'destroy'])->name('destroy');
                        Route::get('trash_can', [CatelogueController::class, 'trash_can'])->name('trash_can');
                        Route::get('{id}/restore', [CatelogueController::class, 'restore'])->name('restore');
                    });

                Route::prefix('comments')
                    ->as('comments.')
                    ->group(function () {
                        Route::get('/', [CommentController::class, 'index'])->name('index');
                        Route::get('{id}/destroy', [CommentController::class, 'destroy'])->name('destroy');
                        Route::get('trash_can', [CommentController::class, 'trash_can'])->name('trash_can');
                        Route::get('{id}/restore', [CommentController::class, 'restore'])->name('restore');
                    });

                Route::prefix('users')
                    ->as('users.')
                    ->group(function () {
                        Route::get('/', [UserController::class, 'index'])->name('index');
                        Route::get('create', [UserController::class, 'create'])->name('create');
                        Route::get('{id}/destroy', [UserController::class, 'destroy'])->name('destroy');
                        Route::get('trash_can', [UserController::class, 'trash_can'])->name('trash_can');
                        Route::get('{id}/restore', [UserController::class, 'restore'])->name('restore');
                    });

                Route::prefix('posts')
                    ->as('posts.')
                    ->group(function () {
                        Route::delete('{slug}/destroy', [PostController::class, 'destroy'])->name('destroy');
                        Route::get('trash_can', [PostController::class, 'trash_can'])->name('trash_can');
                        Route::get('{id}/restore', [PostController::class, 'restore'])->name('restore');
                    });
                Route::resource('posts', PostController::class)->parameters([
                    'posts' => 'slug'
                ]);

            });

    });
