@extends('qtht.layouts.home')

@section('content')

        <div class="panel panel-default">

          <div class="panel-heading"><strong>Thêm hình slide</strong></div>

          <div class="panel-body">
            {!! Form::open(['method'=>'POST','url'=>'qtht/hinh-slide/sua-hinh-slide','enctype'=>'multipart/form-data']) !!}
              <input type="hidden" name="_token" value="{{csrf_token()}}"/>
              <input type="hidden" name="id" value="{{ $slide->id }}"/>

              <div class="modal-body">

                <div class="form-group">
                  <label>Tiêu đề</label>
                  <input type="text" class="form-control" name="tieude" value="{{ $slide->tieude }}{{ old('tieude')}}" placeholder="Nhập Tiêu đề" required="">
                </div>

                <div class="form-group">
                  <label>Hình Ảnh</label>
                  <p style="font-style:italic;"><small>(độ phân giải tốt nhất 960x430px)</small></p>
                    <img src="{{ $slide->hinh }}" id="showimages" >
                    <input type="file" name="hinh" id="inputimages" />
                </div>

                <div class="form-group">
                  <label>Thứ tự hiển thị</label>
                  <select class="form-control" name="thutu" required="">
                    @for ($i = 1; $i < 10; $i++)
                      @if ($i== $slide->thutu)
                        <option value="{{ $i }}" selected="">{{ $i }}</option>
                      @else
                        <option value="{{ $i }}">{{ $i }}</option>
                      @endif
                    @endfor
                  </select>
                </div>

                <div class="form-group">
                  <label>Ghi chú</label>
                  <input class="form-control" name="ghichu" value="{{ $slide->ghichu }}{{ old('ghichu')}}" placeholder="Nhập ghi chú"/>
                </div>



              </div>

              <div class="modal-footer">
                <input type="submit" name="publish" value="Cập nhật" class="btn btn-primary" >
              </div>
              {!! Form::close() !!}
          </div>
        </div>



@endsection
