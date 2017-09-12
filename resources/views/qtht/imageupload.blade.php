@extends('front.layouts.home')

@section('menu-ngang')
  @include('qtht.layouts.menu-ngang')
@endsection

@section('content')
  <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading  in-hoa-dam">
          <strong>Tải hình ảnh từ máy tính</strong>
        </div>

        <div class="panel-body">
          <div class="container">
            @if (Session::has('success'))
              <div class="alert-box-success">
                <p>{!! Session::get('success') !!}</p>
              </div>
            @endif

            @if (Session::has('message'))
              <div class="alert-box-success">
                <p>{!! Session::get('message') !!}</p>
              </div>
            @endif


            <div class="form-group">
              {!! Form::open(array('url'=>'qtht/thu-vien-hinh-anh/files-upload', 'method'=>'POST', 'files'=>true))!!}
              {!! Form::file('images[]', array('multiple'=>true)) !!}
              <p>{!! $errors->first('images') !!}</p>
              @if (Session::has('error'))
                <p>{!! Session::get('error') !!}</p>
              @endif
              {!! Form::submit('Tải lên', array('class'=>'btn btn-primary')) !!}
              {!! Form::close() !!}
            </div>
          </div>
          {{-- <div style="padding-bottom:10px">
            <a class="btn btn-primary" href="/qtht/video-clip/them-video"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thư viện hình ảnh</a>
          </div> --}}

          {{-- <div class="table-responsive">
            <table class="table table-striped table-hover">
              <tr>
                <th>TT</th>
                <th>Tiêu đề</th>
                <th>Video</th>
                <th>Thứ tự hiện thị</th>
                <th>Thao tác</th>
              </tr>
              @foreach ($videos as $video)
              <tr>
                <td>{{ $video->id }}</td>
                <td style="text-align:left;">{{ $video->tieude }}</td>

                <td>
                  <div class="video-container">
                    {!! $video->videoclip !!}
                  </div>
                </td>

                <td>{{ $video->thutu }}</td>

                <td style="text-align: center;">
                  <form action="#" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <a href="{{ url('qtht/video-clip/sua-video/'.$video->id) }}" class="btn btn-warning btn-xs">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>

                    <a href="{{ url('qtht/video-clip/xoa-video/'.$video->id.'?token='.csrf_token()) }}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn chắc chắn muốn xoá video này?')">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </form>
                </td>
              </tr>

              @endforeach
            </table>
          </div> --}}

        </div>
    </div>
    <div class="list-group">
      <a  class="list-group-item active main-color-bg">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Thư viện hình ảnh
      </a>
      <div class="list-group-item">
        @if (Session::has('error-xoahinh'))
          <div class="alert-box-success">
            <p>{!! Session::get('error-xoahinh') !!}</p>
          </div>
        @endif
        <div class="row">


          @foreach ($images as $video)
            <div class="col-md-4">
              {{-- <div class="gallery">
                <a target="_blank" href="fjords.jpg">
                  <img src="/uploads/{{ $video->original_filename }}" alt="{{ $video->original_filename }}" width="100%">
                </a>
                <div class="desc">{{ $video->original_filename }}</div>
              </div> --}}
              {{-- <div class="video-container" style="margin-bottom:10px">
                <img src="/uploads/{{ $video->original_filename }}" alt="" width="100%">
              </div> --}}

              <div class="img-wrapper" style="max-height:200px">
                <img class="img-responsive" src="/uploads/{{ $video->original_filename }}">
                <div class="img-overlay">
                  {{-- <button type="button" class="btn btn-md btn-success" data-clipboard-text="/uploads/{{ $video->original_filename }}">Copy</button> --}}
                  <a href="/uploads/{{ $video->original_filename }}" class="btn btn-md btn-success" target="_blank">
                    <span class="glyphicon glyphicon-eyes"></span> Xem ảnh
                  </a>
                  {{-- <button type="button" class="btn btn-md btn-danger">Xóa ảnh</button> --}}
                  <a href="{{ url('qtht/thu-vien-hinh-anh/xoa-hinh-anh/'.$video->id.'?token='.csrf_token()) }}" class="btn btn-md btn-danger" onclick="return confirm('Bạn chắc chắn muốn xoá hình ảnh này?')">
                    <span class="glyphicon glyphicon-trash"></span> Xóa ảnh
                  </a>
                </div>
              </div>

              {{-- <div class="img-wrapper">
                  <img src="/uploads/{{ $video->original_filename }}" class="img-responsive" alt="this is a title">
                  <div class="overlay">
                      <div class="buttons">
                          <a rel="gallery" class="fancybox" href="/uploads/{{ $video->original_filename }}">Demo</a>
                          <a target="_blank" href="single-portfolio.html">Details</a>
                      </div>
                  </div>
              </div> --}}
            </div>
          @endforeach
        </div>

      </div>
    </div>
  </div>
@endsection
