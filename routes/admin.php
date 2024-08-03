<?php

use App\Http\Controllers\Admin\CatelogueController;
use App\Http\Controllers\Admin\PostController;
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

                Route::prefix('posts')
                    ->as('posts.')
                    ->group(function () {
                        Route::get('trash_can', [PostController::class, 'trash_can'])->name('trash_can');
                        Route::get('{id}/restore', [PostController::class, 'restore'])->name('restore');
                    });
                Route::resource('posts', PostController::class);

            });

    });
