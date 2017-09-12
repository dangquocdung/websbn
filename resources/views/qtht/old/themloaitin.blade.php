@extends('qtht.layouts.home')

@section('content')

        <div class="panel panel-default">

          <div class="panel-heading"><strong>Thêm Loại tin</strong></div>

          <div class="panel-body">
            {!! Form::open(['method'=>'POST','url'=>'qtht/menu/them-loai-tin','enctype'=>'multipart/form-data']) !!}
              <input type="hidden" name="_token" value="{{csrf_token()}}"/>
              <div class="modal-body">
                <div class="form-group">
                  <label>Chuyên mục</label>
                  <select class="form-control" name="menutop_id" required="">
                    @foreach ($chuyenmuc as $cm)
                    <option value="{{ $cm->id}}">{{ $cm->ten}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label>Loại Tin</label>
                  <input type="text" class="form-control" name="ten" value="{{ old('ten')}}" placeholder="Nhập Tên Loại tin" required="">

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
                <input type="submit" value="Thêm" class="btn btn-primary" >
              </div>
              {!! Form::close() !!}
          </div>
        </div>



@endsection
