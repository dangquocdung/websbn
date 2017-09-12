@extends('qtht.layouts.home')

@section('content')

        <div class="panel panel-default">

          <div class="panel-heading"><strong>Sửa video</strong></div>

          <div class="panel-body">
            {!! Form::open(['method'=>'POST','url'=>'qtht/video-clip/sua-video']) !!}
              <input type="hidden" name="_token" value="{{csrf_token()}}"/>
              <input type="hidden" name="id" value="{{ $video->id }}"/>

              <div class="modal-body">

                <div class="form-group">
                  <label>Tiêu đề</label>
                  <input type="text" class="form-control" name="tieude" value="{{ $video->tieude }}" placeholder="Nhập Tiêu đề" required="">
                </div>

                <div class="form-group">
                  <label>Mã nhúng youtube của video</label>
                  <input type="text" class="form-control" name="videoclip" value="{{ $video->videoclip }}" placeholder="Nhập youtube embed code" required="">
                </div>

                <div class="form-group">
                  <label>Thứ tự hiển thị</label>
                  <select class="form-control" name="thutu" required="">
                    @for ($i = 1; $i < 10; $i++)
                      @if ($i== $video->thutu)
                        <option value="{{ $i }}" selected="">{{ $i }}</option>
                      @else
                        <option value="{{ $i }}">{{ $i }}</option>
                      @endif
                    @endfor
                  </select>
                </div>

                <div class="form-group">
                  <label>Ghi chú</label>
                  <input class="form-control" name="ghichu" value="{{ $video->ghichu }}" placeholder="Nhập ghi chú"/>
                </div>

              </div>

              <div class="modal-footer">
                <input type="submit" name="publish" value="Đăng" class="btn btn-primary" >
              </div>
              {!! Form::close() !!}
          </div>
        </div>



@endsection
