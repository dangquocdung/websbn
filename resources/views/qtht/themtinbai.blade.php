@extends('front.layouts.home')

@section('title')
  <title>Thêm Tin - Bài | {{ config('app.name', 'Dang Quoc Dung') }}</title>
@endsection

@section('menu-ngang')
  @include('qtht.layouts.menu-ngang')
@endsection
@section('content')
  <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading"><strong>Thêm tin/bài</strong></div>
          <div class="panel-body">
            {!! Form::open(['method'=>'POST','url'=>'qtht/them-tin-bai','enctype'=>'multipart/form-data']) !!}
              <input type="hidden" name="_token" value="{{csrf_token()}}"/>
              <div class="modal-body">
                <div class="form-group">
                  <label>Loại tin</label>
                  <select class="form-control" name="loaitin_id" required="">
                    @foreach ($chuyenmuc as $cm)
                      @if ($cm->id < 3 || $cm->id == 4)
                        @foreach ($cm->loaitin as $lt)
                        <option value="{{ $lt->id}}">{{ $lt->menutop->ten}} | {{ $lt->ten}}</option>
                        @endforeach
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Tiêu đề</label>
                  <input type="text" class="form-control" name="tieude" value="{{ old('tieude')}}" placeholder="Nhập Tiêu đề" required="">
                </div>
                <div class="form-group">
                  <label>Tin nổi bật</label> &nbsp;
                  <input type="checkbox" name="tinnoibat">
                </div>
                <div class="form-group">
                  <label>Tóm tắt</label>
                  <input type="text" class="form-control" name="tomtat" rows="3" value="{{ old('tomtat')}}" placeholder="Nhập tóm tắt" required=""/>
                </div>
                <div class="form-group">
                    <label>Hình Ảnh</label>
                    <img src="http://placehold.it/100x100" id="showimages" >
                    <input type="file" name="urlhinh" id="inputimages"/>
                </div>
                <div class="form-group">
                    <label>Nội dung</label>
                    <textarea name="noidung" id="noidung" class="form-control" rows="10">{{ old('noidung')}}</textarea>
                </div>
                <div class="form-group">
                  <label>Ghi chú</label>
                  <input class="form-control" name="ghichu" value="{{ old('ghichu')}}" placeholder="Nhập ghi chú"/>
                </div>
              </div>
              <div class="modal-footer">
                <input type="submit" value="Đăng" class="btn btn-primary" >
              </div>
              {!! Form::close() !!}
          </div>
        </div>
</div>
@endsection
