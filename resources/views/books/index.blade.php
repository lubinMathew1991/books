@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Books') }}
                <a class="btn btn-sm btn-primary" style="float:right; margin-left:5px;" href="{{ route('books.import') }}">Import</a>
                <a class="btn btn-sm btn-success" style="float:right;" href="{{ route('books.create') }}">Create</a>
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
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Description</th>
                                <th scope="col">Year</th>
                                <th scope="col">Cover Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($books as $book)
                                <tr>
                                    <td width="10%"> {{ $book->title }} </td>
                                    <td width="10%"> {{ $book->author }} </td>
                                    <td width="35%"> {{ $book->description }} </td>
                                    <td> {{ $book->publication_year }} </td>
                                    <td width="10%">
                                        @if ($book->cover_image)
                                            <img width="50%" height="50%" src="{{asset('cover_image/'. $book->cover_image)}}">
                                        @endif
                                    </td>
                                    <td >
                                        <a href="{{ route('books.edit', $book->id)}}">
                                            <button type="button" class="btn btn-success btn-sm">Edit</button>
                                        </a>
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-sm btn-danger" value="delete">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="6">
                                        There are no Books.
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
