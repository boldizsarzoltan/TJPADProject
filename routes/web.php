
<?php

use App\DataTables\TasksDataTable;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TasksController;
use App\Models\Tasks;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\DataTables;

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

Route::get('/', function () {return view('home');})->name('home');
Route::group(['middleware' => ['auth']], function () {
    Route::get('tasks', [TasksController::class, 'index'])->name('list_tasks');
    Route::get('create_task', [TasksController::class, "create"])->name("create_link");
    Route::get('edit_task/{task_id}', [TasksController::class, "edit"])->name("edit_link");
    Route::get('delete_link/{task_id}', [TasksController::class, "delete"])->name("delete_link");
    Route::post('edit_task2/{task_id}', [TasksController::class, "editAction"])->name("edit_task_name");
    Route::post('create_task2', [TasksController::class, "createAction"])->name("create_task_name");
    Route::get('logout', [LoginController::class, 'logout'])->name("logout");
});

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::get(
    'error',
    function () {
        return view('error');
    }
);

Route::post(
    '/loginauth',
    [LoginController::class, 'loginauth']
);
Route::get(
    '/wrong_login',
    [LoginController::class, 'wrongLoginauth']
);

Route::get('register',[LoginController::class, 'register'])->name("register");
Route::post('register_action',[LoginController::class, 'registerAction'])->name("register_action");

Route::get('tasks-data', function(TasksDataTable $tasksDataTable) {
    $model = $tasksDataTable->query(new Tasks());
    return DataTables::of($model)->toJson();
})->name("get-tasks");
