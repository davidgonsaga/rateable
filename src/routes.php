<?php

Route::group(['prefix' => 'rateable', 'as' => 'rateable.', 'namespace' => 'Webeleven\\Rateable\\Controllers', 'middleware' => ['rateable.auth']], function () {

    Route::group(['prefix' => 'ratings', 'as' => 'rating.'], function () {
        Route::post('/save', 'RateController@save')->name('save');

        Route::get('/list', 'RateController@getAll')->name('list');
        Route::get('/by-resource/{resource_id}/{resource_type}', 'RateController@getAllByResourceIdAndType');
    });

    Route::group(['prefix' => 'comments', 'as' => 'comment.'], function () {
        Route::post('/save', 'CommentController@save')->name('save');

        Route::post('/{comment_id}/increase_positives', 'VoteController@increasePositiveVotes');
        Route::post('/{comment_id}/decrease_positives', 'VoteController@decreasePositiveVotes');
        Route::post('/{comment_id}/increase_negatives', 'VoteController@increaseNegativeVotes');
        Route::post('/{comment_id}/decrease_negatives', 'VoteController@decreaseNegativeVotes');

        Route::get('/find/{comment_id}', 'CommentController@find');
        Route::get('/list', 'CommentController@getAll')->name('list');
        Route::get('/by-resource/{resource_id}/{resource_type}', 'CommentController@getAllByResourceIdAndType');
        Route::get('/by-resource/{resource_id}/{resource_type}/published', 'CommentController@getPublishedByResourceIdAndType');
        Route::get('/by-resource/{resource_id}/{resource_type}/unpublished', 'CommentController@getUnpublishedByResourceIdAndType');
    });

    Route::group(['prefix' => 'averages', 'as' => 'averages.'], function () {
        Route::get('/all', 'RateAverageController@getOfAllRates');
        Route::get('/by-resource/{resource_id}/{resource_type}', 'RateAverageController@getByResourceIdAndType');
    });

    Route::group(['prefix' => 'points', 'as' => 'points.'], function () {
        Route::get('/by-resource/{resource_id}/{resource_type}', 'RateController@getRatePointsDiscriminated');
    });
});