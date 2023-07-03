<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GroupNameController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\FamiliarGroundController;

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

// Prevent Back Starts Here
Route::group(['middleware' => 'prevent-back-history'],function(){

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', [IndexController::class, 'Index']);

// Route::get('/dashboard', function () {
//     return view('admin.index');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//Start Middleware
Route::middleware('auth')->group(function(){

// Admin Management All Routes Starts
Route::prefix('admin')->middleware(['auth','role:admin'])->group(function() {
    Route::get('/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::get('/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');

}); // Admin Management All Routes Ends

// All Login Route
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);
Route::get('/manager/login', [ManagerController::class, 'ManagerLogin'])->name('manager.login')->middleware(RedirectIfAuthenticated::class);
// Route::get('/user/login', [UserController::class, 'UserLogin'])->name('user.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/customers/login', [CustomerController::class, 'CustomersLogin'])->name('customers.login')->middleware(RedirectIfAuthenticated::class);

// Manager Dashboard Management All Routes Starts
Route::prefix('manager')->middleware(['auth','role:manager'])->group(function() {

    Route::get('/dashboard', [ManagerController::class, 'ManagerDashboard'])->name('manager.dashobard');
    Route::get('/logout', [ManagerController::class, 'ManagerDestroy'])->name('manager.logout');

    Route::get('/profile', [ManagerController::class, 'ManagerProfile'])->name('manager.profile');
    Route::post('/profile/store', [ManagerController::class, 'ManagerProfileStore'])->name('manager.profile.store');
    Route::get('/change/password', [ManagerController::class, 'ManagerChangePassword'])->name('manager.change.password');
    Route::post('/update/password', [ManagerController::class, 'ManagerUpdatePassword'])->name('manager.update.password');

}); // Manager End Middleware





// All Admin Routes Middleware  Starts Here
    Route::middleware(['auth','role:admin'])->group(function () {

        // Familiar Ground Route
        Route::prefix('familiar-ground')->controller(FamiliarGroundController::class)->group(function () {
            Route::get('/view', 'FamiliarGroundView')->name('familiar-ground.view')->middleware('auth', 'permission:familiar-ground.view');
            Route::post('/store', 'FamiliarGroundStore')->name('familiar-ground.store');
            Route::put('/update/{id}', 'FamiliarGroundUpdate')->name('familiar-ground.update');
            Route::get('/delete/{id}', 'FamiliarGroundDelete')->name('familiar-ground.delete');
        });

        // Product Route
        Route::prefix('product')->controller(ProductController::class)->group(function () {
            Route::get('/view', 'productView')->name('product.view')->middleware('auth', 'permission:product.view');
            Route::post('/store', 'productStore')->name('product.store');
            Route::put('/update/{id}', 'productUpdate')->name('product.update');
            Route::get('/delete/{id}', 'productDelete')->name('product.delete');
        });

        // Customer Route
        Route::prefix('customer')->controller(CustomerController::class)->group(function () {
            Route::get('/view', 'customerView')->name('customer.view')->middleware('auth', 'permission:customer.view');
            Route::post('/store', 'customerStore')->name('customer.store');
            Route::put('/update/{id}', 'customerUpdate')->name('customer.update');
            Route::get('/delete/{id}', 'customerDelete')->name('customer.delete');
        });

        // Payment Route
        Route::prefix('payment')->controller(PaymentController::class)->group(function () {
            Route::get('/view', 'paymentView')->name('payment.view')->middleware('auth', 'permission:payment.view');
            Route::post('/store', 'paymentStore')->name('payment.store');
            Route::put('/update/{id}', 'paymentUpdate')->name('payment.update');
            Route::get('/delete/{id}', 'paymentDelete')->name('payment.delete')->middleware('auth', 'permission:payment.delete');
            Route::get('/paid-customer', 'paidCustomerView')->name('paid-payment.view')->middleware('auth', 'permission:paid-payment.view');
            Route::get('/unpaid-customer', 'unpaidCustomerView')->name('unpaid-payment.view')->middleware('auth', 'permission:unpaid-payment.view');
            Route::put('/unpaid-payment/update', 'unpaidCustomerUpdate')->name('unpaid-payment.update')->middleware('auth', 'permission:unpaid-payment.view');
            Route::get('/partially-customer', 'partiallyCustomerView')->name('partially-payment.view')->middleware('auth', 'permission:partially-payment.view');
            Route::get('/overdue-customer', 'overdueCustomerView')->name('overdue-payment.view')->middleware('auth', 'permission:overdue-payment.view');

            Route::get('/total-amount-paid', 'totalAmountPaidView')->name('total-amount.view')->middleware('auth', 'permission:total-amount.view');
            Route::get('/total-amount-paid-report', 'totalAmountPaidReportView')->name('total-amount-paid-report.view')->middleware('auth', 'permission:total-amount-paid-report.view');
            Route::post('/search', 'searchByEvent')->name('search');

            Route::get('/edit-payment', 'editPayment')->name('payment.edit')->middleware('auth', 'permission:payment.edit');
            Route::put('/edit-payment/update', 'editPaymentUpdate')->name('edit-payment.update');
        });

        // Group Name  Route
        Route::prefix('groupname')->controller(GroupNameController::class)->group(function () {
            Route::get('/view', 'groupnameView')->name('groupname.view')->middleware('auth', 'permission:groupname.view');
            Route::post('/store', 'groupnameStore')->name('groupname.store');
            Route::put('/update/{id}', 'groupnameUpdate')->name('groupname.update');
            Route::get('/delete/{id}', 'groupnameDelete')->name('groupname.delete');
        });

        // PermissionController
        Route::prefix('permission')->controller(PermissionController::class)->group(function () {
            Route::get('/view', 'permissionView')->name('permission.view')->middleware('auth', 'permission:permission.view');
            Route::post('/store', 'permissionStore')->name('permission.store');
            Route::put('/update/{id}', 'permissionUpdate')->name('permission.update');
            Route::get('/delete/{id}', 'permissionDelete')->name('permission.delete');
        });  // PermissionController Ends

        // RolesController
        Route::prefix('roles')->controller(RolesController::class)->group(function () {
            Route::get('/view', 'rolesView')->name('roles.view')->middleware('auth', 'permission:roles.view');
            Route::post('/store', 'rolesStore')->name('roles.store');
            Route::put('/update/{id}', 'rolesUpdate')->name('roles.update');
            Route::get('/delete/{id}', 'rolesDelete')->name('roles.delete');

        //Roles Permission
        Route::get('/view-permission', 'rolesPermissionView')->name('roles.permission.view')->middleware('auth', 'permission:roles.permission.view');
        Route::get('/add-permission', 'rolesPermissionAdd')->name('roles.permission.add')->middleware('auth', 'permission:roles.permission.add');
        Route::post('/store-permission', 'rolesPermissionStore')->name('roles.permission.store');
        Route::get('/edit-permission/{id}', 'rolesPermissionEdit')->name('roles.permission.edit')->middleware('auth', 'permission:roles.permission.edit');
        Route::post('/update-permission/{id}', 'rolesPermissionUpdate')->name('roles.permission.update');
        Route::get('/delete-permission/{id}', 'rolesPermissionDelete')->name('roles.permission.delete')->middleware('auth', 'permission:roles.permission.delete');
        });  // PermissionController Ends

            // Create Admin Management Route
        Route::prefix('all-admin')->controller(AdminController::class)->group(function () {
            Route::get('/view', 'allAdminView')->name('all.admin.view')->middleware('auth', 'permission:all.admin.view');
            Route::get('/add', 'allAdminAdd')->name('all.admin.add');
            Route::post('/store', 'allAdminstore')->name('all.admin.store');
            Route::get('/edit/{id}', 'allAdminEdit')->name('all.admin.edit');
            Route::post('/update/{id}', 'allAdminUpdate')->name('all.admin.update');
            Route::get('/delete/{id}', 'allAdminDelete')->name('all.admin.delete');
        });

        // Expenditure Name  Route
        Route::prefix('expenditure')->controller(ExpenditureController::class)->group(function () {
            Route::get('/view', 'expenditureView')->name('expenditure.view')->middleware('auth', 'permission:expenditure.view');
            Route::post('/store', 'expenditureStore')->name('expenditure.store');
            Route::put('/update/{id}', 'expenditureUpdate')->name('expenditure.update');
            Route::get('/delete/{id}', 'expenditureDelete')->name('expenditure.delete');
        });

        // Event Name  Route
        Route::prefix('event')->controller(EventController::class)->group(function () {
            Route::get('/view', 'eventView')->name('event.view');
            Route::post('/store', 'eventStore')->name('event.store');
            Route::put('/update/{id}', 'eventUpdate')->name('event.update');
            Route::get('/delete/{id}', 'eventDelete')->name('event.delete');
        });



    }); // Admin End Middleware
















}); //prevent-back-history








































}); //End Middleware
