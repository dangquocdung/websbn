@extends('front.layouts.home')
@section('title')
  @if ($loai == 'loaitin')
    <title>{{ $loaitin->ten}}</title>
  @else
    <title>Kết quả tìm kiếm:&nbsp{{ $loaitin}}</title>
  @endif
@endsection

@section('menu-ngang')
  @include('front.layouts.menu-ngang')
@endsection


@section('content')
  <div class="list-group">
    <div  class="list-group-item active main-color-bg in-hoa-dam">
      @if ($loai == 'loaitin')
        <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> &nbsp{{ $loaitin->ten}}
      @else
        <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> &nbspKết quả tìm kiếm:&nbsp{{ $loaitin}}
      @endif

      <p class="pull-right visible-xs" >
        <a data-toggle="offcanvas" style="color:red">
          <span class="glyphicon glyphicon-forward site-logo" aria-hidden="true"></span>
        </a>
      </p>
    </div>

    @if ( count($tintheoloai) > 0)

      @foreach ($tintheoloai as $ttl)
        <div class="list-group-item">
          <div class="row">
            <div class="col-md-3 col-sm-5 col-xs-5 hinh-minh-hoa">
              <a href="/chi-tiet-tin/{{ $ttl->tieudekhongdau }}">
                @if ($ttl->urlhinh)
                  <img class="img-responsive" src="./img/tin-tuc/{{ $ttl->urlhinh }}" alt="{{ $ttl->tieude }}" title="{{ $ttl->tieude }}">
                @else
                  <img class="img-responsive" src="http://placehold.it/150x150" alt="{{ $ttl->tieude }}" title="{{ $ttl->tieude }}">
                @endif
              </a>
            </div>
            <div class="col-md-9 col-sm-7 col-xs-7">
              <a href="/chi-tiet-tin/{{ $ttl->tieudekhongdau }}">
                <h4>{{ $ttl->tieude }}</h4>
              </a>
              <p style="text-align:justify"><em>{{ $ttl->tomtat }}...</em></p>
            </div>
          </div>
        </div>
      @endforeach
    @else
      <div class="list-group-item">
        <div class="row">
          <p style="text-align: center"><i class="fa fa-cubes" aria-hidden="true"></i> <em>Xin lỗi bạn, hiện chúng tôi chưa có bài viết nào thuộc chuyên mục này!</em></p>
          <a href="/">
            <p style="text-align: center"><i class="fa fa-reply" aria-hidden="true"></i> <strong>Quay lại</strong></p>

          </a>
        </div>
      </div>
    @endif
  </div>
  {!! $tintheoloai->links() !!}
@endsection
