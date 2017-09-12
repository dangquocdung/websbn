@extends('qtht.layouts.home')

@section('content')

        <div class="panel panel-default">

          <div class="panel-heading"><strong>Sửa Lịch công tác</strong></div>

          <div class="panel-body">
            {!! Form::open(['method'=>'POST','url'=>'qtht/lich-cong-tac/sua-lich-cong-tac']) !!}
              <input type="hidden" name="_token" value="{{csrf_token()}}"/>
              
              <input type="hidden" name="id" value="{{ $lct->id }}"/>

              <div class="modal-body">


                <div class="form-group">
                  <label>Ngày</label>
                  <input type="date" class="form-control" name="ngay" value="{{ $lct->ngay }}{{ old('ngay')}}" placeholder="Chọn ngày" required="">
                </div>

                <div class="form-group">
                  <label>Giờ</label>
                  <input type="time" class="form-control" name="gio" value="{{ $lct->gio }}{{ old('gio')}}" placeholder="Chọn giờ" required="">
                </div>

                <div class="form-group">
                  <label>Nội dung</label>
                  <input type="text" class="form-control" name="tieude" value="{{ $lct->tieude }}{{ old('tieude')}}" placeholder="Nội dung..." required="">
                </div>

                <div class="form-group">
                  <label>Thành phần</label>
                  <input type="text" class="form-control" name="thanhphan" value="{{ $lct->thanhphan }}{{ old('thanhphan')}}" placeholder="Thành phần..." required="">
                </div>

                <div class="form-group">
                  <label>Địa điểm</label>
                  <input type="text" class="form-control" name="diadiem" value="{{ $lct->diadiem }}{{ old('diadiem')}}" placeholder="Địa điểm..." required="">
                </div>







              </div>

              <div class="modal-footer">
                <input type="submit" value="Cập nhật" class="btn btn-primary" >
              </div>
              {!! Form::close() !!}
          </div>
        </div>



@endsection
