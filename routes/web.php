<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DynamicDeptDropdownController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return view('auth/register');
    
}); 

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/users', function () {
    return view('users');
})->middleware(['auth', 'verified'])->name('users');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/', function () {
    $departments = DB::select('select * from departments');
    return view('auth.register', compact('departments')); 
});




// Email verification

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


// resend email verification

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');






// Ticket routes
Route::middleware('auth')->group(function(){
    Route::resource('/ticket',TicketController::class);
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


// Users page

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/users', [UserController::class, 'index'])->name('users');
//     Route::post('/users/assign-role/{user}', [UserController::class, 'assignRole'])->name('users.assignRole');
// });

Route::middleware(['role:super_admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users/assign-role/{user}', [UserController::class, 'assignRole'])->name('users.assignRole');
});


// Department add/remove
Route::middleware(['role:super_admin'])->group(function () {
    Route::resource('departments', DepartmentController::class);
    Route::post('departments/assign-head/{department}', [DepartmentController::class, 'assignHead'])->name('departments.assignHead');
});

// Ticket approval email for HOD
Route::get('/ticket/approve/{ticket}', [TicketController::class, 'approve'])->name('ticket.approve');
Route::get('/ticket/reject/{ticket}', [TicketController::class, 'reject'])->name('ticket.reject');

// My tickets route for USER
Route::get('/my-tickets', [TicketController::class, 'myTicketsView'])->name('ticket.myTicketsView');


// Approved tickets view for HOD
Route::get('/tickets/approved', [TicketController::class, 'approvedTicketsView'])->name('ticket.approvedTicketsView')->middleware(['role:head_of_department']);

// Route for assigning tickets for users
Route::post('/ticket/assign/{ticket}', [TicketController::class, 'assignToSupportStaff'])->name('ticket.assign');
 

// Assigned tickets view for Support staff
Route::middleware(['auth', 'role:support_staff'])->group(function () {
    Route::get('/tickets/assigned', [TicketController::class, 'assignedTicketsView'])->name('ticket.assignedTicketsView');
});





require __DIR__.'/auth.php';



