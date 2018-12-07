<?php

namespace App\Http\Controllers;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('id', 'DESC')->paginate(5);
        return view('Task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $allFields = $request->all();
        $allFields['start_date'] = date('Y-m-d G:i:s');
        $allFields['end_date'] = date('Y-m-d G:i:s');
        $allFields['user_id'] = 1;
        $allFields['type_id'] = 1;

        Task::create($allFields);

        return redirect()->route('task.index')

                            ->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        return view('Task.show', compact($task));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        return view('Task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $allFields = $request->all();
        $allFields['start_date'] = date('Y-m-d G:i:s');
        $allFields['end_date'] = date('Y-m-d G:i:s');
        $allFields['user_id'] = 1;
        $allFields['type_id'] = 1;

        Task::find($id)->update($allFields);
        return redirect()->route('task.index')
            ->with('success','Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::find($id)->delete();
        return redirect()->route('task.index')
            ->with('success', 'Task deleted successfully');
    }
}
