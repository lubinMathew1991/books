@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Marks') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('exams.store') }}">
                        @csrf

                       
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Student') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('student') is-invalid @enderror" name="student">
                                    <option value="">Select Student</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('student')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Term') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('term') is-invalid @enderror" name="term">
                                    <option value="">Select Term</option>
                                    <option value="One">One</option>
                                    <option value="Two">Two</option>
                                </select>
                            </div>
                            @error('term')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        @foreach ($subjects as $key => $subject)

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ $subject->subject  .' '.  __('Mark') }}</label>

                            <div class="col-md-6">
                                <input id="mark" type="text" class="form-control @error('mark.'.$subject->id) is-invalid @enderror" name="mark[{{$subject->id}}]" value="{{ old('mark.'.$subject->id) }}"  autocomplete="age">

                                @error('mark.'.$subject->id)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @endforeach

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
