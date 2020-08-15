@csrf

<div class="form-group">
  <label for="question-title">Question Title</label>
  <input type="text" name="title" id="question-title" class="form-control" value="{{ old('title', $question->title) }}">
  <p class="text-danger">{{ $errors->first('title') }}</p>
</div>

<div class="form-group">
  <label for="question-body">Explain your question</label>
  <textarea name="body" id="question-body" rows="10" class="form-control">{{ old('body') ?? $question->body}}</textarea>
  <p class="text-danger">{{ $errors->first('body') }}</p>
</div>
<input type="hidden" name="user_id" value="{{ $user->id }}">

<div class="form-group">
  <button type="submit" class="btn btn-outline-primary btn-lg">{{ $buttonText }}</button>
</div>