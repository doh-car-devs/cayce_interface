<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::group(['middleware' => ['auth:api']], function() {
// 	Route::get('/user', 'Auth\AuthController@user');
// 	Route::get('/logout', 'Auth\AuthController@logout');
// });

// Route::group(['prefix' => 'auth'], function() {
// 	Route::post('/login', 'Auth\AuthController@login');
// 	Route::post('/signup', 'Auth\AuthController@signup');
// });



    /*
    |
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |  Activities
    |
    |  1. Work Financial Plan
    |  2. Project Procurement Management Plan
    |  3. Exporting
    |  4. TWG
    |  5. SYSTEM ADMINISTRATOR
    |  6. PEEK
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
    |  Work Financial Plan Routes
    |  Work Financial Plan Routes
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::group(['middleware' => [], 'prefix' => 'wfp', 'as' => 'api.wfp'], function() {

        Route::post('/store' , 'API\WFPController@store')->name('.store');
        Route::post('/store/deliverable' , 'API\WFPController@storeDeliverable')->name('.deliverable.store');
        Route::post('/update' , 'API\WFPController@update')->name('.update');
        Route::post('/delete' , 'API\WFPController@delete')->name('.delete');
        Route::post('/sort' , 'API\WFPController@sort')->name('.sort');

        Route::group(['prefix' => 'manage', 'middleware' =>'DivisionHead', 'as' => '.manage'], function() {
            Route::post('/dhcomment' , 'API\WFPController@dhComment')->name('.dhComment');
            Route::post('/wfpapprove' , 'API\WFPController@wfpApprove')->name('.wfpApprove');
            Route::post('/wfpapproveYear' , 'API\WFPController@wfpApproveYear')->name('.wfpApproveYear');
        });

        Route::get('/deliverableList', 'API\WFPController@deliverableList')->name('.deliverableList');
    });


    /*
    |
    |--------------------------------------------------------------------------
    |  Project Procurement Management Plan Routes
    |  Project Procurement Management Plan Routes
    |  Project Procurement Management Plan Routes
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::group(['middleware' => [], 'prefix' => 'ppmp', 'as' => 'api.ppmp'], function() {
        Route::post('/store' , 'API\PPMPController@store')->name('.store');
        Route::post('/update' , 'API\PPMPController@update')->name('.update');
        Route::post('/delete' , 'API\PPMPController@delete')->name('.delete');

        Route::post('/ppmpApprove' , 'API\PPMPController@ppmpApprove')->name('.approve');

        Route::get('/items', 'API\PPMPController@itemList')->name('.items');
    });

	/*
	|
	|--------------------------------------------------------------------------
	|  Export Routes
	|  Export Routes
	|  Export Routes
	|--------------------------------------------------------------------------
	|
	|
	*/
	Route::group(['middleware' => [], 'prefix' => 'export', 'as' => 'api.export'], function() {
		Route::get('/twg/postqualevalreport/{year?}' , 'API\ExportController@postQualEvalReport')->name('.postQualEvalReport.twg');
    });

	/*
	|
	|--------------------------------------------------------------------------
	|  TWG Routes
	|  TWG Routes
	|  TWG Routes
	|--------------------------------------------------------------------------
	|
	|
	*/
	Route::group(['middleware' => [], 'prefix' => 'twg', 'as' => 'api.twg'], function() {
		Route::get('/itemRequestList' , 'API\InventoryController@itemRequestList')->name('.itemRequestList');
        Route::get('/itemList' , 'API\InventoryController@itemList')->name('.itemList');
        Route::post('/requestItem' , 'API\InventoryController@requestItem')->name('.requestItem');
        Route::post('/update' , 'API\InventoryController@twgUpdate')->name('.update');
        // Route::get('/update/item/{branch?}/{item_id?}/{unit?}/{item_name?}/{price?}' , 'API\InventoryController@updateReference')->name('.update.item');
        Route::post('/update/item/' , 'API\InventoryController@updateReference')->name('.update.item');
    });

	/*
	|
	|--------------------------------------------------------------------------
	|  SYSTEM ADMINISTRATOR Routes
	|  SYSTEM ADMINISTRATOR Routes
	|  SYSTEM ADMINISTRATOR Routes
	|--------------------------------------------------------------------------
	|
	|
    */
    Route::group(['prefix' => 'systemadmin', 'as' => 'api.systemadmin'], function() {
        Route::get('/getallemployee' , 'SystemAdminController@getAllEmployee')->name('.get.allemployee');
        Route::get('/getAllUsers' , 'SystemAdminController@getAllUsers')->name('.get.getAllUsers');

        Route::post('/storeemployee' , 'SystemAdminController@storeEmployee')->name('.store.employee');
        Route::post('/updateEmployee' , 'SystemAdminController@updateEmployee')->name('.update.employee');
        Route::post('/employeeCSV' , 'SystemAdminController@employeeCSV')->name('.employeeCSV');
        Route::get('/moveImages' , 'SystemAdminController@moveImages')->name('.moveImages');
        Route::get('/checkdtr/{id?}/{date?}/{month?}/{year?}' , 'SystemAdminController@biometrics')->name('.checkdtr');
        Route::get('/dlt/emp/' , 'SystemAdminController@deleteEmployee')->name('.deleteEmployee');

        // get all EMPLOYEES in biometrics API
        Route::get('/getEmployees' , 'SystemAdminController@getBiometricsAPI')->name('.getBiometricsAPI');
        // update all EMPLOYEES in biometrics API
        Route::get('/downloadEmployees' , 'SystemAdminController@updateLocalBiometricEmployee')->name('.updateLocalBiometricEmployee');
     });


	/*
	|
	|--------------------------------------------------------------------------
	|  Services Routes
	|  Services Routes
	|  Services Routes
	|--------------------------------------------------------------------------
	|
	|
	*/
	Route::group(['middleware' => [], 'prefix' => 'services', 'as' => 'api.services'], function() {
		Route::post('/redirect/redirectAPI/' , 'API\ServicesController@redirectAPI')->name('.redirect.redirectAPI');
		Route::post('/redirect/pqes/' , 'API\ServicesController@redirect')->name('.redirect.pqes');
		Route::post('/redirect/purchaserequest/' , 'API\ServicesController@redirect')->name('.redirect.purchaserequest');
		Route::post('/table/length/' , 'API\ServicesController@getLength')->name('.table.length');
    });



    Route::group(['prefix' => 'peek', 'as' => 'peek'], function() {
        Route::get('/ppmpinwfp/{wfp_id?}', 'API\PPMPController@peekPPMP')->name('.ppmpinwfp');
        Route::get('/bidders/', 'API\BidsAwardsController@bidderlistPeek')->name('.ppmpinwfp');
        Route::get('/getPPMP/', 'API\BidsAwardsController@getPPMP')->name('.getPPMP');
    });

    /*
    |
    |--------------------------------------------------------------------------
    |  Features Routes
    |   *Connecting to an external API
    |
    |  1. Inventroy Controller
    |--------------------------------------------------------------------------
    |
    |
    */

    Route::group(['middleware' => [], 'prefix' => 'inv', 'as' => 'inv'], function(){

    });


	/*
	|
	|--------------------------------------------------------------------------
	|--------------------------------------------------------------------------
	|  Section Protected Routes with LinkCheck®
	|
	|  1. Budget Section Controller
	|
	|--------------------------------------------------------------------------
	|--------------------------------------------------------------------------
	|
	|
    */
    Route::group(['middleware' => ['auth']], function() {
		// Budget Section
		// Budget Section
		Route::group(['prefix' => 'budget', 'as' => 'api.budget'], function() {
			Route::post('/editAnnualStore' , 'API\BudgetController@editallocateDivisionStore')->name('.annual.edit.store');
			Route::post('/sourceStore' , 'API\BudgetController@sourceStore')->name('.source.store');
			Route::post('/annualStore' , 'API\BudgetController@annualStore')->name('.annual.store');
			Route::post('/allocateDivisionStore' , 'API\BudgetController@allocateDivisionStore')->name('.allocateDivision.store');
        });

		// BAC Section
		// BAC Section
		Route::group(['prefix' => 'bac', 'as' => 'api.bac'], function() {
			Route::get('/bidderList' , 'API\BidsAwardsController@bidderList')->name('.bidder');
            Route::post('/bid/store' , 'API\BidsAwardsController@bidStore')->name('.bid.store');
            Route::post('/bidder/win/' , 'API\BidsAwardsController@bidderWinStore')->name('.bidderWin.store');
            Route::post('/bidder/store/' , 'API\BidsAwardsController@bidderStore')->name('.bidder.store');
        });
		Route::group(['prefix' => 'pt', 'as' => 'api.pt'], function() {
            Route::post('/rpr' , 'API\ProcurementController@requestPurchaseRequest')->name('.rpr');
            Route::post('/prn/store' , 'API\ProcurementController@purchaseRequestNumber')->name('.prn.store');
            Route::post('/po/store' , 'API\ProcurementController@storePurchaseOrder')->name('.po.store');
        });
    });

    /*
    |
    |--------------------------------------------------------------------------
    |  Test Routes
    |--------------------------------------------------------------------------
    |
    |
    */

    Route::group(['middleware' => [], 'prefix' => 'test', 'as' => 'test'], function(){
        Route::get('/items', 'TestDump@itemList')->name('.items');
        Route::post('/testapi', 'TestDump@apiconnect')->name('.apiconnect');
        Route::get('/getDeletedPPMPWFP', 'API\WFPController@getDeletedPPMPWFP')->name('.getDeletedPPMPWFP');
        Route::get('/prTest', 'API\ProcurementController@prTest')->name('.prTest');
        Route::get('/newPurchaseRequests', 'API\ProcurementController@newPurchaseRequests')->name('.newPurchaseRequests');
        Route::get('/deletePPMPItemswithdeletedPPMP', 'API\ProcurementController@deletePPMPItemswithdeletedPPMP')->name('.deletePPMPItemswithdeletedPPMP');
    });
