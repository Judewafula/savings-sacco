@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create New Account') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('accounts.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="account_number">{{ __('Account Number') }}</label>
                                <input id="account_number" type="text" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ old('account_number') }}" required>
                                @error('account_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="balance">{{ __('Balance') }}</label>
                                <input id="balance" type="number" step="0.01" class="form-control @error('balance') is-invalid @enderror" name="balance" value="{{ old('balance') }}" required>
                                @error('balance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Add more fields as needed -->

                            <button type="submit" class="btn btn-primary">
                                {{ __('Create Account') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
