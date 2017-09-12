<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Trang Quản trị || {{ config('app.name', 'Dang Quoc Dung') }}</title>
    <base href="{{asset('')}}">


    <!-- Styles -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.css?v=2.1.6') }}" type="text/css" media="screen" />

    <!-- Scripts -->
    <script src="http://cloud.tinymce.com/stable/tinymce.min.js?apiKey=edetufuicc2n9hv00jnozu6q9de5u1dopix64zixdbvo0of3"></script>
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
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
          ]
        });


   </script>

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="row">
            <div class="navbar-header">
              <!-- Banner -->
              @if (count($bannertop)>0)

              <div class="col-md-4 col-xs-10">
              @endif
                <div class="banner-xa"><a href="/qtht/home"><img src="../img/brand/brand.png" alt="" width="100%"></a></div>

              @if (count($bannertop)>0)
              </div>
              <div class="col-md-8 hidden-sm hidden-xs">
                <div class="banner-top-right">
                  <div id="carousel-top-right" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        @php
                          $i=1;
                        @endphp
                        @foreach ($bannertop as $bt)

                          @if ($i==1)

                          <div class="item active">

                            @else
                              <div class="item">

                            @endif
                            <a href="{{ $bt->urlbanner }}" target="_blank"><img src="./img/bannertop/{{ $bt->urlhinh }}" alt=""></a>
                          </div>
                          @php
                            $i++;
                          @endphp
                        @endforeach
                    </div>
                  </div>
                </div>
              </div>

              @endif
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>

          </div>

          <div class="row">
            <div class="collapse navbar-collapse">

              <ul class="nav navbar-nav">


                @if (Auth::user()->level == 15 )

                <li>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    Thiết lập hệ thống <span class="caret"></span>
                  </a>

                  <ul class="dropdown-menu" role="menu">
                    @foreach ($menutop as $mt)
                    <li class="dropdown-submenu">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ $mt->ten }}
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="#" data-toggle="modal" data-target="#themLoaiTin{{ $mt->id }}">Thêm mục vào {{ $mt->ten }}</a></li>
                        <li class="divider"></li>
                        <li><a href="/qtht/{{ $mt->id }}/danh-sach-loai-tin">Danh sách các mục trong {{ $mt->ten }}</a></li>

                      </ul>

                    </li>


                    @endforeach
                    <li class="divider"></li>

                    <li class="dropdown-submenu">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Banner
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="#" data-toggle="modal" data-target="#themBanner">Thêm banner</a></li>
                        <li><a href="/qtht/danh-sach-banner">Danh sách banner</a></li>
                      </ul>
                    </li>

                    <li class="divider"></li>

                    <li class="dropdown-submenu">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Menu ngang
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="#" data-toggle="modal" data-target="#themMenu">Thêm menu</a></li>
                        <li><a href="/qtht/danh-sach-menu">Danh sách menu</a></li>
                      </ul>
                    </li>

                  </ul>
                </li>

                @endif

                
              </ul>


              <ul class="nav navbar-nav navbar-right">

                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/">Trang ngoài</a></li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>

              </ul>
            </div><!-- /.nav-collapse -->
          </div>
        </div><!-- /.container -->
      </div><!-- /.navbar -->
        @yield('content')

        <div class="copyright">
          <div class="container">
            <div class="content">
              <h4>Cổng THÔNG TIN ĐIỆN TỬ {{ config('app.name', 'Dang Quoc Dung') }}</h4>
              <p>Địa chỉ: {{ config('app.diachi', 'Dang Quoc Dung') }} - Điện thoại: {{ config('app.dienthoai', 'Dang Quoc Dung') }} - EMail: {{ config('app.email', 'Dang Quoc Dung') }}</p>
              <p>Chịu trách nhiệm nội dung: {{ config('app.cio', 'Dang Quoc Dung') }}</p>
              <p>&copy;2017 Bản quyền nội dung thuộc {{ config('app.name', 'Dang Quoc Dung') }} | Thiết kế và phát triển: <a href="http://dangquocdung.com" target="_blank">Trung tâm CNTT-TT Hà Tĩnh</a> | <a href="#">Điều khoản sử dụng thông tin</a> | <a href="#">Chính sách bảo mật</a></p>

            </div>
            <a href="{{ Request::url() }}" class="cd-top cd-is-visible">Top</a>
          </div>
        </div>
    </div>

    <!-- Modal add Menu -->
    <div class="modal" id="themMenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="/qtht/them-Menu" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{csrf_token()}}">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Thêm Menu</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Tên Menu</label>
              <input type="text" class="form-control" name="tenMenu" placeholder="Nhập Tên Menu mới" required="" autofocus="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Thêm</button>
          </div>
        </form>
        </div>
      </div>
    </div>
    <!-- End Modal -->

    <!-- Modal add LoaiTin -->
    @foreach ($menutop as $mt)

    <div class="modal" id="themLoaiTin{{ $mt->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="/qtht/them-loai-tin" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="menutop_id" value="{{ $mt->id }}">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Thêm loại tin trong menu {{ $mt->tên }} </h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Tên Loại tin</label>
              <input type="text" class="form-control" name="tenLoaiTin" placeholder="Nhập Tên Loại tin mới" required="" autofocus="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Thêm</button>
          </div>
        </form>
        </div>
      </div>
    </div>
    @endforeach
    <!-- End Modal -->

    <!-- Modal banner -->

    <div class="modal" id="themBanner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="/qtht/them-banner" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Thêm Banner </h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Tên Banner</label>
              <input type="text" class="form-control" name="tenBanner" placeholder="Nhập Tên Banner" required="" autofocus="">
            </div>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Hình Banner</label>
              <input type="file" name="urlhinh" required="" />
            </div>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Url</label>
              <input type="url" class="form-control" name="urlbanner" placeholder="Nhập URL Banner" required="" autofocus="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Thêm</button>
          </div>
        </form>
        </div>
      </div>
    </div>

    <!-- end banner -->




    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('./js/app.js') }}"></script>

    <script type="text/javascript" src="./js/jquery.fancybox.pack.js?v=2.1.6"></script>
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


</body>
</html>
