<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonationController;
use App\Models\Campaign;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/register', function () {
    return view('register');
})->middleware('activeUser');

Route::get('/login', function () {
    return view('login');
})->middleware('activeUser');

Route::get('/logout', function () {
    return view('login');
})->middleware('activeUser');


Route::get('/create-campaign', function () {
    return view('create-campaign');
})->middleware('redirectCreateCampaign');


Route::get('/create-new-campaign', function () {
    return view('create-campaign');
});


Route::post('/create-user', [UserController::class, 'createUser']);
Route::post('/login-user', [UserController::class, 'login']);
Route::get('/user-profile/{user_id}', [UserController::class, 'userProfile']);
Route::post('/create-campaign', [CampaignController::class, 'create']);
Route::get('/all-campaigns', [CampaignController::class, 'index']);
Route::get('/my-campaigns', [CampaignController::class, 'myCampaigns']);
Route::get('/edit-campaign/{id}', [CampaignController::class, 'editCampaign']);
Route::post('/update-campaign/{id}', [CampaignController::class, 'updateCampaign']);
Route::post('/create-donation/{id}', [DonationController::class, 'donate']);
Route::get('/donate/{id}', [DonationController::class, 'makeDonation']);
Route::get('/donations-response', [DonationController::class, 'donationResponse']);
Route::post('/save-donation/{transaction_id}', [DonationController::class, 'saveDonation']);