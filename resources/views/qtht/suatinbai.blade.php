@extends('front.layouts.home')
@section('menu-ngang')
  @include('qtht.layouts.menu-ngang')
@endsection
@section('content')
  <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading"><strong>Sửa tin/bài</strong></div>
          <div class="panel-body">
            {!! Form::open(['method'=>'POST','url'=>'qtht/sua-tin-bai/','enctype'=>'multipart/form-data']) !!}
              <input type="hidden" name="_token" value="{{csrf_token()}}"/>
              <input type="hidden" name="tintuc_id" value="{{ $tintuc->id }}"/>
              <div class="modal-body">
                <div class="form-group">
                  <label>Loại tin</label>
                  <select class="form-control" name="loaitin_id" required="">
                    @foreach ($chuyenmuc as $cm)
                      @if ($cm->id < 3 || $cm->id == 4)
                        @foreach ($cm->loaitin as $lt)
                          @if ($tintuc->loaitin_id == $lt->id )
                            <option value="{{ $lt->id}}" selected="">{{ $lt->menutop->ten}} | {{ $lt->ten}}</option>
                          @else
                            <option value="{{ $lt->id}}">{{ $lt->menutop->ten}} | {{ $lt->ten}}</option>
                          @endif
                        @endforeach
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Tiêu đề</label>
                  <input type="text" class="form-control" name="tieude" value="{{ $tintuc->tieude }}" required="">
                </div>
                <div class="form-group">
                  <label>Tin nổi bật</label> &nbsp;
                  @if ( $tintuc->tinnoibat == 1)
                    <input type="checkbox" name="tinnoibat" checked >
                  @else
                    <input type="checkbox" name="tinnoibat">
                  @endif
                </div>
                <div class="form-group">
                  <label>Tóm tắt</label>
                  <input type="text" class="form-control" name="tomtat" rows="3" value="{{ $tintuc->tomtat }}" required=""/>
                </div>
                <div class="form-group">
                    <label>Hình Ảnh</label>
                    <img src="{{ $tintuc->urlhinh }}" id="showimages" >
                    <input type="file" name="urlhinh" id="inputimages" />
                </div>
                <div class="form-group">
                    <label>Nội dung</label>
                    <textarea name="noidung" id="noidung" class="form-control" rows="10">
                      {!! $tintuc->noidung !!}
                    </textarea>
                </div>
                <div class="form-group">
                  <label>Ghi chú</label>
                  <input class="form-control" name="ghichu" rows="3" value="{{ $tintuc->ghichu }}"/>
                </div>
              </div>
              <div class="modal-footer">
                @if ( Auth::user()->is_admin() )
                  <input type="submit" name="capnhat" value="Cập nhật" class="btn btn-success" >
                  <input type="submit" name="duyetdang" value="Duyệt Đăng" class="btn btn-primary" >
                @elseif ( Auth::user()->is_tbbt() )
                  <input type="submit" name="duyetdang" value="Duyệt Đăng" class="btn btn-primary" >
                @elseif ( $tintuc->user_id == Auth::user()->id )
                  <input type="submit" name="capnhat" value="Cập nhật" class="btn btn-success" >
                @endif
              </div>
              {!! Form::close() !!}
          </div>
        </div>
</div>
@endsection
