<?php

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::redirect('/', 'login')->middleware('guest');

Route::resource('suppliers', 'SuppliersController');

Route::resource('purchases', 'PurchasesController');
Route::resource('sales', 'SalesController');
Route::resource('transactions', 'TransactionsController');
Route::resource('customers', 'CustomersController');
Route::resource('products', 'ProductsController');
Route::resource('clients.payments', 'ClientPaymentsController');
Route::resource('clients', 'ClientsController');
Route::get('clients/{client}/statement', 'StatementsController@show')->name('statement.show');

Route::resource('receipts', 'ReceiptsController');

Route::resource('reports', 'ReportsController');

Route::view('/test', 'test');
Route::resource('branches', 'BranchesController');
Route::resource('branches.user', 'BranchesUserController');

Route::resource('users', 'UsersController');

Route::get('/profile', 'ProfilesController@index');

Route::put('/profile', 'ProfilesController@update');

Route::get('/users/{user}/passwordReset', function (App\User $user) {
    $user->password = bcrypt(company()->get('defaultPassword'));
    $user->save();
    flash('password was reset successfully');

    return back();
})->middleware('admin', 'auth');

Route::post('categories', 'CategoriesController@store');
