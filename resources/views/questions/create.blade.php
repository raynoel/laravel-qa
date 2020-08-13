@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <!-- Entète -->
          <div class="d-flex align-items-center">
            <h2>Ask Question</h2>
            <div class="ml-auto">
              <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all Questions</a>
            </div>
          </div>
        </div>

        <div class="card-body">
          <!-- Formulaire --> 
          <form action="{{ route('questions.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="question-title">Question Title</label>
              <input type="text" name="title" id="question-title" class="form-control" value="{{ old('title') ?? $question->title}}">
              <p class="text-danger">{{ $errors->first('title') }}</p>
            </div>
            <div class="form-group">
              <label for="question-body">Explain your question</label>
              <textarea name="body" id="question-body" rows="10" class="form-control" value="{{ old('body') ?? $question->body}}"></textarea>
              <p class="text-danger">{{ $errors->first('body') }}</p>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-outline-primary btn-lg">Ask this Question</button>
            </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
</div>
@endsection