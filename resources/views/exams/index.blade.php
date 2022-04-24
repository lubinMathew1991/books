@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Students') }}
                    <a class="btn btn-sm btn-success" href="{{ route('exams.create') }}" style="float:right;">Create</a>
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
                                @foreach ($subjects as $sub)
                                    <th scope="col">{{ $sub->subject }}</th>
                                @endforeach
                                <th scope="col">Term</th>
                                <th scope="col">Total Marks</th>
                                <th scope="col">Created On</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($exams as $exam)
                          
                                <tr>
                                    <td> {{ $exam['id'] }} </td>
                                    <td> {{ $exam['students']['name'] }} </td>
                                        @php $totalMarks = 0 ;@endphp
                                        @foreach ($subjects as $key => $sub)
                                            <td> 
                                                {{ $exam['marks'][$key]['mark'] ?? '0'   }} 
                                            </td>
                                            @php $totalMarks += $exam['marks'][$key]['mark'] ?? 0 ;@endphp
                                        @endforeach

                                    <td> {{ $exam['term'] }} </td>
                                    <td> {{  $totalMarks }} </td>
                                    <td> {{ date('M d, Y H:i A', strtotime($exam['created_at'])) }} </td>
                                    
                                    <td>
                                        <a href="{{ route('exams.edit', $exam['id'])}}">
                                            <button type="button" class="btn btn-success btn-sm">Edit</button>
                                        </a>
                                        <form action="{{ route('exams.destroy', $exam['id']) }}" method="POST" onsubmit="return confirm('Are you sure');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-sm btn-danger" value="delete">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="3">
                                        There are no exams
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
