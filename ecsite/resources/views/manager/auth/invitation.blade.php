@extends('layouts.manager.manager')

@section('content')
        @if (session('flash_message'))
            <div class="mt-2 flash_message alert-info">
                {{ session('flash_message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="mt-2 alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <div class="card mt-5">
                <div class="card-header">{{ __('supplier招待') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('manager.invitation') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('招待する') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection