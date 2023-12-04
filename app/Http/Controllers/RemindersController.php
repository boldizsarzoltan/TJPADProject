<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRemindersRequest;
use App\Http\Requests\UpdateRemindersRequest;
use App\Models\Reminders;
use Yajra\DataTables\DataTables;

class RemindersController extends Controller
{
    public function index()
    {
        if(\request()->ajax()){
            $data = Reminders::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('reminders');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRemindersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reminders $reminders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reminders $reminders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRemindersRequest $request, Reminders $reminders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reminders $reminders)
    {
        //
    }
}
