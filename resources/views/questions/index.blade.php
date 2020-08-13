@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">All Questions</div>
        <div class="card-body">
          @foreach ($questions as $question)
            <div class="media">
              <!-- Compteurs -->
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