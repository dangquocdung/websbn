
<!DOCTYPE html>
<html lang="en">
  <head>
    <!--*************************************************-->
    <!-- Tác giả: Đặng Quốc Dũng - PGD TTCNTT-TT Hà Tĩnh -->
    <!-- Email: dungthinhvn@gmail.com - Phone:0986242487 -->
    <!--      Website: http://www.dangquocdung.com       -->
    <!--*************************************************-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../assets/ico/favicon.ico">

    {{-- <title>{{ config('app.name', 'Dang Quoc Dung') }}</title> --}}

    @yield('title')
    <base href="{{asset('')}}">


    <!-- Bootstrap core CSS -->
    <!-- <link href="./css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Bootstrap custom CSS -->
    <link href="./assets/css/app.css" rel="stylesheet">

    <!-- fancybox -->
    <link rel="stylesheet" href="./assets/css/jquery.fancybox.css?v=2.1.6" type="text/css" media="screen" />

    <!-- Custom styles for this template -->
    {{-- <link href="./assets/css/offcanvas.css" rel="stylesheet"> --}}

    <script src="./js/jquery.min.js"></script>
    <script src="./js/socket.io.js"></script>
    <script src="./admin/ckeditor/ckeditor.js"></script>
    <script>
      var socket = io("http://localhost:3000");

      $(document).ready(function(){
        socket.on("server_send_quangcao",function(data){

          var s =   "<a  class='list-group-item active main-color-bg'>";
              s = s + "<span class='glyphicon glyphicon-cog' aria-hidden='true'></span> Tài trợ</a>";
              s = s + "<a class='dichvucong' href='" + data + "' target='_blank'>";
              s = s + "<img class='img-responsive' src='./img/banner-right/" + data + "' style='display:block; margin:0 auto' width='100%'></a>";

          $("#quangcao").html(s);

          // alert(data);
        })
      })
    </script>

  </head>

  <body>
    <div class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="row">
          <div class="navbar-header">
            <div id="banner-xa" class="banner-xa">

              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a href="/"><img src="../img/brand/{{ config('app.brand')}}.png" alt="" width="80%"></a>
            </div>
          </div>

        </div>


      </div><!-- /.container -->
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
                        {{ $mt->ten }} <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu" role="menu">
                        @foreach ($mt->loaitin as $lt)
                          @if ( $lt->menutop_id == $mt->id )
                            <li><a href="/loai-tin/{{$lt->slug}}"><i class="fa fa-tag" aria-hidden="true"></i> &nbsp{{ $lt->ten }}</a></li>
                          @endif
                        @endforeach
                        @if ($mt->id == 2)
                          <li class="divider"></li>
                          <li><a href="/loai-tin/video"><i class="fa fa-youtube" aria-hidden="true"></i> &nbspVideo clip</a></li>
                        @endif

                        @if ($mt->id == 3)
                          <li class="divider"></li>
                          <li><a href="http://{{ config('app.huyen') }}.hatinh.gov.vn" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbspVB QPPL: Công báo huyện</a></li>
                          <li><a href="http://congbao.hatinh.gov.vn" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbspVB QPPL: Công báo tỉnh</a></li>

                          <li class="divider"></li>

                          <li><a href="hoi-dap"><i class="fa fa-comments-o" aria-hidden="true"></i> &nbspHỏi & Đáp</a></li>
                          <li><a href="gop-y"><i class="fa fa-envelope-o" aria-hidden="true"></i> &nbspGóp ý</a></li>

                        @endif
                      </ul>
                    </li>
                @endforeach
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    Tra cứu văn bản <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    @foreach ($menuvb as $lt)
                      <li><a href="/van-ban/{{$lt->slug}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp{{ $lt->ten }}</a></li>
                    @endforeach
                    <li class="divider"></li>
                    @foreach ($loaivb as $lvb)
                      <li><a href="/loai-van-ban/{{$lvb->slug}}"><i class="fa fa-folder-open-o" aria-hidden="true"></i> &nbsp{{ $lvb->ten }}</a></li>
                    @endforeach
                  </ul>


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

    </div><!-- /.navbar -->
    <div class="menu-ngang-2">
      <div class="container">

          <marquee style="text-transform:uppercase">Chào mừng bạn đến với trang thông tin điện tử {{ config('app.diachi')}} - tỉnh Hà Tĩnh. </marquee>



        {{-- {{ Carbon\Carbon::setLocale('vi')->now()->format('l j F Y H:i:s') }} --}}
      </div>
    </div>

    <div class="main-content">
      <div class="container">
        <div class="row row-offcanvas row-offcanvas-right">

        {{-- <div class="container">
          <p class="pull-right visible-xs" >
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Menu &raquo;</button>
          </p>
        </div> --}}

        <div class="col-xs-12 col-sm-9 col-md-9">
          <div class="row">

          @yield('content')

        </div>

        </div><!--/span-->

        <div class="col-xs-6 col-sm-3 col-md-3 sidebar-offcanvas" id="sidebar" role="navigation">


          @include('front.layouts.menu-right')


        </div>

      </div><!--/row-->
    </div><!--/.container-->
    </div>

    <div class="copyright">
    	<div class="container">
        <div class="content">
          <h4>{{ config('app.name', 'Dang Quoc Dung') }}</h4>
          <p>Địa chỉ: {{ config('app.diachi') }} - Điện thoại: {{ config('app.dienthoai') }} - Thư điện tử: {{ config('app.email') }}@hatinh.gov.vn</p>
          <p>Chịu trách nhiệm nội dung: {{ config('app.cio') }} - Chủ tịch UBND xã.</p>
          <p>Thiết kế và phát triển: <a href="http://ttcntt.hatinh.gov.vn" target="_blank">Trung tâm CNTT-TT Hà Tĩnh</a> | <a href="#" target="_blank">Điều khoản sử dụng thông tin</a> | <a href="#t" target="_blank">Chính sách bảo mật</a></p>
          <p>&copy;2017, Bản quyền nội dung thuộc UBND {{ config('app.banquyen') }} | Số lượt truy cập: <img src="http://www.reliablecounter.com/count.php?page={{ config('app.email') }}.hatinh.gov.vn&digit=style/plain/6/&reloads=0" alt="" title="" border="0"></p>
        </div>
        {{-- <a href="#" class="cd-top cd-is-visible">Top</a> --}}
        <div id="back-top">
          <a href="#"> <img src="./img/btt.png" alt="Top" width=100%> </a>
        </div>

      </div>
    </div>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/offcanvas.js"></script>
    <script src="./js/pdf.js"></script>
    <script type="text/javascript" src="./js/jquery.fancybox.pack.js?v=2.1.6"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $(".bando").fancybox();
        $(".thongke").fancybox();

        // hide #back-top first
        $("#back-top").hide();

        // fade in #back-top
        $(function () {
          $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
              $('#back-top').fadeIn();
            } else {
              $('#back-top').fadeOut();
            }
          });

          // scroll body to 0px on click
          $('#back-top .fi-arrow-up').click(function () {
            $('body,html').animate({
              scrollTop: 0
            }, 800);
            return false;
          });
        });
      });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClqb4ClPasKU8unirsY-uT9mw2t7G7d8k&callback=initMap" type="text/javascript"></script>
    <script>
        function initialize() {
          var mapOptions = {
            zoom: 15,
            scrollwheel: false,
            center: new google.maps.LatLng({{ config('app.toado','18.335534, 105.906581') }})
          };

          var map = new google.maps.Map(document.getElementById('googleMap'),
              mapOptions);

          var marker = new google.maps.Marker({
            position: map.getCenter(),
            animation:google.maps.Animation.BOUNCE,
            icon: 'img/map-marker.png',
            map: map
          });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

    <script>
      CKEDITOR.replace('noidung');
    </script>

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5949233b18804526"></script>
    <!-- <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58b3ca27cfd3d5ce"></script> -->
    {{-- <a href="https://www.freecounterstat.com" title="web counter"><img src="https://counter1.fcs.ovh/private/freecounterstat.php?c=qzhhxxk5dn68mrb1r4ugwkjjctbrhg5t" border="0" title="web counter" alt="web counter"></a> --}}

  </body>
</html>
