@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
      <div class="col">
          <div class="card">
              <div class="card-header">{{ __('User detail') }}</div>

              <div class="card-body">
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                    <div class="col-md-6">
                      <p class="py-2">
                        {{ $user->name }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                    <div class="col-md-6">
                      <p class="py-2">
                        {{ $user->email }}
                      </p>
                    </div>
                </div>

                <div class="row mb-3">
                  <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Created at') }}</label>

                  <div class="col-md-6">
                    <p class="py-2">
                      {{ $user->created_at }}
                    </p>
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Updated at') }}</label>

                  <div class="col-md-6">
                    <p class="py-2">
                      {{ $user->updated_at }}
                    </p>
                  </div>
                </div>
              </div>

            </div>
        </div>
        
    </div>
</div>

@endsection