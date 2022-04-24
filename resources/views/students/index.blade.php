@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Students') }}
                <a class="btn btn-sm btn-success" style="float:right;" href="{{ route('students.create') }}">Create</a>
                </div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Age</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Teacher</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr>
                                    <td> {{ $student->id }} </td>
                                    <td> {{ $student->name }} </td>
                                    <td> {{ $student->age }} </td>
                                    <td> {{ $student->gender }} </td>
                                    <td> {{ $student->teacher->name }} </td>
                                    <td> {{ $student->gender }} </td>
                                    <td>
                                        <a href="{{ route('students.edit', $student->id)}}">
                                            <button type="button" class="btn btn-success btn-sm">Edit</button>
                                        </a>
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-sm btn-danger" value="delete">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="3">
                                        There are no upcoming rides.
                                    </td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
