  <!-- Affiche le message dans $_SESSION['success'] -->
  @if (session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <b class="mr-3">Success</b> {{ session()->get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif