<?php

namespace Todo_list\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Todo_list\Task;
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
        if (!Auth::check())
        {
            return redirect()->guest('login');
        }

        $user_id = Auth::id();

        $tasks = Task::where('user_id', $user_id)->get();

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
        if (!Auth::check())
        {
            return redirect()->guest('login');
        }

        $id = Auth::id();

        $this->validate($request, [
            'name' => 'required'
        ]);

        $allFields = $request->all();
        $allFields['start_date'] = date('Y-m-d G:i:s');
        $allFields['end_date'] = date('Y-m-d G:i:s');
        $allFields['user_id'] = $id;
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
        if (!Auth::check())
        {
            return redirect()->guest('login');
        }

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
        if (!Auth::check())
        {
            return redirect()->guest('login');
        }

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
        if (!Auth::check())
        {
            return redirect()->guest('login');
        }

        $user_id = Auth::id();

        $this->validate($request, [
            'name' => 'required'
        ]);

        $allFields = $request->all();
        $allFields['start_date'] = date('Y-m-d G:i:s');
        $allFields['end_date'] = date('Y-m-d G:i:s');
        $allFields['user_id'] = $user_id;
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
        if (!Auth::check())
        {
            return redirect()->guest('login');
        }

        Task::find($id)->delete();
        return redirect()->route('task.index')
            ->with('success', 'Task deleted successfully');
    }
}
