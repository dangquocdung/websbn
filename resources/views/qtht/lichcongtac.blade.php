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
          <a class="btn btn-primary" href="/qtht/lich-cong-tac/them-lich-cong-tac"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm Lịch công tác</a>
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
                      <a href="{{ url('qtht/lich-cong-tac/sua-lich-cong-tac/'.$lct->id) }}" class="btn btn-warning btn-xs">
                        <span class="glyphicon glyphicon-edit"></span>
                      </a>
                      <a href="{{ url('qtht/lich-cong-tac/xoa-lich-cong-tac/'.$lct->id.'?token='.csrf_token()) }}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn chắc chắn muốn xoá hình Lịch công tác này?')">
                        <span class="glyphicon glyphicon-trash"></span>
                      </a>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
  </div>
  </div>
@endsection
