@extends('front.layouts.home')
@section('title')
  <title>Quản trị Tin - Bài | {{ config('app.name', 'Dang Quoc Dung') }}</title>
@endsection
@section('menu-ngang')
  @include('qtht.layouts.menu-ngang')
@endsection
@section('content')
  <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading in-hoa-dam">
          <strong>Danh sách tin tức</strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-2 col-xs-4">
              <div style="padding-bottom:10px">
                <a class="btn btn-primary" href="/qtht/them-tin-bai"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm bản tin</a>
              </div>
            </div>
            <div class="col-md-4 col-md-push-6 col-xs-6 col-xs-push-2">
              {!! Form::open(['method'=>'GET', 'ulr'=>'qtht/home', 'role'=>'search']) !!}
                <div class="input-group">
                  <input type="text" name="search" class="form-control" placeholder="Search...">
                  <div class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                      <i class="glyphicon glyphicon-search"></i>
                    </button>
                  </div>
                </div>
              {!! Form::close() !!}
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <tbody>
              <tr>
                <th>TT</th>
                <th>Tiêu đề</th>
                <th>Nổi bật</th>
                <th>Loại tin</th>
                <th>Tóm tắt</th>
                <th>Minh hoạ</th>
                <th>Người đăng</th>
                <th>Đã duyệt</th>
                <th>Ghi chú</th>
                <th>Thao tác</th>
              </tr>
              @foreach ($posts as $tin)
              <tr>
                <td>{{ $tin->id }}</td>
                <td style="text-align:left;">
                  @if ($tin->active == 1)
                    <a href="/chi-tiet-tin/{{$tin->tieudekhongdau}}" target="_blank">{{ $tin->tieude }}</a>
                  @else
                    {{ $tin->tieude }}
                  @endif
                </td>
                <td>
                  @if ($tin->tinnoibat==0)
                    <input type="checkbox" name="" value="" disabled="">
                  @else
                    <input type="checkbox" name="" value="" checked="" disabled="">
                  @endif
                </td>
                <td style="text-align:left;">{{ $tin->loaitin->ten }}</td>
                <td style="text-align:left;">{{ str_limit($tin->tomtat, $limit=120, $end='......') }}</td>
                <td>
                  @if ($tin->urlhinh)
                    <a class="urlhinh" href="{{ $tin->urlhinh }}">
                      <img class="img-responsive" src="./img/tin-tuc/{{ $tin->urlhinh }}" style="max-width:100px; max-height:50px; float:left">
                    </a>
                  @else
                    <img class="img-responsive" src="http://placehold.it/100x100" style="max-width:100px; max-height:50px; float:left">
                  @endif
                </td>
                <td>{{ $tin->nguoidang->name }}</td>
                <td>
                  @if ($tin->active==0)
                    <input type="checkbox" name="" value="" disabled="">
                  @else
                    <input type="checkbox" name="" value="" checked="" disabled="">
                  @endif
                </td>
                <td style="text-align:left;">{{ $tin->ghichu }}</td>
                <td style="text-align: center;">
                  @if ($tin->active==0 || Auth::user()->level > 2 )
                    <form action="#" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <a href="{{ url('qtht/sua-tin-bai/'.$tin->tieudekhongdau) }}" class="btn btn-warning btn-xs">
                        <span class="glyphicon glyphicon-edit"></span>
                      </a>
                        <a href="{{ url('qtht/xoa-tin-bai/'.$tin->id.'?token='.csrf_token()) }}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn chắc chắn muốn xoá tin?')">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </form>
                  @endif
                </td>
              </tr>
              @endforeach
              </tbody>
            </table>
            {{-- pagination --}}
            {!! $posts->links() !!}
          </div>
        </div>
    </div>
  </div>
@endsection
