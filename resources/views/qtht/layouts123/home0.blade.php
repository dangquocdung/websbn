
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

    <title>{{ config('app.name', 'Dang Quoc Dung') }}</title>
    <base href="{{asset('')}}">


    <!-- Bootstrap core CSS -->
    <!-- <link href="./css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Bootstrap custom CSS -->
    <link href="./assets/css/app.css" rel="stylesheet">

    <!-- fancybox -->
    <link rel="stylesheet" href="./assets/css/jquery.fancybox.css?v=2.1.6" type="text/css" media="screen" />

    <!-- Custom styles for this template -->
    {{-- <link href="./assets/css/offcanvas.css" rel="stylesheet"> --}}

    {{-- CKEditor --}}
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/offcanvas.js"></script>
    <script src="./admin/ckeditor/ckeditor.js"></script>

    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
    <script>
    webshims.setOptions('forms-ext', {types: 'date'});
    webshims.polyfill('forms forms-ext');
    $.webshims.formcfg = {
    en: {
        dFormat: '/',
        dateSigns: '/',
        patterns: {
            d: "dd/mm/yy"
        }
    }
    };
    </script>




    <!-- Scripts -->
    {{-- <script src="http://cloud.tinymce.com/stable/tinymce.min.js?apiKey=edetufuicc2n9hv00jnozu6q9de5u1dopix64zixdbvo0of3"></script>
    <script>
        tinymce.init({
          selector: 'textarea',
          height: 500,
          theme: 'modern',
          plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
          ],
          toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
          toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
          image_advtab: true,
          templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
          ],
          content_css: [
            'https://fonts.googleapis.com/css?family=Raleway:300,400,600',
            '//www.tinymce.com/css/codepen.min.css'
          ]
        });


     </script> --}}

     <script>
         window.Laravel = {!! json_encode([
             'csrfToken' => csrf_token(),
         ]) !!};
     </script>



  </head>

  <body>
    <div class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="row">
          <div class="navbar-header">
            <!-- Banner -->
            <div class="banner-xa">
              <a href="/"><img src="../img/brand/{{ config('app.brand','huongdo.png')}}.png" alt="" width="80%"></a>
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
          </div>
        </div>
      </div>

        <div class="menu-ngang">
          <div class="container">

        {{-- <div class="row"> --}}
            <div class="collapse navbar-collapse">


              @if ( Auth::user()->level > 1 )
              <ul class="nav navbar-nav">
                <li>
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

      {{-- </div><!-- /.container --> --}}
    </div><!-- /.navbar -->

    <div class="menu-ngang-2">
      <div class="container">
        {{-- {{ Carbon\Carbon::setLocale('vi')->now()->format('l j F Y H:i:s') }} --}}
        <marquee>Chào mừng bạn đến với trang thông tin điện tử {{ config('app.banquyen')}}. </marquee>
      </div>
    </div>

    <div class="main-content">
      <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

        {{-- <div class="container">
          <p class="pull-right visible-xs"  >
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Menu &raquo;</button>
          </p>
        </div> --}}

        <div class="col-md-12">

          @yield('content')

        </div><!--/span-->

        {{-- <div class="col-xs-6 col-sm-3 col-md-3 sidebar-offcanvas" id="sidebar" role="navigation">

          @include('qtht.layouts.menu-right')

        </div> --}}

      </div><!--/row-->
    </div><!--/.container-->
    </div>


    {{-- <div class="copyright">
    	<div class="container">
        <div class="content">
          <h4>{{ config('app.name', 'Dang Quoc Dung') }}</h4>
          <p>Địa chỉ: {{ config('app.diachi', 'Dang Quoc Dung') }} - Điện thoại: {{ config('app.dienthoai', 'Dang Quoc Dung') }} - Thư điện tử: {{ config('app.email', 'Dang Quoc Dung') }}</p>
          <p>Chịu trách nhiệm nội dung: {{ config('app.cio', 'Dang Quoc Dung') }} - Chủ tịch UBND xã.</p>
          <p>&copy;2017 Bản quyền nội dung thuộc {{ config('app.name', 'Dang Quoc Dung') }} | Thiết kế và phát triển: <a href="http://ttcntt.hatinh.gov.vn" target="_blank">Trung tâm CNTT-TT Hà Tĩnh</a> | <a href="http://www.dangquocdung.com" target="_blank">Điều khoản sử dụng thông tin</a> | <a href="http://www.dangquocdung.com" target="_blank">Chính sách bảo mật</a></p>
        </div>
        <a href="#" class="cd-top cd-is-visible">Top</a>
      </div>
    </div> --}}




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script type="text/javascript" src="./js/jquery.fancybox.pack.js?v=2.1.6"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $(".bando").fancybox();
        $(".thongke").fancybox();
      });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClqb4ClPasKU8unirsY-uT9mw2t7G7d8k&callback=initMap" type="text/javascript"></script>
    <script>
        function initialize() {
          var mapOptions = {
            zoom: 15,
            scrollwheel: false,
            center: new google.maps.LatLng(18.335534, 105.906581)
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

    {{-- //Load thumnail hình ảnh --}}

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



    {{-- CKEDITOR --}}

    <script>
      CKEDITOR.replace('noidung');
    </script>



    <!-- <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58b3ca27cfd3d5ce"></script> -->
  </body>
</html>
