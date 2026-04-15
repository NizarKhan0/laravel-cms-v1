<?php

use App\Http\Controllers\backendUser\BackendUserController;
use App\Http\Controllers\backendUser\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Letak ni di routes/web.php (paling atas)
// Route::redirect('/test-redirect', '/admin/login');

// TAPI ini mungkin still bermasalah sebab dia evaluate awal

// Route::get('/debug-admin', function() {
//     // Check semua routes
//     $routes = collect(Route::getRoutes())->map(function($route) {
//         return $route->uri();
//     })->filter(function($uri) {
//         return str_contains($uri, 'admin');
//     });

//     dd($routes->values()->toArray());
// });

/*
|--------------------------------------------------------------------------
| ADMIN BASE REDIRECT
|--------------------------------------------------------------------------
*/

// Pilihan 1: Guna closure (BEST - dah proven works)
// Route::get('/admin', function () {
//     // Kalau dah login, pergi ke dashboard
//     if (Auth::guard('admin')->check()) {
//         return redirect()->route('admin.dashboard');
//     }
//     // Kalau belum login, pergi ke login page
//     return redirect()->route('admin.login');
// });

// Pilihan 2: Guna Route::any atau Route::match
// Route::match(['GET', 'HEAD'], '/admin', function () {
//     return redirect('/admin/login');
// });

/*
|--------------------------------------------------------------------------
| ADMIN GUEST (NOT LOGIN)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('guest:admin')->group(function () {

    Route::redirect('/', '/admin/login'); // Redirect /admin to /admin/login

    // login page
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('admin.login');

    // login submit
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->name('admin.login.submit');

    Route::get('/forgot-password',[AuthenticatedSessionController::class,'forgotPassword'])
        ->name('admin.password.request');

    Route::post('/forgot-password',[AuthenticatedSessionController::class,'sendResetLink'])
        ->name('admin.password.email');

    Route::get('/reset-password/{token}',[AuthenticatedSessionController::class,'resetPasswordForm'])
        ->name('admin.password.reset');

    Route::post('/reset-password',[AuthenticatedSessionController::class,'resetPassword'])
        ->name('admin.password.update');
});


/*
|--------------------------------------------------------------------------
| ADMIN AUTH (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('auth:admin')->group(function () {

    // Handle /admin → redirect ke dashboard untuk yang dah login
    Route::redirect('/', '/admin/dashboard');

    // logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('admin.logout');

    // dashboard
    Route::get('/dashboard', function () {
        return view('backend-user.module.dashboard');
    })->name('admin.dashboard');


    // backend-user CRUD
    Route::controller(BackendUserController::class)->group(function () {

        Route::get('/backend-user', 'index')->name('backend-user.index');
        Route::get('/backend-user/create', 'create')->name('backend-user.create');
        Route::post('/backend-user', 'store')->name('backend-user.store');
        Route::get('/backend-user/{id}', 'show')->name('backend-user.show');
        Route::get('/backend-user/{id}/edit', 'edit')->name('backend-user.edit');
        Route::put('/backend-user/{id}', 'update')->name('backend-user.update');
        Route::delete('/backend-user/{id}', 'destroy')->name('backend-user.destroy');
    });

});
