@extends('layouts.app')

@section('content')
<div class="container">
  <!-- Affiche le message dans $_SESSION['success'] -->
  @if (session()->has('success'))
  <div class="alert alert-success" role="alert">
    <strong>Success</strong> {{ session()->get('success') }}
  </div>
  @endif

  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <!-- Entète -->
          <div class="d-flex align-items-center">
            <h2>All Questions</h2>
            <div class="ml-auto">
              <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Ask Question</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          @foreach ($questions as $question)
            <div class="media">
              <!-- 3 Compteurs -->
              <div class="d-flex flex-column counters">
                <div class="vote">
                  <strong>{{ $question->votes }}</strong> {{ Str::plural('vote', $question->votes)}}
                </div>
                <div class="status {{ $question->status }}">
                  <strong>{{ $question->answers }}</strong> {{ Str::plural('answer', $question->answers) }}
                </div>
                <div class="view">
                  {{ $question->views }} {{ Str::plural('view', $question->views) }}
                </div>
              </div>

              <div class="media-body">
                <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title }}</a></h3><!-- on défini url dans le model -->
                <!-- Autheur -->
                <p class="lead">Asked by 
                    <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                    <small class="text-muted">{{ $question->created_date }}</small><!-- On défini created_at dans le model -->
                  </p>
                {{ Str::limit($question->body, 250) }}
              </div>
            </div>
            <hr>
          @endforeach

          <div class="row">
            <div class="col-12 d-flex justify-content-center pt-4">
              {{ $questions->links() }}
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection