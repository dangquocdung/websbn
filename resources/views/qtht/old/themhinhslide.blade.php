@extends('qtht.layouts.home')

@section('content')

        <div class="panel panel-default">

          <div class="panel-heading"><strong>Thêm hình slide</strong></div>

          <div class="panel-body">
            {!! Form::open(['method'=>'POST','url'=>'qtht/hinh-slide/them-hinh-slide','enctype'=>'multipart/form-data']) !!}
              <input type="hidden" name="_token" value="{{csrf_token()}}"/>
              <div class="modal-body">

                <div class="form-group">
                  <label>Tiêu đề</label>
                  <input type="text" class="form-control" name="tieude" value="{{ old('tieude')}}" placeholder="Nhập Tiêu đề" required="">
                </div>

                <div class="form-group">
                    <label>Hình Ảnh</label>
                    <p style="font-style:italic;"><small>(độ phân giải tốt nhất 960x430px)</small></p>

                    <img src="http://placehold.it/100x100" id="showimages" >
                    <input type="file" name="hinh" id="inputimages" required="" />
                </div>

                <div class="form-group">
                  <label>Thứ tự hiển thị</label>
                  <select class="form-control" name="thutu" required="">
                    @for ($i = 1; $i < 10; $i++)
                      <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                  </select>
                </div>

                <div class="form-group">
                  <label>Ghi chú</label>
                  <input class="form-control" name="ghichu" value="{{ old('ghichu')}}" placeholder="Nhập ghi chú"/>
                </div>



              </div>

              <div class="modal-footer">
                <input type="submit" name="publish" value="Đăng" class="btn btn-primary" >
              </div>
              {!! Form::close() !!}
          </div>
        </div>



@endsection
