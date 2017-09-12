
<div class="list-group">
  <a  class="list-group-item active main-color-bg">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Tìm kiếm
  </a>

  {!! Form::open(['method'=>'GET', 'ulr'=>'qtht/home', 'class'=>'list-group-item','role'=>'search']) !!}
    <div class="input-group">
      <input type="text" name="search" class="form-control" placeholder="Search...">
      <div class="input-group-btn">
        <button class="btn btn-default" type="submit">
          <i class="glyphicon glyphicon-search"></i>
        </button>
      </div>
    </div>
  {!! Form::close() !!}
</div>




<div class="list-group">

  <a class="dichvucong" href="http://www.hatinh.gov.vn/hochiminh" target="_blank">
    <img class="img-responsive" src="./img/banner-right/hochiminh.gif" style="display:block; margin:0 auto" width="100%">
  </a>
</div>

<div class="list-group">
  <a  class="list-group-item active main-color-bg">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Bản đồ Hà Tĩnh
  </a>
  <a class="bando" href="./img/map/hatinh_map.jpg">
    <img class="img-responsive" src="./img/map/hatinh_map.jpg" style="display:block; margin:0 auto" width="100%">
  </a>
</div>

<div class="list-group">
  <a class="dichvucong" href="http://hatinh.dcs.vn/" target="_blank">
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
  <a  class="list-group-item active main-color-bg">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Nông thôn mới
  </a>

  <a class="dichvucong" href="http://nongthonmoihatinh.vn/" target="_blank">
    <img class="img-responsive" src="./img/banner-right/nongthonmoi.jpg" style="display:block; margin:0 auto" width="100%">
  </a>

</div>

<div class="list-group">
  <a  class="list-group-item active main-color-bg">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Điều hành tác nghiệp
  </a>

  <a class="dichvucong" href="http://guinhanvb.hatinh.gov.vn/" target="_blank">
    <img class="img-responsive" src="./img/banner-right/1.jpg" style="display:block; margin:0 auto" width="100%">
  </a>
  <a class="dichvucong" href="/loai-tin/lich-lam-viec-lanh-dao" target="_blank">
    <img class="img-responsive" src="./img/banner-right/2.jpg" style="display:block; margin:0 auto" width="100%">
  </a>
  <a class="dichvucong" href="https://mail.hatinh.gov.vn/" target="_blank">
    <img class="img-responsive" src="./img/banner-right/3.jpg" style="display:block; margin:0 auto" width="100%">
  </a>
  <a class="dichvucong" href="http://qppl.hatinh.gov.vn/vbpq_hatinh.nsf" target="_blank">
    <img class="img-responsive" src="./img/banner-right/4.jpg" style="display:block; margin:0 auto" width="100%">
  </a>
</div>




<div class="list-group">
<a  class="list-group-item active main-color-bg">
  <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dịch vụ công trực tuyến
</a>
<a class="dichvucong" href="/loai-tin/dich-vu-cong-truc-tuyen" target="_blank">
  <img class="img-responsive" src="./img/banner-right/dichvucong_tt.jpg" style="display:block; margin:0 auto" width="100%">
</a>
</div>





<div class="list-group">
<a  class="list-group-item active main-color-bg">
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

<div class="list-group">
<a  class="list-group-item active main-color-bg">
  <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Trụ sở xã
</a>

<div id="googleMap"></div>
</div>
