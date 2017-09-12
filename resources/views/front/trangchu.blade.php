@extends('front.layouts.home')

@section('title')
  <title>{{ config('app.name', 'Dang Quoc Dung') }}</title>
@endsection

@section('menu-ngang')
  @include('front.layouts.menu-ngang-home')
@endsection

@section('marquee')
  <div class="container">
      <marquee>Chào mừng bạn đến với Trung tâm Công nghệ thông tin - Truyền thông Hà Tĩnh. </marquee>
  </div>
@endsection

@section('content')
<div class="col-xs-12 col-md-9">


{{-- <div class="row"> --}}
  <!-- slider -->

  {{-- <div class="list-group">
    <img src="/img/banner/thuong-binh-liet-sy.jpg" alt="" width="100%">
  </div> --}}

  @if (count($slider) > 0 )
  <div class="list-group">

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          @php
            $slide1=$slider->shift();
            $i = 0;
          @endphp

          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>

          @foreach ($slider as $slide)
            <li data-target="#carousel-example-generic" data-slide-to="{{ $i++ }}"></li>
          @endforeach
        </ol>
        <div class="carousel-inner">

            <div class="item active">
                <img class="slide-image" src="./img/hinh-slide/{{ $slide1['hinh'] }}" alt="{{ $slide1['tieude'] }}" width="100%">
            </div>

            @foreach ($slider as $slide)

            <div class="item">
                <img class="slide-image" src="/img/hinh-slide/{{ $slide->hinh}}" alt="{{ $slide->tieude}}" width="100%">
            </div>
            @endforeach

        </div>
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
  </div>
  @endif

    {{-- @php
      $mt = $menutop->find(2);
      $loaitin = $menutop->loaitin->all();
    @endphp --}}

  @foreach ($menutop as $lt)

        <div class="list-group">
          <a class="list-group-item active main-color-bg" href="/chuyen-muc/{{ $lt->slug }}">
            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>  <strong>&nbsp{{ $lt->ten }}</strong>
            <p class="pull-right" >
              <span class="glyphicon glyphicon-forward" aria-hidden="true"></span>
            </p>
          </a>
          <div class="list-group-item" style="padding-bottom:0px; padding-left:0px; padding-right:0px; overflow:hidden">
            <div class="row">

              @php
                $data = $lt->tintuc->where('active','1')->sortByDesc('created_at')->take(5);
                $tin1 = $data->shift();
              @endphp

              <div class="col-md-7 col-sm-7 col-xs-12 tintuc">
                <div class="col-md-5 col-sm-5 minhhoa">
                  @if ($tin1['urlhinh'])
                    <a href="/chi-tiet-tin/{{ $tin1['tieudekhongdau']}}">
                        <img src="./img/tin-tuc/{{ $tin1['urlhinh'] }}" alt="" width="100%">
                    </a>
                  @else
                    <a href="/chi-tiet-tin/{{ $tin1['tieudekhongdau']}}">
                        <img src="image/placeholder.png" alt="" width="100%">
                    </a>
                  @endif
                </div>
                <div class="col-md-7 col-sm-7">
                  <a href="/chi-tiet-tin/{{ $tin1['tieudekhongdau']}}">
                    <h4>
                      {{ $tin1['tieude'] }}
                    </h4>
                  </a>
                  <div class="news-desc">

                      {{ str_limit($tin1['tomtat'], $limit=200, $end='...') }}

                  </div>
                </div>
              </div>

              <div class="col-md-5 col-sm-5 hidden-xs">
                @foreach ($data as $tt)
                  {{-- <a href="/chi-tiet-tin/{{ $tt->tieudekhongdau}}">
                    <h5>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      {{ $tt->tieude }}
                    </h5>
                  </a> --}}

                  <div class="tin-moi-theo-loai">
                    <table>
                      <tr>
                        <td>
                        @if ($tt->urlhinh)
                          <img src=".img/tin-tuc/{{ $tt->urlhinh }}" alt="" style="max-width:50px;">
                        @else
                            <img src="image/placeholder.png" alt="" style="max-width:50px;">
                        @endif
                        </td>
                        <td  style="text-align:left; padding-left: 10px;"><a href="/chi-tiet-tin/{{$tt->tieudekhongdau}}">{{ $tt->tieude }}</a></td>
                      </tr>
                    </table>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="footer-mega-link">
              <a href="/chuyen-muc/{{ $lt->slug }}"><small>Nhiều hơn...</small></a>
            </div>
          </div>
        </div>

  @endforeach
</div><!--/span-->
<div class="col-xs-6 col-md-3 hidden-sm sidebar-offcanvas" id="sidebar" role="navigation">
  @include('front.layouts.menu-right')
</div>
{{-- </div> --}}
@endsection

@section('copyright')
  @include('front.layouts.copyright')
@endsection
