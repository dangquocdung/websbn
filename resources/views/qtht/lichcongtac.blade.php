@extends('front.layouts.home')

@section('title')
  <title>Lịch công tác | {{ config('app.name', 'Dang Quoc Dung') }}</title>
@endsection

@section('menu-ngang')

  @include('qtht.layouts.menu-ngang')

@endsection


@section('content')
<div class="col-md-12">
  <div class="panel panel-default">
      <div class="panel-heading  in-hoa-dam">
        <strong>Danh sách Lịch công tác</strong>
      </div>
      <div class="panel-body">
        <div style="padding-bottom:10px">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addLCT">Thêm Lịch công tác</button>

          {{-- <a class="btn btn-primary" href="/qtht/lich-cong-tac/them-lich-cong-tac"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm Lịch công tác</a> --}}
        </div>
        <div class="table-responsive">
          <table class="table table-hover">
            <tbody>
              <tr>
                <th>Ngày</th>
                <th>Thời gian</th>
                <th>Nội dung</th>
                <th>Thành phần</th>
                <th>Địa điểm</th>
                <th>Thao tác</th>
              </tr>
              @foreach ($lichcongtac as $lct)
                <tr>
                  <td>{{ $lct->ngay }}</td>
                  <td>{{ $lct->gio }}</td>
                  <td>
                    {{ $lct->tieude }}
                  </td>
                  <td>
                    {{ $lct->thanhphan }}
                  </td>
                  <td>
                    {{ $lct->diadiem }}
                  </td>
                  <td style="text-align: center;">
                    <form action="#" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <a data-toggle="modal" data-target="#editLCT{{$lct->id}}" class="btn btn-warning btn-xs">
                        <span class="glyphicon glyphicon-edit"></span>
                      </a>
                      <a href="{{ url('qtht/lich-cong-tac/xoa-lich-cong-tac/'.$lct->id.'?token='.csrf_token()) }}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn chắc chắn muốn xoá hình Lịch công tác này?')">
                        <span class="glyphicon glyphicon-trash"></span>
                      </a>
                    </form>
                  </td>
                  <!-- Modal Sửa -->
                <div class="modal fade" id="editLCT{{$lct->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    {!! Form::open(['method'=>'POST','url'=>'qtht/lich-cong-tac/sua-lich-cong-tac']) !!}
                      <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                      <input type="hidden" name="id" value="{{ $lct->id }}"/>
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><strong>Edit Lịch công tác</strong></h4>
                      </div>

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
                </div>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
  </div>
  <!-- Modal Thêm  -->
    <div class="modal fade" id="addLCT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><strong>Thêm Lịch công tác</strong></h4>
          </div>
          {!! Form::open(['method'=>'POST','url'=>'qtht/lich-cong-tac/them-lich-cong-tac']) !!}
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="modal-body">


              <div class="form-group">
                <label>Ngày</label>
                <input type="date" class="form-control" name="ngay" value="{{ old('ngay')}}" placeholder="Chọn ngày" required="">
              </div>

              <div class="form-group">
                <label>Giờ</label>
                <input type="time" class="form-control" name="gio" value="{{ old('gio')}}" placeholder="Chọn giờ" required="">
              </div>

              <div class="form-group">
                <label>Nội dung</label>
                <input type="text" class="form-control" name="tieude" value="{{ old('tieude')}}" placeholder="Nội dung..." required="">
              </div>

              <div class="form-group">
                <label>Thành phần</label>
                <input type="text" class="form-control" name="thanhphan" value="{{ old('thanhphan')}}" placeholder="Thành phần..." required="">
              </div>

              <div class="form-group">
                <label>Địa điểm</label>
                <input type="text" class="form-control" name="diadiem" value="{{ old('diadiem')}}" placeholder="Địa điểm..." required="">
              </div>
            </div>

            <div class="modal-footer">
              <input type="submit" value="Thêm" class="btn btn-primary" >
            </div>
          {!! Form::close() !!}
          
        </div>
      </div>
    </div>


  </div>
@endsection
