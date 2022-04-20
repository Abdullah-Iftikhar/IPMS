<?php

use Illuminate\Support\Facades\Route;

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
    return view('login');
})->name('login');

Route::get('/clear', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    dd('cache cleared.');
});

// Auth Routes
Route::post('admin/login', 'App\Http\Controllers\AuthController@adminLogin')->name('admin.login');

Route::get('forget/password', 'App\Http\Controllers\AuthController@forgetPassword')->name('forgot.password');

Route::post('password/send', 'App\Http\Controllers\AuthController@forgetPasswordEmail')->name('forget.password.email');


Route::get('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return view('login');
})->name('logout');


Route::group(['middleware' => 'auth', 'after' => 'no-cache'], function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', 'App\Http\Controllers\DashboardController@dashboard')->name('admin.dashboard');
        Route::get('/settings/profile', 'App\Http\Controllers\DashboardController@profile')->name('admin.settings.profile');
        Route::post('profile/update', 'App\Http\Controllers\DashboardController@updateProfile')->name('admin.update.profile');

        //Properties Management
        Route::prefix('properties')->group(function () {
            Route::get('/list', 'App\Http\Controllers\PropertyController@propertyList')->name('admin.property.list');
            Route::get('/detail/{id}', 'App\Http\Controllers\PropertyController@propertyDetail')->name('admin.property.detail');
            Route::get('/add', 'App\Http\Controllers\PropertyController@propertyAdd')->name('admin.property.add');
            Route::post('/post', 'App\Http\Controllers\PropertyController@propertyPost')->name('admin.property.post');
            Route::get('/edit/{id}', 'App\Http\Controllers\PropertyController@propertyEdit')->name('admin.property.edit');
            Route::post('/update/{id}', 'App\Http\Controllers\PropertyController@propertyUpdate')->name('admin.property.update');
            Route::delete('delete/{id}', 'App\Http\Controllers\PropertyController@destroy')->name('admin.property.delete');
            Route::get('/{type}/{id}', 'App\Http\Controllers\PropertyController@propertyTypeAct')->name('admin.property.type.act');

            Route::post('/sold/detail/{id}', 'App\Http\Controllers\PropertyController@propertySoldDetail')->name('admin.property.sold.detail');
            Route::post('/rented/{id}', 'App\Http\Controllers\PropertyController@propertyRentedDetail')->name('admin.property.rented.detail');
            //Sold Properties
        });

        //Sold Properties
        Route::prefix('sold-properties')->group(function () {
            Route::get('/list', 'App\Http\Controllers\SellController@soldList')->name('admin.property.sold');
            Route::get('/detail/{id}', 'App\Http\Controllers\SellController@propertyDetail')->name('admin.sold.property.detail');
        });

        Route::prefix('property-iteration')->group(function (){
            Route::get('/list', 'App\Http\Controllers\PropertyIterationController@index')->name('admin.property.iteration.list');
            Route::get('/add', 'App\Http\Controllers\PropertyIterationController@add')->name('admin.property.iteration.add');
            Route::post('/store', 'App\Http\Controllers\PropertyIterationController@store')->name('admin.property.iteration.store');
            Route::get('/edit/{id}', 'App\Http\Controllers\PropertyIterationController@edit')->name('admin.property.iteration.edit');
            Route::post('/update/{id}', 'App\Http\Controllers\PropertyIterationController@update')->name('admin.property.iteration.update');
            Route::delete('/destroy/{id}', 'App\Http\Controllers\PropertyIterationController@destroy')->name('admin.property.iteration.destroy');

            Route::get('/iteration/{id}', 'App\Http\Controllers\PropertyIterationController@getPropertyIteration')->name('admin.sold.property.iteration');
            Route::post('post/iteration/{id}', 'App\Http\Controllers\PropertyIterationController@postPropertyIteration')->name('admin.sold.property.post.iteration');
        });

        //Rented Properties
        Route::prefix('rented-properties')->group(function () {
            Route::get('/list', 'App\Http\Controllers\RentController@rentedList')->name('admin.property.rented');
            Route::get('/active/{id}', 'App\Http\Controllers\RentController@moveToActive')->name('admin.property.rent.to.active');
            Route::get('/detail/{id}', 'App\Http\Controllers\RentController@propertyDetail')->name('admin.rented.property.detail');
            Route::get('/iterations/{id}', 'App\Http\Controllers\RentController@rentIteration')->name('admin.rented.iterations');
            Route::post('/post/iterations/{id}', 'App\Http\Controllers\RentController@postRentIteration')->name('admin.post.rented.iterations');
        });

        //Construction Properties
        Route::prefix('construction-properties')->group(function () {
            Route::get('/list', 'App\Http\Controllers\ConstructionController@constructionList')->name('admin.property.construction');
            Route::get('/detail/{id}', 'App\Http\Controllers\ConstructionController@constructionDetail')->name('admin.property.construction.detail');
            Route::get('/add/property/material/{id}', 'App\Http\Controllers\ConstructionController@addPropertyMaterial')->name('admin.add.property.material');
            Route::post('/post/property/material', 'App\Http\Controllers\ConstructionController@postPropertyMaterial')->name('admin.post.property.material');
            Route::get('/construction/completed/{id}', 'App\Http\Controllers\ConstructionController@constructionCompleted')->name('admin.construction.completed');

            //Material
            Route::get('material/list', 'App\Http\Controllers\ConstructionController@constructionMaterialList')->name('admin.construction.material.list');
            Route::post('/save/material', 'App\Http\Controllers\ConstructionController@saveMaterial')->name('admin.construction.save.material');
            Route::delete('delete/{id}', 'App\Http\Controllers\ConstructionController@destroy')->name('admin.material.delete');
        });

        //System Users
        Route::prefix('users')->group(function () {
            Route::get('/list', 'App\Http\Controllers\AuthController@usersList')->name('admin.users.list');
            Route::post('/add', 'App\Http\Controllers\AuthController@addUser')->name('admin.users.add');
            Route::delete('delete/{id}', 'App\Http\Controllers\AuthController@destroy')->name('admin.users.delete');
        });

        //Employees
        Route::prefix('employees')->group(function () {
            Route::get('/list', 'App\Http\Controllers\EmployeeController@employeeList')->name('admin.employee.list');
            Route::post('/add', 'App\Http\Controllers\EmployeeController@addEmployee')->name('admin.employee.add');
            Route::delete('delete/{id}', 'App\Http\Controllers\EmployeeController@destroy')->name('admin.employee.delete');
        });

        //Salaries
        Route::prefix('employees/salaries')->group(function () {
            Route::get('/list', 'App\Http\Controllers\SalaryController@salariesList')->name('admin.salaries.list');
            Route::post('/add', 'App\Http\Controllers\SalaryController@addSalaries')->name('admin.salaries.add');
            Route::delete('delete/{id}', 'App\Http\Controllers\SalaryController@destroy')->name('admin.salaries.delete');
        });

        //Banks
        Route::prefix('banks')->group(function () {
            Route::get('/list', 'App\Http\Controllers\BankController@list')->name('admin.bank.list');
            Route::post('/save', 'App\Http\Controllers\BankController@save')->name('admin.bank.save');
            Route::delete('delete/{id}', 'App\Http\Controllers\BankController@destroy')->name('admin.bank.delete');
        });

        Route::prefix('banks/account')->group(function () {
            Route::get('/list', 'App\Http\Controllers\BankController@amountList')->name('admin.bank.account.list');
            Route::post('/save', 'App\Http\Controllers\BankController@amountSave')->name('admin.bank.account.save');
            Route::delete('delete/{id}', 'App\Http\Controllers\BankController@amountDestroy')->name('admin.bank.account.delete');
            Route::get('transactions/{id}', 'App\Http\Controllers\BankController@accTransaction')->name('admin.bank.account.transactions');
        });

        //Reports
        Route::prefix('reports')->group(function () {
            Route::get('/list/{key}', 'App\Http\Controllers\ReportController@index')->name('admin.report.index');
        });

    });
});
