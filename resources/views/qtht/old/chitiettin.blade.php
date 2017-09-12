@extends('front.layouts.home')

@section('menu-ngang')

<div class="menu-ngang">
  <div class="container">

    <div class="collapse navbar-collapse">


      @if ( Auth::user()->level > 1 )
      <ul class="nav navbar-nav">
        <li class="active">
          <a href="/qtht/home"><i class="fa fa-home" aria-hidden="true"></i> Tin, Bài</a>
        </li>
        @if ( Auth::user()->is_admin() || Auth::user()->is_tbbt() )
        <li>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Slide - Video <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li>
              <a href="/qtht/hinh-slide/home">
                <i class="fa fa-cog" aria-hidden="true"></i> Quản lí hình slide
              </a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="/qtht/video-clip/home">
                <i class="fa fa-cog" aria-hidden="true"></i> Quản lí Videos
              </a>
            </li>
          </ul>
        </li>
        @endif

        @if ( Auth::user()->is_admin() )
        <li>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Thiết lập hệ thống <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li>
              <a href="/qtht/chuyen-muc/home">
                <i class="fa fa-cog" aria-hidden="true"></i> Quản lí chuyên mục
              </a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="/qtht/menu/home">
                <i class="fa fa-cog" aria-hidden="true"></i> Quản lí loại tin
              </a>
            </li>
          </ul>
        </li>
        @endif

        <li>
          <a href="/qtht/lich-cong-tac/home">Lịch công tác</a>
        </li>

        <li>
          <a href="/qtht/van-ban/home">Văn bản</a>
        </li>

        <li>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Hỏi đáp <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li>
              <a href="/qtht/gop-y">
                <i class="fa fa-cog" aria-hidden="true"></i> Góp ý
              </a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="/qtht/hoi-dap">
                <i class="fa fa-cog" aria-hidden="true"></i> Hỏi & Đáp
              </a>
            </li>
          </ul>
        </li>

        <li>
          <a href="/qtht/thu-vien-hinh-anh" target="_blank">Thư viện hình ảnh</a>
        </li>
      </ul>
      @endif


      <ul class="nav navbar-nav navbar-right">

        <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <i class="fa fa-user" aria-hidden="true"></i> &nbsp{{ Auth::user()->name }} ({{ Auth::user()->level }})<span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                <li><a href="/"><i class="fa fa-sign-in" aria-hidden="true"></i> Trang chủ</a></li>
                <li class="divider"></li>
                <li><a href="/qtht/doi-mat-khau"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Đổi mật khẩu</a></li>
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
        </li>

      </ul>
    </div>
  </div>
</div>

@endsection
@section('content')
  <div class="row">
    <div class="list-group">

      <a  class="list-group-item active main-color-bg">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> {{ $tin->loaitin->ten}}
      </a>

      <div class="list-group-item">

        <div class="chi-tiet-tin">
          <h3>{{ $tin->tieude }}</h3>
          <br>
          <div class="news-desc">
              {{ $tin->tomtat }}
          </div>
          
          <div class="noi-dung">
            {!! $tin->noidung !!}
        </div>
        </div>
      </div>
    </div>

  </div><!--/row-->
@endsection
