@extends('layouts.app')

@section('content')
<div class="container">
  <!-- Affiche le message dans $_SESSION['success'] -->
  @if (session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <b class="mr-3">Success</b> {{ session()->get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
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
        <!-- carte avec une question -->
        <div class="card-body">
          @foreach ($questions as $question)
            <div class="media">
              <!-- 3 Compteurs -->
              <div class="d-flex flex-column counters">
                <div class="vote">
                  <strong>{{ $question->votes }}</strong> {{ Str::plural('vote', $question->votes)}}
                </div>
                <div class="status {{ $question->status }}">
                  <strong>{{ $question->answers_count }}</strong> {{ Str::plural('answer', $question->answers_count) }}
                </div>
                <div class="view">
                  {{ $question->views }} {{ Str::plural('view', $question->views) }}
                </div>
              </div>
              
              <div class="media-body">
                <div class="d-flex align-items-center">
                  <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title }}</a></h3><!-- url n'est pas une variable de $question... elle sera défini dans le model -->
                  <!-- boutons edit & delete -->
                  @if (Auth::user())                                   <!-- visible seulement pour les usagés logés -->
                  <div class="ml-auto">
                
                    <!-- bouton edit -->
                    @if (Auth::user()->can('update', $question))      <!-- visible ssi la restriction de QuestionPolicy est remplie -->
                      <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
                    @endif
                
                    <!-- bouton delete -->
                    @can ('update', $question)                        <!-- visible ssi la restriction de QuestionPolicy est remplie -->
                      <form action="{{ route('questions.destroy', $question->id) }}" class="form-delete" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                      </form>
                    @endcan
                
                  </div>
                  @endif
                </div>
                <!-- Auteur -->
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