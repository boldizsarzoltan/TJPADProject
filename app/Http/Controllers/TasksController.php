<?php

namespace App\Http\Controllers;

use App\Custom\FlashMessages;
use App\DataTables\TasksDataTable;
use App\Http\Requests\StoreTasksRequest;
use App\Http\Requests\UpdateTasksRequest;
use App\Models\Tasks;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TasksController extends Controller
{
    use AuthorizesRequests;
    use FlashMessages;

    /**
     * Display a listing of the resource.
     */
    public function index(TasksDataTable $dataTable, Tasks $tasks)
    {
        return $dataTable->render('tasks');
    }

    public function create()
    {
        return view('createtask');
    }

    public function edit(Request $request, int $taskId)
    {
        $task = Tasks::query()
            ->where("id", $taskId)
            ->where("user_id", Auth::id())->get();
        if($task->count() != 1 ){
            return redirect("/error")->withErrors([
                'error' => "Task not found"
            ]);
        }
        return view('edittask')
            ->with([
                'task_id' => $taskId,
                'task' => $task->toArray()[0]
            ]);
    }

    public function delete(Request $request, int $taskId)
    {
        try {
            $task = Tasks::query()
                ->where("id", $taskId)
                ->where("user_id", Auth::id())->first();
            $task->delete();
            return redirect(route('list_tasks'));
        } catch (\Throwable $throwable) {
            return back()->withInput()->withErrors([
                'error' => $throwable->getMessage()
            ]);
        }
    }

    public function createAction(Request $request)
    {
        try {
            $token = csrf_token();
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
                'start' => 'required|date_format:Y-m-d\TH:i:s|after_or_equal:' . date(DATE_ATOM),
                'end' => 'required|date_format:Y-m-d\TH:i:s|after_or_equal:' . date(DATE_ATOM)
            ]);
            $task = new Tasks($request->all());
            $task->user_id = Auth::id();
            $task->save();
            Session::flash('alert-success', 'Created');
            return redirect(route('list_tasks'));
        }
        catch (\RuntimeException $runtimeException) {
            return back()->withInput()->withErrors([
                'error' => $runtimeException->getMessage()
            ]);
        }
    }

    public function editAction(Request $request, int $taskId)
    {
        try {
            $token = csrf_token();
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
                'start' => 'required|date_format:Y-m-d\TH:i:s',
                'end' => 'required|date_format:Y-m-d\TH:i:s'
            ]);
            $task = Tasks::query()
                ->where("id", $taskId)
                ->where("user_id", Auth::id())->first();
            $task->fill($request->all());
            $task->update();
            Session::flash('alert-success', 'Updated');
            return redirect(route('list_tasks'));
        }
        catch (\RuntimeException $runtimeException) {
            return back()->withInput()->withErrors([
                'error' => $runtimeException->getMessage()
            ]);
        }
    }
}
