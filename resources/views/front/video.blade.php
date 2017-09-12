@extends('front.layouts.home')
@section('content')

    <div class="list-group">
      <a  class="list-group-item active main-color-bg in-hoa-dam">
        <i class="fa fa-youtube" aria-hidden="true"></i></span> Video clip
      </a>
      <div class="list-group-item">
        <div class="row">
          @foreach ($videos as $video)
            <div class="col-md-4">
              <div class="video-container" style="margin-bottom:10px">
                {!! $video->videoclip !!}
              </div>
            </div>
          @endforeach
      </div>
    </div>
    </div>
  
@endsection
