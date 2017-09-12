@extends('qtht.layouts.home')

@section('content')

        <div class="panel panel-default">

          <div class="panel-heading"><strong>Sửa Loại tin</strong></div>

          <div class="panel-body">
            {!! Form::open(['method'=>'POST','url'=>'qtht/menu/sua-loai-tin']) !!}
              <input type="hidden" name="_token" value="{{csrf_token()}}"/>
              <input type="hidden" name="id" value="{{ $loaitin->id }}"/>

              <div class="modal-body">
                <div class="form-group">
                  <label>Chuyên mục</label>
                  <select class="form-control" name="menutop_id" required="">
                    @foreach ($chuyenmuc as $cm)
                      @if($loaitin->menutop_id == $cm->id)
                        <option value="{{ $cm->id}}" selected="">{{ $cm->ten}}</option>
                      @else
                        <option value="{{ $cm->id}}">{{ $cm->ten}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label>Loại Tin</label>
                  <input type="text" class="form-control" name="ten" value="{{ $loaitin->ten }}{{ old('ten')}}" placeholder="Nhập Tên Loại tin" required="">

                </div>

                <div class="form-group">
                  <label>Thứ tự hiển thị</label>
                  <select class="form-control" name="thutu" required="">
                    @for ($i = 1; $i < 10; $i++)
                      @if ($i== $loaitin->thutu)
                        <option value="{{ $i }}" selected="">{{ $i }}</option>
                      @else
                        <option value="{{ $i }}">{{ $i }}</option>
                      @endif
                    @endfor
                  </select>
                </div>


                <div class="form-group">
                  <label>Ghi chú</label>
                  <input class="form-control" name="ghichu" value="{{ $loaitin->ghichu }}{{ old('ghichu')}}" placeholder="Nhập ghi chú"/>
                </div>



              </div>

              <div class="modal-footer">
                <input type="submit" value="Cập nhật" class="btn btn-primary" >
              </div>
              {!! Form::close() !!}
          </div>
        </div>



@endsection
