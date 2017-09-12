@extends('qtht.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading  in-hoa-dam"><strong>Danh sách BannerTop</strong></div>

            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <tr>
                    <th>TT</th>
                    <th>Tên</th>
                    <th>Minh hoạ</th>
                    <th>URL</th>
                    <th>Hiện/Ẩn</th>
                    <th>Ngày tạo</th>
                    <th></th>
                    <th></th>
                  </tr>
                  @foreach ($bannertop as $bt)
                  <tr>
                    <td>{{ $bt->thutu }}</td>
                    <td>{{ $bt->ten }}</td>

                    <td>
                      <a class="urlhinh" href="./img/bannertop/{{ $bt->urlhinh }}">
                        <img class="img-responsive" src="./img/bannertop/{{ $bt->urlhinh }}" style="display:block; margin:0 auto" width="50px">
                      </a>
                    </td>
                    <td>{{ $bt->urlbanner }}</td>
                    <td>
                      @if ($bt->hienthi == 1)
                      <input type="checkbox" checked>
                      @else
                      <input type="checkbox">
                      @endif
                    </td>
                    <td>{{ $bt->created_at}}</td>



                    <td style="text-align: center;">
                      <form action="/qtht/xoa-banner/{{ $bt->id }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">


                        <button onclick="return confirm('Bạn muốn xóa banner này?')" type="submit" class="btn btn-sm btn-danger">Xoá</button>
                      </form>
                    </td>
                    <td>
                      <a class="btn btn-sm btn-warning" href="">Sửa</a>

                    </td>
                  </tr>

                  @endforeach
                </table>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
