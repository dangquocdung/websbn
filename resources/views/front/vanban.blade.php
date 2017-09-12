@extends('front.layouts.home')

@section('title')
  <title>{{ $loaitin->ten}}</title>
@endsection

@section('content')
  <div class="list-group">
    <div  class="list-group-item active main-color-bg in-hoa-dam">
      <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> &nbsp{{ $loaitin->ten}}

      <p class="pull-right visible-xs" >
        <a data-toggle="offcanvas" style="color:red">
          <span class="glyphicon glyphicon-forward site-logo" aria-hidden="true"></span>
        </a>
      </p>
    </div>
    @if ( count($vbtheoloai) > 0 )
      @foreach ($vbtheoloai as $ttl)
        <div class="list-group-item">
          <div class="row">
            <div class="col-md-3 col-sm-5 col-xs-5 hinh-minh-hoa">
              <iframe src="{{ $ttl->tepvanban }}" width="100%" height="100%"></iframe>
            </div>
            <div class="col-md-9 col-sm-7 col-xs-7">
              <a href="{{ $ttl->tepvanban }}">
                <h4>Số (kí hiệu): {{ $ttl->sovb }}</h4>
              </a>
              <p style="text-align:justify"><strong>Trích yếu văn bản: </strong><em>{{ $ttl->trichyeuvb }}...</em></p>
              <p><strong>Người kí: </strong>{{ $ttl->nguoiki }}</p>
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
  {!! $vbtheoloai->links() !!}




@endsection
