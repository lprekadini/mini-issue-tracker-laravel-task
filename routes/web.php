<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProjectController, IssueController, TagController, CommentController, IssueTagController
};
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', fn () => redirect()->route('projects.index'));

Route::resource('projects', ProjectController::class);
Route::resource('issues', IssueController::class);
Route::resource('tags', TagController::class)->only(['index', 'create', 'store']);

// AJAX: tags on issue
Route::post('/issues/{issue}/tags', [IssueTagController::class, 'store'])->name('issues.tags.attach');
Route::delete('/issues/{issue}/tags/{tag}', [IssueTagController::class, 'destroy'])->name('issues.tags.detach');

// AJAX: comments
Route::get('/issues/{issue}/comments', [CommentController::class, 'index'])->name('issues.comments.index');
Route::post('/issues/{issue}/comments', [CommentController::class, 'store'])->name('issues.comments.store');
