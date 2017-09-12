@extends('front.layouts.home')

@section('title')
  <title>{{ $tin->tieude}}</title>
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
                <li class="dropdown">
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
      {{-- <a href="/"><i class="fa fa-home" aria-hidden="true"></i> &nbspTrang chủ</a> /  --}}
      <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> &nbsp{{ $tin->loaitin->ten}}

      <p class="pull-right visible-xs" >
        <a data-toggle="offcanvas" style="color:red">
          <span class="glyphicon glyphicon-forward site-logo" aria-hidden="true"></span>
        </a>
      </p>
    </div>






    {{-- <div class="panel panel-default" style="margin-bottom: 0">
      <div class="panel-heading in-hoa-dam">
          <i class="fa fa-calendar" aria-hidden="true"></i><a href="/loai-tin/{{ $tin->loaitin->slug}}">  Tin {{ $tin->loaitin->ten}}</a> / {{ $tin->tieude }}
         <p class="pull-right visible-xs" >
           <a data-toggle="offcanvas" style="color:red">
             <span class="glyphicon glyphicon-forward site-logo" aria-hidden="true"></span>
           </a>
         </p>
      </div>
    </div> --}}

    <div class="list-group-item">
      <div class="chi-tiet-tin">
        <h3>{{ $tin->tieude }}</h3>
        <div class="thong-tin">
          <p style="margin: 10px 0 20px"><span class="glyphicon glyphicon-time"></span> {{ Carbon\Carbon::parse($tin->created_at)->format('h:m d-m-Y ') }}</p>
          {{-- <span>- <strong>{{ $tin->nguoidang->name }}</strong></span> --}}
        </div>

        <div class="news-desc">
          <p>{{ $tin->tomtat }}</p>
        </div>
          <div class="noi-dung">
            {!! $tin->noidung !!}
          </div>

          @if ( Auth::user() && Auth::user()->is_admin() )
            <div class="" style="text-align:right">
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

            </div>

          @endif
      </div>

      <hr>


    <h4>Các tin mới đăng</h4>
    @foreach ($namtinmoinhat as $ttl)
        <a href="/chi-tiet-tin/{{ $ttl->tieudekhongdau }}">
          <h5> <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
          {{ $ttl->loaitin->ten}}: &nbsp{{ $ttl->tieude }}</h5>
        </a>


    @endforeach
  {{-- </div> --}}

  @php

    $namtincungloai  = $loaitinchitiet->tintuc->where('active','1')->sortByDesc('created_at')->take(5);

  @endphp

  <hr>

  <h4>Các tin cùng loại</h4>
  @foreach ($namtincungloai as $ttl)
      <a href="/chi-tiet-tin/{{ $ttl->tieudekhongdau }}">
        <h5><span class="glyphicon glyphicon-check" aria-hidden="true"></span>
        {{ $ttl->loaitin->ten}}: &nbsp{{ $ttl->tieude }}</h5>
      </a>


  @endforeach
  </div>

</div>

</div><!--/span-->
<div class="col-xs-6 col-md-3 hidden-sm sidebar-offcanvas" id="sidebar" role="navigation">
  @include('front.layouts.menu-right')
</div>




@endsection

@section('copyright')
  @include('front.layouts.copyright')
@endsection
