@extends('qtht.layouts.home')

@section('content')

        <div class="panel panel-default">

          <div class="panel-heading"><strong>Sửa văn bản</strong></div>

          <div class="panel-body">
            {!! Form::open(['method'=>'POST','url'=>'qtht/van-ban/sua-van-ban','enctype'=>'multipart/form-data']) !!}
              <input type="hidden" name="_token" value="{{csrf_token()}}"/>
              <input type="hidden" name="id" value="{{ $vb->id }}"/>

              <div class="modal-body">
                <div class="form-group">
                  <label>Chuyên mục văn bản</label>
                  <select class="form-control" name="menuvb_id" required="">


                    @foreach ($menuvb as $lt)
                      @if ($vb->menuvb_id == $lt->id)
                        <option value="{{ $lt->id}}" selected="">{{ $lt->ten}}</option>
                      @else
                        <option value="{{ $lt->id}}">{{ $lt->ten}}</option>
                      @endif
                    @endforeach

                  </select>
                </div>

                <div class="form-group">
                  <label>Loại văn bản</label>
                  <select class="form-control" name="loaivb_id" required="">
                    @foreach ($loaivb as $lvb)
                      @if ($vb->loaivb_id == $lvb->id)
                        <option value="{{ $lvb->id}}" selected="">{{ $lvb->ten }}</option>
                      @else
                        <option value="{{ $lvb->id}}">{{ $lvb->ten }}</option>
                      @endif

                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label>Số, kí hiệu</label>
                  <input type="text" class="form-control" name="sovb" value="{{ $vb->sovb }}{{ old('sovb')}}" placeholder="Số, kí hiệu văn bản" required="">
                </div>

                <div class="form-group">
                  <label>Trích yếu văn bản</label>
                  <input type="text" class="form-control" name="trichyeuvb" value="{{ $vb->trichyeuvb }}{{ old('trichyeuvb')}}" placeholder="Trích yêu văn bản" required=""/>
                </div>

                <div class="form-group">
                    <label>Tệp văn bản (đính kèm)</label>
                    <br>
                    <a href="{{$vb->tepvanban}}" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp{{ $vb->sovb }}</a>
                    <input type="file" name="tepvanban"/>
                </div>

                <div class="form-group">
                  <label>Ngày ban hành</label>
                  <input type="date" class="form-control" name="ngaybanhanhvb" value="{{ $vb->ngaybanhanhvb }}{{ old('ghichu')}}" required=""/>
                </div>

                <div class="form-group">
                  <label>Người kí</label>
                  <input class="form-control" name="nguoiki" value="{{ $vb->nguoiki }}{{ old('nguoiki')}}" placeholder="Người kí văn bản..." required=""/>
                </div>

              </div>

              <div class="modal-footer">
                @if ( Auth::user()->is_admin() )
                  <input type="submit" name="capnhat" value="Cập nhật" class="btn btn-success" >
                  <input type="submit" name="duyetdang" value="Duyệt Đăng" class="btn btn-primary" >
                @elseif ( Auth::user()->is_tbbt() )
                  <input type="submit" name="duyetdang" value="Duyệt Đăng" class="btn btn-primary" >
                @elseif ( $vb->user_id == Auth::user()->id )
                  <input type="submit" name="capnhat" value="Cập nhật" class="btn btn-success" >
                @endif
              </div>
              {!! Form::close() !!}
          </div>
        </div>



@endsection
