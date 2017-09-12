
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
    @php
      header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
      header("Cache-Control: post-check=0, pre-check=0", false);
      header("Pragma: no-cache");
      header('Content-Type: text/html');
    @endphp

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
    {{-- <script>
      var socket = io("http://localhost:3000");
      $(document).ready(function(){
        socket.on("server_send_quangcao",function(data){
          var s =   "<a  class='list-group-item active main-color-bg'>";
              s = s + "<span class='glyphicon glyphicon-cog' aria-hidden='true'></span> Tài trợ</a>";
              s = s + "<a class='dichvucong' href='" + data + "' target='_blank'>";
              s = s + "<img class='img-responsive' src='./img/banner-right/" + data + "' style='display:block; margin:0 auto' width='100%'></a>";
          $("#quangcao").html(s);

        })
      })
    </script> --}}

    <link href="./css/rotate.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="./js/rotate.js"></script>
    <script type="text/javascript">
      $(window).load(function() {
        // startRotator("#rotator");
      })
    </script>
  </head>

  <body>
    <div class="navbar navbar-default" role="navigation">
      <div class="container">
          <div class="navbar-header">
            <div class="porlet-header-banner">
              <div class="header-banner-wrapper">
                <div class="container pad-left-10 pad-right-10">
                  <div class="brand-text">
                      <h1>Sở Thông tin - Truyền thông tỉnh Hà Tĩnh</h1>
                      <h2>Trung tâm CNTT - Truyền thông</h2>
                  </div>
                  <div class="header-banner-slide">
                    <div id="banner-xa" class="banner-xa">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      {{-- <a class="visible-xs" href="/"><img src="../img/brand/{{ config('app.brand')}}.png" alt="" width="80%"></a> --}}
                    </div>
                  </div>

                  <div class="header-menu-search-wrapper hidden-xs">
                    <form action="ket-qua-tim-kiem" method="POST">
                      <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                      <input type="text" name="timkiem" class="header-menu-search-box" placeholder="Tìm kiếm" value="">
                      <input type="submit" class="icon-search" value="">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          {{-- <div id="banner-xa" class="banner-xa">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a href="/"><img src="../img/brand/{{ config('app.brand')}}.png" alt="" width="80%"></a>
          </div> --}}
          </div>
      </div><!-- /.container -->
      @yield('menu-ngang')
    </div><!-- /.navbar -->

    {{-- @yield('marquee') --}}

    <div class="main-content">
      <div class="container">
        <div class="row row-offcanvas row-offcanvas-right">
        {{-- <div class="container">
          <p class="pull-right visible-xs" >
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Menu &raquo;</button>
          </p>
        </div> --}}
          @yield('content')
        </div><!--/row-->
      </div><!--/.container-->
    </div>

    @yield('copyright')
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
        
        function goBack() {
            window.history.back();
        }
    </script>

    <script type="text/javascript">

      $(document).ready(function() {
        $(".urlhinh").fancybox();
      });

      function readURL(input){
        if (input.files && input.files[0]){
          var reader = new FileReader();

          reader.onload = function(e){
            $("#showimages").attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }
      }

      $("#inputimages").change(function(){
        readURL(this);
      })
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
