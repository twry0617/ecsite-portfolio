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
                <div class="card-header">{{ __('新規登録招待') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('manager.invitation') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <h4 class="col-md-4 col-form-label text-md-right">{{$email}}</h4>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('申請許可') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection