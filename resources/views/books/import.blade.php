@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Import Books') }}
                <a class="btn btn-sm btn-success" style="float:right;" href="{{ route('books.index') }}">Back</a>
                </div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($failures = session()->get('import_errors'))
                        <div class="alert alert-danger alert-block">
                            <p>There were some errors in the imported data:</p>
                            <ul>
                                @foreach ($failures as $failure)
                                    @foreach ($failure->errors() as $key => $error)
                                        <li>
                                            {{ $error }} on row {{ $failure->row() }}
                                        </li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('books.importSave') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('File') }}</label>
                            <div class="col-md-6">
                                <input id="excel_file" type="file" class="form-control @error('excel_file') is-invalid @enderror" name="excel_file">
                                @error('excel_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
