@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <!-- Entète -->
          <div class="d-flex align-items-center">
            <h2>{{ $question->title }}</h2>
            <div class="ml-auto">
              <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to All Questions</a>
            </div>
          </div>
        </div>
        <!-- carte avec une question -->
        <div class="card-body">
          {{ $question->body }}


        </div>
      </div>
    </div>
  </div>
</div>
@endsection