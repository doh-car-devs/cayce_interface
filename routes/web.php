<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/test/db/{id?}/{date?}/{month?}/{year?}', 'SystemAdminController@downloadBio')->name('db');
Route::get('/', 'Auth\LoginController@showLoginForm')->name('main');
Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/HDF', 'RequestsController@showForm')->name('HDF');
Route::get('/hdf', 'RequestsController@showForm')->name('hdf');
Route::post('/HDF', 'RequestsController@submitForm')->name('HDF.submit');
Route::get('/HDF/qrScan/{id?}/{first?}/{last?}/{add?}/{num?}', 'RequestsController@qrScan')->name('HDF.qrScan');
Route::get('/HDF-done', 'RequestsController@success')->name('HDF-done');
Route::group(['middleware' => ['HDF']], function() {
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/portalpipeline', function(){
        return view('system_admin.pipeline');
    })->name('portalpipeline');

    Route::get('/profiling', function(){
        return view('_interface.profiling');
    })->name('profiling');
    Route::post('/profiling', 'RequestsController@profiling')->name('profiling-store');
});

	/*
	|
	|--------------------------------------------------------------------------
	|  Authentication Routes
	|  Authentication Routes
	|  Authentication Routes
	|--------------------------------------------------------------------------
	|
	|
	*/

	// Authentication Routes...
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login');
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('logmeout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logmeout');

    Route::get('/login-test', function(){
        return view('auth.login-test');
    })->name('profiling');
	// Registration Routes...
	// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
	// Route::post('register', 'Auth\RegisterController@register');

	// Password Reset Routes...
	// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	// Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

	// Confirm Password (added in v6.2)
	// Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
	// Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

	// Email Verification Routes...
	// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
	// Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify'); // v6.x
	// Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

	/*
	|
	|--------------------------------------------------------------------------
	|--------------------------------------------------------------------------
	|  Activities
	|
	|  1. Work Financial Plan
	|  2. Project Procurement Management Plan
	|
	|--------------------------------------------------------------------------
	|--------------------------------------------------------------------------
	|
	|
	*/

	/*
	|
	|--------------------------------------------------------------------------
	|  Work Financial Plan Routes
	|--------------------------------------------------------------------------
	|
	|
	*/
	Route::group(['middleware' => ['WFP','auth','LinkCheck'], 'prefix' => 'wfp', 'as' => 'wfp'], function() {
		// Users
		Route::get('/index/{entries?}' ,  'API\WFPController@index')->name('.index');
		Route::get('/supplemental/{entries?}' ,  'API\WFPController@supplelmental_wfp_index')->name('.supplelmental_wfp_index');
		//Division Head
		Route::group(['prefix' => 'manage', 'middleware' =>'DivisionHead', 'as' => '.manage'], function() {
			Route::get('/division' , 'API\WFPController@division')->name('.division');
		});

	});

	/*
	|
	|--------------------------------------------------------------------------
	|  Project Procurement Management Plan Routes
	|--------------------------------------------------------------------------
	|
	|
	*/
	// linkchcek ADDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD
	// These routes are not protected by linkCheck middleware
	Route::group(['middleware' => ['PPMP','auth'], 'prefix' => 'ppmp', 'as' => 'ppmp'], function() {
		// Index of Creating PPMP included in WFP page
		Route::get('/index' ,  'API\PPMPController@index')->name('.index');
		Route::get('/supplemental/{entries?}' ,  'API\PPMPController@supplelmental_ppmp_index')->name('.supplelmental_ppmp');

	});

	/*
	|
	|--------------------------------------------------------------------------
	|  Features Routes
    |   *Connecting to an external API
    |
	|  1. Inventory Controller
	|--------------------------------------------------------------------------
	|
	|
	*/
	Route::group(['middleware' => ['auth','LinkCheck']], function() {

		// Inventory Controller
		// Inventory Controller
		Route::group(['prefix' => 'inv', 'as' => 'inv'], function() {
			Route::get('/index' , 'API\InventoryController@index')->name('.index');
			Route::get('twg/index' , 'API\InventoryController@twgIndex')->name('.twg.index');
		});
	});


	/*
	|
	|--------------------------------------------------------------------------
	|--------------------------------------------------------------------------
	|  Section Protected Routes with LinkCheck®
	|
	|  1. System Administrator
	|  2. Procurement Controller
	|  3. Budget Controller
	|  3. Bids and Awards Controller
	|
	|--------------------------------------------------------------------------
	|--------------------------------------------------------------------------
	|
	|
    */
    // Route::resource('employees', 'UserProfileController');

    Route::get('results/health-declaration-results' , 'API\ResultsController@healthDeclarationResults')->name('healthDeclarationResults');
    Route::get('results/health-declaration-results-alarm' , 'API\ResultsController@healthDeclarationWAlarm')->name('healthDeclarationWAlarm');
	Route::group(['middleware' => ['auth', 'LinkCheck']], function() {
        Route::get('results/health-declaration' , 'API\ResultsController@healthDeclaration')->name('healthDeclaration');


	// Route::group(['middleware' => ['auth']], function() {

		// System Administrator
		// System Administrator
		Route::group(['prefix' => 'systemadmin', 'as' => 'systemadmin'], function() {
            Route::get('/index' , 'SystemAdminController@index')->name('.index');
            Route::get('/users' , 'SystemAdminController@users')->name('.users');
            Route::get('/qrSelectService' , 'RequestsController@qrSelectService')->name('.qrSelectService');

            Route::get('/bycript' , 'SystemAdminController@bycript')->name('.bycript');
            Route::post('/bycriptdecrypt' , 'SystemAdminController@bycriptdecrypt')->name('.bycriptdecrypt');
		});

		// Procurement Team
		// Procurement Team
		Route::group(['prefix' => 'pt', 'as' => 'pt'], function() {
            Route::get('/app/{division?}' , 'API\PPMPController@APPList')->name('.app');

			Route::get('/officePR' , 'API\ProcurementController@officePR')->name('.officePR');
			Route::get('/po/{division?}/{section?}/{program?}' , 'API\ProcurementController@createPO')->name('.po');
			Route::get('/poItem/{bidder_id?}' , 'API\ProcurementController@createPOItem')->name('.poItem');
			Route::get('/test' , 'API\ProcurementController@test')->name('.test');
		});

		// Bids and Awards Committee
		// Bids and Awards Committee
		Route::group(['prefix' => 'bac', 'as' => 'bac'], function() {
			Route::get('/index' , 'API\BidsAwardsController@index')->name('.index');
			Route::get('/abstract' , 'API\BidsAwardsController@abstractOfBids')->name('.abstract');
			Route::get('/abstractCanvas' , 'API\BidsAwardsController@abstractOfCanvas')->name('.abstractCanvas');

			Route::get('/abstract/item/{item_id?}' , 'API\BidsAwardsController@abstractItem')->name('.abstract.item');
		});

		// Budget Section
		// Budget Section
		Route::group(['prefix' => 'budget', 'as' => 'budget'], function() {
			Route::get('/annual/{division?}' , 'API\BudgetController@annual')->name('.annual');
		});
		// Route::post('/store' , 'API\WFPController@store')->name('.store');
		// Route::post('/update' , 'API\WFPController@update')->name('.update');
		// Route::post('/delete' , 'API\WFPController@delete')->name('.delete');
		// Route::post('/sort' , 'API\WFPController@sort')->name('.sort');

		// Route::group(['prefix' => 'manage', 'middleware' =>'DivisionHead', 'as' => '.manage'], function() {
		//     Route::post('/dhcomment' , 'API\WFPController@dhComment')->name('.dhComment');
		//     Route::post('/wfpapprove' , 'API\WFPController@wfpApprove')->name('.wfpApprove');
		//     Route::post('/wfpapproveYear' , 'API\WFPController@wfpApproveYear')->name('.wfpApproveYear');
		// });
    });

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/pt/pr/{division?}/{section?}/{program?}' , 'API\ProcurementController@createPR')->name('pt.pr.create');
        Route::get('/item/requests/' , 'API\InventoryController@userItems')->name('item.requests');
        Route::get('/consolidated/wfp/' , 'API\WFPController@consolidatedWFP')->name('consolidated.wfp');


        // User Profile
		// User Profile
		Route::group(['prefix' => 'user', 'as' => 'user'], function() {
            Route::resource('/profile' , 'UserProfileController');
            Route::get('/checkdtr/{date?}/{month?}/{year?}' , 'SystemAdminController@personalbiometrics')->name('.checkdtr');
            Route::get('/settings', function(){
                return view('user.cards.settings');
            })->name('.settings');
        });

    });
    // URL::forceScheme('https');
