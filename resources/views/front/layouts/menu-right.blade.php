

  {{-- {!! Form::open(['method'=>'GET', 'ulr'=>'tim-kiem', 'class'=>'list-group-item','role'=>'search']) !!}
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Nhập từ khóa cần tìm...">
      <div class="input-group-btn">
        <button class="btn btn-default" type="submit">
          <i class="glyphicon glyphicon-search"></i>
        </button>
      </div>
    </div>
  {!! Form::close() !!} --}}
@if (count($thongbao)>0)
<div class="list-group">
  <a  class="list-group-item active thong-bao" href="/loai-van-ban/thong-bao">
    <span class="glyphicon glyphicon-volume-up site-logo" aria-hidden="true"></span> <strong>THÔNG BÁO</strong>
  </a>
  <div class="list-group-item">
  @foreach ($thongbao as $tb)
    <a href="{{$tb->tepvanban}}" target="_blank">
      <span class="glyphicon glyphicon-paperclip site-logo" aria-hidden="true"></span> {{ $tb->trichyeuvb}}
    </a>
  @endforeach
  </div>
</div>
@endif

{{-- <div class="list-group">

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
              <img class="slide-image" src="{{ $slide1['hinh'] }}" alt="{{ $slide1['tieude'] }}" width="100%">
          </div>

          @foreach ($slider as $slide)

          <div class="item">
              <img class="slide-image" src="{{ $slide->hinh}}" alt="{{ $slide->tieude}}" width="100%">
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
</div> --}}
{{-- <div id="quangcao">
</div>
<div class="list-group">
  <a  class="list-group-item active main-color-bg in-hoa-dam">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Điều hành tác nghiệp
  </a>

  <a class="dichvucong" href="/lich-cong-tac" target="_blank">
    <img class="img-responsive" src="./img/banner-right/2.jpg" style="display:block; margin:0 auto" width="100%">
  </a>
  <a class="dichvucong" href="http://guinhanvb.hatinh.gov.vn/" target="_blank">
    <img class="img-responsive" src="./img/banner-right/1.jpg" style="display:block; margin:0 auto" width="100%">
  </a>
  <a class="dichvucong" href="https://mail.hatinh.gov.vn/" target="_blank">
    <img class="img-responsive" src="./img/banner-right/3.jpg" style="display:block; margin:0 auto" width="100%">
  </a>
  <a class="dichvucong" href="http://qppl.hatinh.gov.vn/vbpq_hatinh.nsf" target="_blank">
    <img class="img-responsive" src="./img/banner-right/4.jpg" style="display:block; margin:0 auto" width="100%">
  </a>
</div> --}}


{{-- <div class="list-group">
  <a  class="list-group-item active" style="background-color:#067719">
    <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <strong>Tài liệu hỗ trợ người dùng</strong>
  </a>
  <a  class="list-group-item" href="http://thuyettrinh.dangquocdung.com/webxa.html" target="_blank">
    <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> Thuyết minh trang điện tử
  </a>
  <a  class="list-group-item" href="/huongdanbientapweb.pdf" target="_blank">
    <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> Tài liệu Hướng dẫn Quản trị
  </a>
</div> --}}



{{-- 
<div class="list-group">
  <a class="dichvucong" href="http://hatinh.dcs.vn/" target="_blank">
    <img class="img-responsive" src="./img/banner-right/chinhdondang.gif" style="display:block; margin:0 auto" width="100%">
  </a>
  <a class="dichvucong" href="http://www.hatinh.gov.vn/hochiminh" target="_blank">
    <img class="img-responsive" src="./img/banner-right/hochiminh.gif" style="display:block; margin:0 auto" width="100%">
  </a>
</div>



<div class="list-group">
  <a  class="list-group-item active main-color-bg in-hoa-dam">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dịch vụ công trực tuyến
  </a>
  <a class="dichvucong" href="http://dichvucong.hatinh.gov.vn/portaldvc/KenhTin/thu-tuc-hanh-chinh.aspx?_nlv=XP&_tk=" target="_blank">
    <img class="img-responsive" src="./img/banner-right/dichvucong_tt.jpg" style="display:block; margin:0 auto" width="100%">
  </a>
</div>

<div class="list-group">
  <a class="dichvucong" href="http://qlccvc.hatinh.gov.vn/index.php?option=com_users&view=login" target="_blank">
    <img class="img-responsive" src="./img/banner-right/5.jpg" style="display:block; margin:0 auto" width="100%">
  </a>
  <a class="dichvucong" href="https://sso.hatinh.dcs.vn/cas/login" target="_blank">
    <img class="img-responsive" src="./img/banner-right/tinhuy.png" style="display:block; margin:0 auto" width="100%">
  </a>
  <a class="dichvucong" href="http://www.hatinh.gov.vn/nghiquyethoidongnhandan/" target="_blank">
    <img class="img-responsive" src="./img/banner-right/hoidongnhandan.jpg" style="display:block; margin:0 auto" width="100%">
  </a>
  <a class="dichvucong" href="http://dbndhatinh.vn/dbnd/default/index?folder_id=177" target="_blank">
    <img class="img-responsive" src="./img/banner-right/baucu.jpg" style="display:block; margin:0 auto" width="100%">
  </a>
</div>

<div class="list-group">
  <a  class="list-group-item active main-color-bg in-hoa-dam">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Bản đồ địa giới
  </a>
  <a class="bando" href="./img/bando/{{ config('app.brand')}}.jpg">
    <img class="img-responsive" src="./img/bando/{{ config('app.brand')}}.jpg" style="display:block; margin:0 auto" width="100%">
  </a>
</div> --}}

@if ($video1)
<div class="list-group">
  <a class="list-group-item active main-color-bg in-hoa-dam" href="/loai-tin/video">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Video Clips
  </a>
  <div class="video-container">
    {!! $video1->videoclip !!}
  </div>
</div>
@endif



{{-- <div class="list-group">
  <a  class="list-group-item active main-color-bg in-hoa-dam">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Nông thôn mới
  </a>

  <a class="dichvucong" href="http://nongthonmoihatinh.vn/" target="_blank">
    <img class="img-responsive" src="./img/banner-right/nongthonmoi.jpg" style="display:block; margin:0 auto" width="100%">
  </a>

</div>


<div class="list-group">
  <a class="dichvucong" href="http://ttcntt.hatinh.gov.vn/" target="_blank">
    <img class="img-responsive" src="./img/banner-right/ttcntt.jpg" style="display:block; margin:0 auto" width="100%">
  </a>
</div> --}}

<div class="list-group">
  <a  class="list-group-item active main-color-bg in-hoa-dam">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Du lịch biển Hà Tĩnh
  </a>
  <a class="dichvucong" href="http://dulichbien.hatinh.top/" target="_blank">
    <img class="img-responsive" src="./img/banner-right/dulichbien.jpg" style="display:block; margin:0 auto" width="100%">
  </a>
</div>

<div class="list-group">
  <a  class="list-group-item active main-color-bg in-hoa-dam">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Thời tiết Hà Tĩnh
  </a>
  <a class="dichvucong" href="#">
    <a href="https://www.accuweather.com/vi/vn/ha-tinh/353418/weather-forecast/353418" class="aw-widget-legal">
    <!--
    By accessing and/or using this code snippet, you agree to AccuWeather’s terms and conditions (in English) which can be found at https://www.accuweather.com/en/free-weather-widgets/terms and AccuWeather’s Privacy Statement (in English) which can be found at https://www.accuweather.com/en/privacy.
    -->
    </a>
    <div id="awcc1491117457730" class="aw-widget-current"  data-locationkey="353418" data-unit="c" data-language="vi" data-useip="false" data-uid="awcc1491117457730"></div>
    <script type="text/javascript" src="https://oap.accuweather.com/launch.js"></script>
  </a>
</div>

{{-- <div class="list-group">
  <a  class="list-group-item active main-color-bg in-hoa-dam">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Trụ sở xã
  </a>

  <div id="googleMap"></div>
</div> --}}

{{-- <div class="hidden-xs hidden-sm">
  <script type="text/javascript" src="https://counter1.fcs.ovh/private/counter.js?c=a67ubwhmw66h1sq9gr21llxun5xqufht"></script>
  <noscript><a href="https://www.freecounterstat.com" title="hit counter"><img src="https://counter1.fcs.ovh/private/freecounterstat.php?c=a67ubwhmw66h1sq9gr21llxun5xqufht" border="0" title="hit counter" alt="hit counter"></a></noscript>
</div> --}}
