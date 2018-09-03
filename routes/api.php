<?php

use Illuminate\Http\Request;

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
Route::get('get-question', function (Request $request) {

    $words = \App\Words::select('word', 'definition')->inRandomOrder()->take(5)->get();

    // Choose the correct word
    $correct_answer = $words->first()->toArray();

    $definitions = array_pluck($words, 'definition');
    shuffle($definitions);

    return [
        'word'              => $correct_answer['word'],
        'correctDefinition' => $correct_answer['definition'],
        'definitions'       => $definitions,
    ];
});

Route::get('get-user', function (Request $request) {

    $user = \App\User::select('name', 'score')->where('name', '=', 'aaron')->first();

    return $user;
});

Route::post( 'correct-answer', function( Request $request ) {

    DB::table('users')->whereId( $request->get( 'user_id' ) )->increment('score');

    return [];
} );