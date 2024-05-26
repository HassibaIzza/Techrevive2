<!-- resources/views/status.blade.php -->
<style>
  /* resources/css/app.css */

.progress {
    height: 20px;
    margin-bottom: 20px;
}

.progress-bar {
    transition: width 0.6s ease;
}

.bg-success {
    background-color: #28a745 !important;
}

  </style>


@section('content')
<div class="container">
    <h1>État de la réparation</h1>
    <div class="progress">
        @if($status === 0)
            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="2"></div>
        @elseif($status === 1)
            <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="2"></div>
            <div class="progress-bar bg-success" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="2"></div>
        @else
            <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="2"></div>
        @endif
    </div>
</div>

