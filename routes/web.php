<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// ---------------------------------------------------------------------------------------------

// Web
Route::get('', function () {
    return view('base');
});

// ---------------------------------------------------------------------------------------------

// Custom
// $path = __DIR__.'/custom';
// $files = File::allFiles($path);
// foreach ($files as $file) {
//     if (! file_exists($file)) {
//         throw new FileNotFoundException('File ['.$file.'] the route not found.');
//     }
//     require_once $file;
// }

// ---------------------------------------------------------------------------------------------

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    // Login
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@index']);
    Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@authenticate']);

    // Logout
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LogoutController@logout']);

    // Esqueci minha senha
    Route::get('forget-password', ['as' => 'forget_password', 'uses' => 'Auth\ForgetPasswordController@index']);
    Route::get('password/reset/{token?}', ['as' => 'password.reset', 'uses' => 'Auth\PasswordController@showResetForm']);
    Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\PasswordController@sendResetLinkEmail']);
    Route::post('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\PasswordController@reset']);
});

// Auth
// $path = __DIR__.'/auth';
// $files = File::allFiles($path);
// foreach ($files as $file) {
//     if (! file_exists($file)) {
//         throw new FileNotFoundException('File ['.$file.'] the route not found.');
//     }
//     require_once $file;
// }
// $path = base_path('routes/auth');
// $files = File::allFiles($path);
// foreach ($files as $file) {
//     if (! file_exists($file)) {
//         throw new FileNotFoundException('File ['.$file.'] the route not found.');
//     }
// }
    // include_once base_path('routes/auth/auth.php');

// ---------------------------------------------------------------------------------------------

// Admin
Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    
    Route::get('/dashboard', ['as' => 'index', 'uses' => 'Admin\DashboardController@index']);

    // $path = __DIR__.'/admin';
    // $files = File::allFiles($path);
    // foreach ($files as $file) {
    //     if (! file_exists($file)) {
    //         throw new FileNotFoundException('File ['.$file.'] the route not found.');
    //     }
    //     require_once $file;
    // }
    




    // Mailbox
    Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {

        // --------------------------------------------------------------------------------------------

        // Category
        Route::group(['prefix' => 'categorys', 'as' => 'categorys.'], function () {
            Route::get('list', [
                'as' => 'list',
                'uses' => 'Admin\Blog\CategorysController@index',
            ]);

            Route::get('create', [
                'as' => 'create',
                'uses' => 'Admin\Blog\CategorysController@create',
            ]);

            Route::get('edit/{id}', [
                'as' => 'edit',
                'uses' => 'Admin\Blog\CategorysController@edit',
            ])->where('id', '[0-9]+');

            Route::post('store', [
                'as' => 'store',
                'uses' => 'Admin\Blog\CategorysController@store',
            ]);

            Route::post('update/{id}', [
                'as' => 'update',
                'uses' => 'Admin\Blog\CategorysController@update',
            ])->where('id', '[0-9]+');

            Route::post('destroy', [
                'as' => 'destroy',
                'uses' => 'Admin\Blog\CategorysController@destroy',
            ]);
        });

        // --------------------------------------------------------------------------------------------

        // Posts
        Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
            Route::get('list', [
                'as' => 'list',
                'uses' => 'Admin\Blog\PostsController@index',
            ]);

            Route::get('create', [
                'as' => 'create',
                'uses' => 'Admin\Blog\PostsController@create',
            ]);

            Route::get('edit/{id}', [
                'as' => 'edit',
                'uses' => 'Admin\Blog\PostsController@edit',
            ])->where('id', '[0-9]+');

            Route::post('store', [
                'as' => 'store',
                'uses' => 'Admin\Blog\PostsController@store',
            ]);

            Route::post('update/{id}', [
                'as' => 'update',
                'uses' => 'Admin\Blog\PostsController@update',
            ])->where('id', '[0-9]+');

            Route::post('destroy', [
                'as' => 'destroy',
                'uses' => 'Admin\Blog\PostsController@destroy',
            ]);

            Route::any('upload/{id?}', [
                'as' => 'upload',
                'uses' => 'Admin\Blog\PostsController@upload',
            ]);
        });

        // --------------------------------------------------------------------------------------------

        // Posts
        Route::group(['prefix' => 'comments', 'as' => 'comments.'], function () {
            Route::get('list', [
                'as' => 'list',
                'uses' => 'Admin\Blog\CommentsController@index',
            ]);

            Route::get('aproved', [
                'as' => 'aproved',
                'uses' => 'Admin\Blog\CommentsController@aproved',
            ]);

            Route::get('reproved', [
                'as' => 'reproved',
                'uses' => 'Admin\Blog\CommentsController@reproved',
            ]);

            Route::get('aprove/{id}', [
                'as' => 'aprove',
                'uses' => 'Admin\Blog\CommentsController@aprove',
            ]);

            Route::get('reprove/{id}', [
                'as' => 'reprove',
                'uses' => 'Admin\Blog\CommentsController@reprove',
            ]);
        });

        // --------------------------------------------------------------------------------------------
    });



    // Gallery
    Route::group(['prefix' => 'gallerys', 'as' => 'gallerys.'], function () {

    // --------------------------------------------------------------------------------------------
        Route::get('list', [
            'as' => 'list',
            'uses' => 'Admin\Gallerys\GallerysController@index',
        ]);

        Route::get('create', [
            'as' => 'create',
            'uses' => 'Admin\Gallerys\GallerysController@create',
        ]);

        Route::get('edit/{id}', [
            'as' => 'edit',
            'uses' => 'Admin\Gallerys\GallerysController@edit',
        ])->where('id', '[0-9]+');

        Route::post('store', [
            'as' => 'store',
            'uses' => 'Admin\Gallerys\GallerysController@store',
        ]);

        Route::post('update/{id}', [
            'as' => 'update',
            'uses' => 'Admin\Gallerys\GallerysController@update',
        ])->where('id', '[0-9]+');

        Route::post('destroy', [
            'as' => 'destroy',
            'uses' => 'Admin\Gallerys\GallerysController@destroy',
        ]);

        Route::any('upload/{id?}', [
            'as' => 'upload',
            'uses' => 'Admin\Gallerys\GallerysController@upload',
        ]);

        // --------------------------------------------------------------------------------------------
    });



    // Mailbox
    Route::group(['prefix' => 'mailbox', 'as' => 'mailbox.'], function () {
        Route::get('inbox', [
            'as' => 'inbox',
            'uses' => 'Admin\Mailbox\InboxController@index',
        ]);

        Route::get('trash', [
            'as' => 'trash',
            'uses' => 'Admin\Mailbox\TrashController@index',
        ]);

        Route::post('trash/{id}', [
            'as' => 'trash_in',
            'uses' => 'Admin\Mailbox\TrashController@trash',
        ])->where('id', '[0-9]+');

        Route::get('archive', [
            'as' => 'archive',
            'uses' => 'Admin\Mailbox\ArchiveController@index',
        ]);

        Route::post('archive/{id}', [
            'as' => 'archive_in',
            'uses' => 'Admin\Mailbox\ArchiveController@archive',
        ])->where('id', '[0-9]+');

        Route::get('message/{id}', [
            'as' => 'message',
            'uses' => 'Admin\Mailbox\MessageController@index',
        ])->where('id', '[0-9]+');

        Route::post('delete', [
            'as' => 'delete',
            'uses' => 'Admin\Mailbox\DeleteController@destroy',
        ]);
    });



    // Pages
    Route::group(['prefix' => 'pages', 'as' => 'pages.'], function () {

        // --------------------------------------------------------------------------------------------

        // Category
        Route::group(['prefix' => 'categorys', 'as' => 'categorys.'], function () {
            Route::get('list', [
                'as' => 'list',
                'uses' => 'Admin\Pages\CategorysController@index',
            ]);

            Route::get('create', [
                'as' => 'create',
                'uses' => 'Admin\Pages\CategorysController@create',
            ]);

            Route::get('edit/{id}', [
                'as' => 'edit',
                'uses' => 'Admin\Pages\CategorysController@edit',
            ])->where('id', '[0-9]+');

            Route::post('store', [
                'as' => 'store',
                'uses' => 'Admin\Pages\CategorysController@store',
            ]);

            Route::post('update/{id}', [
                'as' => 'update',
                'uses' => 'Admin\Pages\CategorysController@update',
            ])->where('id', '[0-9]+');

            Route::post('destroy', [
                'as' => 'destroy',
                'uses' => 'Admin\Pages\CategorysController@destroy',
            ]);
        });

        // --------------------------------------------------------------------------------------------

        // Contents
        Route::group(['prefix' => 'contents', 'as' => 'contents.'], function () {
            Route::get('list', [
                'as' => 'list',
                'uses' => 'Admin\Pages\ContentsController@index',
            ]);

            Route::get('create', [
                'as' => 'create',
                'uses' => 'Admin\Pages\ContentsController@create',
            ]);

            Route::get('edit/{id}', [
                'as' => 'edit',
                'uses' => 'Admin\Pages\ContentsController@edit',
            ])->where('id', '[0-9]+');

            Route::post('store', [
                'as' => 'store',
                'uses' => 'Admin\Pages\ContentsController@store',
            ]);

            Route::post('update/{id}', [
                'as' => 'update',
                'uses' => 'Admin\Pages\ContentsController@update',
            ])->where('id', '[0-9]+');

            Route::post('destroy', [
                'as' => 'destroy',
                'uses' => 'Admin\Pages\ContentsController@destroy',
            ]);
        });

        // --------------------------------------------------------------------------------------------
    });


    // Products
    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {

        // --------------------------------------------------------------------------------------------

        // Category
        Route::group(['prefix' => 'categorys', 'as' => 'categorys.'], function () {
            Route::get('list', [
                'as' => 'list',
                'uses' => 'Admin\Products\CategorysController@index',
            ]);

            Route::get('create', [
                'as' => 'create',
                'uses' => 'Admin\Products\CategorysController@create',
            ]);

            Route::get('edit/{id}', [
                'as' => 'edit',
                'uses' => 'Admin\Products\CategorysController@edit',
            ])->where('id', '[0-9]+');

            Route::post('store', [
                'as' => 'store',
                'uses' => 'Admin\Products\CategorysController@store',
            ]);

            Route::post('update/{id}', [
                'as' => 'update',
                'uses' => 'Admin\Products\CategorysController@update',
            ])->where('id', '[0-9]+');

            Route::post('destroy', [
                'as' => 'destroy',
                'uses' => 'Admin\Products\CategorysController@destroy',
            ]);
        });


        // --------------------------------------------------------------------------------------------


        // Contents
        Route::group(['prefix' => 'contents', 'as' => 'contents.'], function () {
            Route::get('list', [
                'as' => 'list',
                'uses' => 'Admin\Products\ContentsController@index',
            ]);

            Route::get('create', [
                'as' => 'create',
                'uses' => 'Admin\Products\ContentsController@create',
            ]);

            Route::get('edit/{id}', [
                'as' => 'edit',
                'uses' => 'Admin\Products\ContentsController@edit',
            ])->where('id', '[0-9]+');

            Route::post('store', [
                'as' => 'store',
                'uses' => 'Admin\Products\ContentsController@store',
            ]);

            Route::post('update/{id}', [
                'as' => 'update',
                'uses' => 'Admin\Products\ContentsController@update',
            ])->where('id', '[0-9]+');

            Route::post('destroy', [
                'as' => 'destroy',
                'uses' => 'Admin\Products\ContentsController@destroy',
            ]);

            Route::any('upload/{id?}', [
                'as' => 'upload',
                'uses' => 'Admin\Products\ContentsController@upload',
            ]);
        });

        // --------------------------------------------------------------------------------------------
    });



    // Settings
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {

        // --------------------------------------------------------------------------------------------

        Route::get('', [
            'as' => 'profile',
            'uses' => 'Admin\Profile\ProfileController@index',
        ]);

        Route::post('update', [
            'as' => 'update',
            'uses' => 'Admin\Profile\ProfileController@password',
        ]);

        // --------------------------------------------------------------------------------------------
    });



    // Mailbox
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('list', [
            'as' => 'list',
            'uses' => 'Admin\Users\UsersController@index',
        ]);

        Route::get('create', [
            'as' => 'create',
            'uses' => 'Admin\Users\UsersController@create',
        ]);

        Route::get('edit/{id}', [
            'as' => 'edit',
            'uses' => 'Admin\Users\UsersController@edit',
        ])->where('id', '[0-9]+');

        Route::post('store', [
            'as' => 'store',
            'uses' => 'Admin\Users\UsersController@store',
        ]);

        Route::post('update/{id}', [
            'as' => 'update',
            'uses' => 'Admin\Users\UsersController@update',
        ])->where('id', '[0-9]+');

        Route::post('destroy', [
            'as' => 'destroy',
            'uses' => 'Admin\Users\UsersController@destroy',
        ]);
    });




});

// ---------------------------------------------------------------------------------------------
