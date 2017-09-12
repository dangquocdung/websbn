@extends('qtht.layouts.home')

@section('content')

        <div class="panel panel-default">

          <div class="panel-heading"><strong>Thêm văn bản</strong></div>

          <div class="panel-body">
            {!! Form::open(['method'=>'POST','url'=>'qtht/van-ban/them-van-ban','enctype'=>'multipart/form-data']) !!}
              <input type="hidden" name="_token" value="{{csrf_token()}}"/>
              <div class="modal-body">
                <div class="form-group">
                  <label>Chọn chuyên mục văn bản</label>
                  <select class="form-control" name="menuvb_id" required="">
                    @foreach ($menuvb as $lt)
                      <option value="{{ $lt->id}}">{{ $lt->ten}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label>Loại văn bản</label>
                  <select class="form-control" name="loaivb_id" required="">
                    @foreach ($loaivb as $lvb)
                      <option value="{{ $lvb->id}}">{{ $lvb->ten }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label>Số, kí hiệu</label>
                  <input type="text" class="form-control" name="sovb" value="{{ old('sovb')}}" placeholder="Số, kí hiệu văn bản" required="">
                </div>

                <div class="form-group">
                  <label>Trích yếu văn bản</label>
                  <input type="text" class="form-control" name="trichyeuvb" value="{{ old('trichyeuvb')}}" placeholder="Trích yếu văn bản" required=""/>
                </div>

                <div class="form-group">
                    <label>Tệp văn bản (đính kèm)</label>

                    <input type="file" name="tepvanban" required=""/>
                </div>

                <div class="form-group">
                  <label>Ngày ban hành</label>
                  <input type="date" class="form-control" name="ngaybanhanhvb" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required=""/>
                </div>

                <div class="form-group">
                  <label>Người kí</label>
                  <input class="form-control" name="nguoiki" value="{{ old('nguoiki')}}" placeholder="Người kí văn bản..." required=""/>
                </div>

              </div>

              <div class="modal-footer">
                <input type="submit" value="Đăng" class="btn btn-primary" >
              </div>
              {!! Form::close() !!}
          </div>
        </div>



@endsection
