<?php

Route::name('admin.')
        ->prefix('admin/')
        ->middleware('web', 'auth')
        ->namespace('CodePress\CodeTag\Controllers')
        ->group(function () {
            Route::get('tags/deleted', 'AdminTagsController@deleted')->name('tags.deleted');
            Route::get('tags/deleted/restore/{comment}', 'AdminTagsController@restore')->name('tags.restore');
            Route::resources([
                'tags' => 'AdminTagsController'
            ]);
        });
