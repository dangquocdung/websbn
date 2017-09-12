@extends('front.layouts.home')
@section('title')
  <title>Đặt câu hỏi đến BBT</title>
@endsection
@section('content')
  <div class="list-group">
    <div  class="list-group-item active main-color-bg in-hoa-dam">
      <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> &nbspĐặt câu hỏi đến BBT

      <p class="pull-right visible-xs" >
        <a data-toggle="offcanvas" style="color:red">
          <span class="glyphicon glyphicon-forward site-logo" aria-hidden="true"></span>
        </a>
      </p>
    </div>
    <div class="list-group-item">
      <div class="row">
        {!! Form::open(['method'=>'POST','url'=>'dat-cau-hoi']) !!}
          <input type="hidden" name="_token" value="{{csrf_token()}}"/>

          <div class="modal-body">

            <div class="form-group">
              <label>Họ tên</label>
              <input type="text" class="form-control" name="hoten" placeholder="Nhập Họ tên" required="">
            </div>

            <div class="form-group">
              <label>Địa chỉ</label>
              <input type="text" class="form-control" name="diachi" placeholder="Nhập Địa chỉ" required="">
            </div>

            <div class="form-group">
              <label>Điện thoại</label>
              <input type="text" class="form-control" name="dienthoai" placeholder="Nhập số điện thoại" required="">
            </div>

            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" name="email" placeholder="Nhập địa chỉ email" required="">
            </div>

            <div class="form-group">
              <label>Tiêu đề câu hỏi</label>
              <input type="text" class="form-control" name="tieude" placeholder="Nhập Tiêu đề câu hỏi" required=""/>
            </div>

            <div class="form-group">
                <label>Nội dung câu hỏi</label>
                <textarea name="noidung" id="noidung" class="form-control" rows="10">{{ old('noidung')}}</textarea>
            </div>

          </div>

          <div class="modal-footer">
            <input onclick="return confirm('Cảm ơn bạn đã đặt câu hỏi đến BTT. Chúng tôi cần kiểm duyệt thông tin trước khi đăng tải và trả lời bạn trong thời gian sớm nhất. Bạn muốn tiếp tục?')" type="submit" value="Gởi đến Ban biên tập" class="btn btn-primary" >
          </div>
          {!! Form::close() !!}
      </div>
    </div>
  </div>

@endsection
