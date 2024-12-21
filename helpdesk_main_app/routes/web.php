<?php

use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\TicketsController;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/{any?}', function () {
// Route::get('/', function () {
//     // dd("Error: Invalid method 1");
//     return view('welcome');
// })->name('welcome');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::fallback(function () {
    // dd('404 Not Found: ' . request()->url());
    // Log the invalid URL that was requested
    Log::warning('404 Not Found: ' . request()->url());

    // Return custom 404 page
    return response()->view('errors.404', [], 404);
});

// Dashboard Route
// Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// User Profile Route
// Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
// Route::get('/profile/edit', function () {
//     return view('profile.edit');
// })->middleware(['auth'])->name('profile.edit');

// Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.edit');
    Route::get('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/{id}/delete', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.delete');
    Route::patch('/profile/{id}/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/{id}/password', [App\Http\Controllers\ProfileController::class, 'password'])->name('profile.password');

    Route::resource('tickets', App\Http\Controllers\TicketsController::class);
});


// User Management Route
// Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/users', function () {
    return view('user.index');
})->middleware(['auth'])->name('user.index');

// Table List Route
// Route::get('/page/{type}', [PageController::class, 'index'])->name('page.index');
Route::get('/page/{type}', function ($type) {
    // return view('pages.' . $type); // Assuming you have pages named 'table', 'typography', etc.
    return view('page.index', ['type' => $type]); // The view or page that handles the type
})->name('page.index');

// UPGRADE TO PRO ROUTE
// Route::get('/upgrade', [UpgradeController::class, 'index'])->name('upgrade.index');
// Route::get('/upgrade', function () {
//     return view('upgrade'); // The view or page that handles the upgrade
// })->name('page.index');

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm']);

Route::get('/send-email', function () {
    $details = [
        'title' => 'Mail from HelpDesk MainxD App',
        'body' => 'This is for testing email using SMTP'
    ];
    try
    {
        Mail::send([], [], function ($message) use ($details) {
            $message->to('gr13zm4nnd0c4r4lh0@gmail.com')
                ->subject($details['title'])
                ->html($details['body']);
        });
        return "Email sent";
    }
    catch (\Exception $e)
    {
        return $e->getMessage();
    }
})->name('send-email');
