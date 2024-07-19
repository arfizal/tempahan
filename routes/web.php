<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
    //return view('user.hello'); 
});
 
Route::get('/about', [
    App\Http\Controllers\ExampleController::class, 'aboutPage',
]); 
 
Route::get('/contact', [
    App\Http\Controllers\ExampleController::class, 'contactPage',
]);

Route::get('/myname', function () {
    return response()->json([
        'name' => 'Arfizal',
        'gender' => 'lelaki',
        'email' => 'arfizal@maiwp.gov.my',
    ]);
});


Auth::routes();
// satu line dah cover multiple route dia sendiri


Route::get('/firstlogin', function(){
    $user = Auth::User();
    if($user->role == 'admin'){
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('user.dashboard');
    }
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth'],
], function(){

    //Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

    //Route::get('/user', [App\Http\Controllers\HomeController::class, 'index'])->name('user.index');
    //Route::get('/user/create', [App\Http\Controllers\HomeController::class, 'create'])->name('user.create');
    //Route::get('/user/store', [App\Http\Controllers\HomeController::class, 'store'])->name('user.store');
    Route::resource('user', 'App\Http\Controllers\UserController'); //index,create,store,edit,update,show,

    //Route::delete('/users/{user}/force', [UserController::class, 'forceDelete'])->name('users.forceDelete');
    //Route::delete('/rooms/{room}/force', [RoomController::class, 'forceDelete'])->name('rooms.forceDelete');

    Route::resource('room', 'App\Http\Controllers\RoomController');
    Route::resource('booking', 'App\Http\Controllers\BookingController');

});

Route::group([
    'prefix' => 'user',
    'as' => 'user.',
    'middleware' => ['auth'],
], function(){

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboardUser'])->name('dashboard');
    Route::get('/room', [App\Http\Controllers\User\BookingController::class, 'index'])->name('room.index');
    Route::get('/room/{id}', [App\Http\Controllers\User\BookingController::class, 'booking'])->name('room.booking');
    Route::post('/room/{id}', [App\Http\Controllers\User\BookingController::class, 'bookingPost'])->name('room.booking.post');
    Route::get('/booking/{id}/cancel', [App\Http\Controllers\User\BookingController::class, 'bookingCancel'])->name('booking.cancel');

});
