@extends('front.layouts.home')
@section('title')
  <title>{{$chuyenmuc->ten}}</title>
@endsection

@section('menu-ngang')
  <div class="menu-ngang">
    <div class="container">
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li>
            <a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
          </li>
          @if ($menutop)
            @foreach ($menutop as $mt)
              {{-- @if ($mt->id < 4) --}}
                <li
                @if ($mt->id == $chuyenmuc->id)

                  class="dropdown active"

                @else

                  class="dropdown"

                @endif

                >
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ $mt->ten }}
                    @if (count($mt->loaitin) > 0)
                      <span class="caret"></span>
                    @endif
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    @foreach ($mt->loaitin as $lt)
                      @if ( $lt->menutop_id == $mt->id )
                        <li><a href="/loai-tin/{{$lt->slug}}"><i class="fa fa-tag" aria-hidden="true"></i> &nbsp{{ $lt->ten }}</a></li>
                      @endif
                    @endforeach

                  </ul>
                </li>
            @endforeach
          @endif
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
            @if (Auth::guest())
                <li><a href="{{ route('login') }}"><i class="fa fa-user" aria-hidden="true"></i> &nbspĐăng nhập</a></li>
                {{-- <li><a href="{{ route('register') }}">Đăng kí</a></li> --}}
            @else

              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  <i class="fa fa-user" aria-hidden="true"></i> &nbsp{{ Auth::user()->name }} ({{ Auth::user()->level }})<span class="caret"></span>
              </a>

              <ul class="dropdown-menu" role="menu">
                  <li><a href="/qtht"><i class="fa fa-sign-in" aria-hidden="true"></i> Trang quản trị</a></li>
                  <li class="divider"></li>
                  <li>
                      <a href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                          <i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  </li>
              </ul>
            @endif
          </li>
        </ul>
      </div><!-- /.nav-collapse -->
    </div>
  </div>
@endsection


@section('content')
<div class="col-xs-12 col-md-9">
  <div class="list-group">
    <div  class="list-group-item active main-color-bg in-hoa-dam">
      <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> &nbsp{{$chuyenmuc->ten}}

      <p class="pull-right visible-xs" >
        <a data-toggle="offcanvas" style="color:red">
          <span class="glyphicon glyphicon-forward site-logo" aria-hidden="true"></span>
        </a>
      </p>
    </div>

    @if (count($chuyenmuc->tintuc)>0)
    @foreach ($chuyenmuc->tintuc as $ttl)
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


</div>

<div class="col-xs-6 col-md-3 hidden-sm sidebar-offcanvas" id="sidebar" role="navigation">
  @include('front.layouts.menu-right')
</div>

@endsection

@section('copyright')
  @include('front.layouts.copyright')
@endsection
