<?php

use App\Http\Controllers\backendUser\ActivityLogController;
use App\Http\Controllers\backendUser\Auth\AuthenticatedSessionController;
use App\Http\Controllers\backendUser\Auth\EmailVerificationController;
use App\Http\Controllers\backendUser\BackendUserController;
use App\Http\Controllers\backendUser\FrontendUserController;
use App\Http\Controllers\frontendUser\Auth\VerifyEmailController;
use App\Http\Controllers\frontendUser\Auth\LoginController;
use App\Http\Controllers\frontendUser\Auth\RegisterController;
use App\Http\Controllers\frontendUser\UserController;
use App\Models\backendUser\BackendUser;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



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

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth:admin');


/*
|--------------------------------------------------------------------------
| ADMIN GUEST (NOT LOGIN)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('guest:admin')->group(function () {

    // Route::redirect('/', '/admin/login'); // Redirect /admin to /admin/login

    // login page
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->middleware('throttle:5,1')
        ->name('admin.login');

    // login submit
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->name('admin.login.submit');

    Route::get('/forgot-password', [AuthenticatedSessionController::class, 'forgotPassword'])
        ->name('admin.password.request');

    Route::post('/forgot-password', [AuthenticatedSessionController::class, 'sendResetLink'])
        ->name('admin.password.email');

    Route::get('/reset-password/{token}', [AuthenticatedSessionController::class, 'resetPasswordForm'])
        ->name('admin.password.reset');

    Route::post('/reset-password', [AuthenticatedSessionController::class, 'resetPassword'])
        ->name('admin.password.update');
});

//verify email backend user
// Email verification Laravel =
// “System hantar link signed URL → user click → system verify ID + hash → mark email_verified_at → redirect”
Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {

    $user = BackendUser::findOrFail($id); // ✅ FIX HERE

    if (!hash_equals($hash, sha1($user->getEmailForVerification()))) {
        abort(403, 'Invalid signature');
    }

    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

    return redirect()->route('admin.login')
        ->with('success', 'Email verified successfully. Please login.');
})->middleware(['signed'])->name('verification.verify');

/*
|--------------------------------------------------------------------------
| ADMIN AUTH (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('auth:admin')->group(function () {

    // Handle /admin → redirect ke dashboard untuk yang dah login
    // Route::redirect('/', '/admin/dashboard');

    // logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('admin.logout');

    /*
    |--------------------------------------------------------------------------
    | EMAIL VERIFICATION
    |--------------------------------------------------------------------------
    */
    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
        ->name('admin.verification.notice');

    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('admin.verification.send');

    Route::get('/dashboard', function () {
        return view('backend-user.module.dashboard');
    })->name('admin.dashboard');

    // backend-user CRUD
    Route::controller(BackendUserController::class)->group(function () {

        Route::get('/backend-user', 'index')->middleware('permission:backend-user.view,admin')->name('backend-user.index');
        Route::get('/backend-user/create', 'create')->middleware('permission:backend-user.create,admin')->name('backend-user.create');
        Route::post('/backend-user', 'store')->middleware('permission:backend-user.create,admin')->name('backend-user.store');
        Route::get('/backend-user/{id}', 'show')->middleware('permission:backend-user.view,admin')->name('backend-user.show');
        Route::get('/backend-user/{id}/edit', 'edit')->middleware('permission:backend-user.update,admin')->name('backend-user.edit');
        Route::put('/backend-user/{id}', 'update')->middleware('permission:backend-user.update,admin')->name('backend-user.update');
        Route::delete('/backend-user/{id}', 'destroy')->middleware('permission:backend-user.delete,admin')->name('backend-user.destroy');

        // Admin profile (current user) edit
        Route::get('/profile/edit', 'editProfile')->name('admin.profile.edit');
        Route::put('/profile', 'updateProfile')->name('admin.profile.update');
    });

    // frontend-user CRUD
    Route::controller(FrontendUserController::class)->group(function () {

        Route::get('/frontend-user', 'index')->name('frontend-user.index');
        Route::get('/frontend-user/create', 'create')->name('frontend-user.create');
        Route::post('/frontend-user', 'store')->name('frontend-user.store');
        Route::get('/frontend-user/{id}', 'show')->name('frontend-user.show');
        Route::get('/frontend-user/{id}/edit', 'edit')->name('frontend-user.edit');
        Route::put('/frontend-user/{id}', 'update')->name('frontend-user.update');
        Route::delete('/frontend-user/{id}', 'destroy')->name('frontend-user.destroy');
    });

    // Activity Log: view and API (requires admin auth)
    Route::get('/activity-log', [ActivityLogController::class, 'indexView'])->middleware('permission:activity-log.view,admin')->name('activity-log.index');
    // Route::get('/api/activity-logs', [ActivityLogController::class, 'indexApi'])->name('activity-log.api');

});


/*
|--------------------------------------------------------------------------
| FRONTEND USER AUTH (WEB GUARD)
|--------------------------------------------------------------------------
*/

//auto redirect ke login user bila /user
Route::get('/user', function () {
    return Auth::guard('user')->check()
        ? redirect()->route('user.dashboard')
        : redirect()->route('user.login');
});

Route::prefix('user')->group(function () {
    //Register
    Route::get('/register', [RegisterController::class, 'register'])->name('user.register');
    Route::post('/register', [RegisterController::class, 'registerSubmit'])->name('user.register.submit');

    //Login
    Route::get('/login', [LoginController::class, 'login'])->name('user.login');
    Route::post('/login', [LoginController::class, 'loginSubmit'])->name('user.login.submit');

    // Forgot / Reset Password
    Route::get('/forgot-password', [LoginController::class, 'forgotPassword'])->name('user.password.request');
    Route::post('/forgot-password', [LoginController::class, 'sendResetLink'])->name('user.password.email');
    Route::get('/reset-password/{token}', [LoginController::class, 'resetPasswordForm'])->name('user.password.reset');
    Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('user.password.update');
});


/*
|--------------------------------------------------------------------------
| USER AUTH (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/

Route::prefix('user')->middleware('auth:user')->group(function () {
    //Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');

    // Email Verification
    Route::get('/email/verify', [VerifyEmailController::class, 'notice'])
        ->name('user.verification.notice');
    Route::post('/email/verification-notification', [VerifyEmailController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('user.verification.resend');
    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])
        ->middleware(['signed'])
        ->name('user.verification.verify');

    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('user.profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');

    //FrontendUser
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

// dd([
//     'default' => auth()->user(),
//     'admin' => auth()->guard('admin')->user(),
//     'user' => auth()->guard('user')->user(),
// ]);
