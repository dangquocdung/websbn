@extends('qtht.layouts.home')

@section('content')

        <div class="panel panel-default">

          <div class="panel-heading"><strong>Thêm Chuyên mục</strong></div>

          <div class="panel-body">
            {!! Form::open(['method'=>'POST','url'=>'qtht/chuyen-muc/sua-chuyen-muc']) !!}
              <input type="hidden" name="_token" value="{{csrf_token()}}"/>
              <input type="hidden" name="id" value="{{ $chuyenmuc->id }}}"/>

              <div class="modal-body">
                <div class="form-group">
                  <label>Chuyên mục</label>
                  <input type="text" class="form-control" name="ten" value="{{ $chuyenmuc->ten }}{{ old('ten')}}" placeholder="Nhập Tên Loại tin" required="">

                </div>

                <div class="form-group">
                  <label>Thứ tự hiển thị</label>
                  <select class="form-control" name="thutu" required="">
                    @for ($i = 1; $i < 10; $i++)
                      @if ($chuyenmuc->thutu == $i )
                        <option value="{{ $i }}" selected="">{{ $i }}</option>
                      @else
                        <option value="{{ $i }}">{{ $i }}</option>
                      @endif
                    @endfor
                  </select>
                </div>


                <div class="form-group">
                  <label>Ghi chú</label>
                  <input class="form-control" name="ghichu" value="{{ $chuyenmuc->ghichu }}{{ old('ghichu')}}" placeholder="Nhập ghi chú"/>
                </div>



              </div>

              <div class="modal-footer">
                <input type="submit" value="Lưu" class="btn btn-primary" >
              </div>
              {!! Form::close() !!}
          </div>
        </div>



@endsection
