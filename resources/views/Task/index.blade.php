@extends('layouts.app')

@section('content')
    <div class="row">
        <section class="content">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-left"><h3>List Tasks</h3></div>
                        <div class="pull-right">
                            <div class="btn-group">

                                <a href="{{ route('task.create') }}" class="btn btn-info" >Add New</a>
                            </div>
                        </div>
                        <div class="table-container">
                            <table id="mytable" class="table table-bordred table-striped">

                                <thead>
                                    <th><input type="checkbox" id="checkall" /></th>
                                    <th>Task Title</th>
                                    <th>Task Description</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </thead>

                                <tbody>
                                    @if($tasks->count())
                                        @foreach($tasks as $task)
                                            <tr>
                                                <td><input type="checkbox" class="checkthis" /></td>
                                                <td>{{$task->name}}</td>
                                                <td>{{$task->description}}</td>
                                                <td><a class="btn btn-primary btn-xs" href="{{action('TaskController@show', $task->id)}}" ><span class="glyphicon glyphicon-eye-open"></span></a></td>
                                                <td><a class="btn btn-primary btn-xs" href="{{action('TaskController@edit', $task->id)}}" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                                                <td>
                                                    <form action="{{action('TaskController@destroy', $task->id)}}" method="post">
                                                        {{csrf_field()}}
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">No Records found !!</td>
                                        </tr>
                                    @endif
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
