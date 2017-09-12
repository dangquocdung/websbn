@extends('front.layouts.home')
@section('title')
  <title>{{ config('app.name', 'Dang Quoc Dung') }}</title>
@endsection
@section('content')

{{-- <div class="row"> --}}
  <!-- slider -->
  <div class="list-group">

       <div class="list-group-item active main-color-bg">
         <a href="/lich-cong-tac" style="text-transform:uppercase; color:white">
           <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
           {{ Carbon\Carbon::now()->formatLocalized('Ngày %d tháng %m năm %Y | %H:%M GMT+7') }}
         </a>
         <p class="pull-right visible-xs" >
           <a data-toggle="offcanvas" style="color:red">
             <span class="glyphicon glyphicon-forward site-logo" aria-hidden="true"></span>
           </a>
         </p>
       </div>
       <div class="tab-group-item">
         <!-- Tab panes -->
         <div class="tab-content">
           <div class="row">
             @php

               $tenNews = $mt->tintuc->where('active','1')->sortByDesc('created_at')->take(10);

               $toptenNews = $mt->tintuc->where('active','1')->where('tinnoibat',1)->sortByDesc('created_at')->take(11);

               $fn = $toptenNews->shift();

             @endphp
             <div class="col-md-7">
               @if ($fn)
                 <div id = "fnHinhMinhHoa" class="hinh-minh-hoa">
                   @if ($fn['urlhinh'])
                     <a href="/chi-tiet-tin/{{$fn['tieudekhongdau'] }}">
                       <img src="{{ $fn['urlhinh'] }}" alt="{{ $fn['tieude'] }}">
                     </a>
                   @else
                     <img src="image/placeholder.png">
                   @endif
                 </div>
                 <div id="fnTieuDe">
                   <h4 style="text-transform: uppercase; text-align:center"><a href="/chi-tiet-tin/{{$fn['tieudekhongdau'] }}">{{ $fn['tieude'] }}</a></h4>
                 </div>

                 <div id="fnTomTat" class="news-desc">
                   {{ $fn['tomtat'] }}
                 </div>
               @endif
             </div>
             <div class="col-md-5 hidden-xs hidden-sm">
               <ul class="nav nav-tabs" role="tablist">
                 <li class="active"><a href="#tin-moi" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span> <strong>TIN MỚI</strong></a></li>
                 <li><a href="#tin-noi-bat" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> <strong>TIN NỔI BẬT</strong></a></li>
               </ul>
               <div class="tab-content">
                 <div class="tab-pane active" id="tin-moi">
                   @foreach ($tenNews as $tn)
                     <div class="tin-moi">
                       <table>
                         <tr>
                           <td class = "minh-hoa-tin-moi">
                             @if ($tn->urlhinh)
                              <a href="/chi-tiet-tin/{{$tn->tieudekhongdau}}"><img src="{{ $tn->urlhinh }}" alt=""></a>
                             @else
                                 <img src="image/placeholder.png" alt="">
                             @endif
                           </td>
                           <td  class="tieu-de-tin-moi" style="text-align:left; padding-left: 10px;"><a href="/chi-tiet-tin/{{$tn->tieudekhongdau}}">{{ $tn->tieude }}</a></td>
                           <td class = "tom-tat-tin-moi" style="display:none;">
                             {{ $tn->tomtat }}
                           </td>
                         </tr>
                       </table>
                     </div>
                   @endforeach
                 </div>
                 <div class="tab-pane" id="tin-noi-bat">
                   @if ($fn)
                     <div class="tin-moi">
                       <table>
                         <tr>
                           <td class = "minh-hoa-tin-moi">
                           @if ($fn['urlhinh'])
                           <a href="/chi-tiet-tin/{{$fn['tieudekhongdau']}}">
                             <img src="{{ $fn['urlhinh'] }}" alt="" >
                           </a>
                           @else
                               <img src="image/placeholder.png" alt="">
                           @endif
                           </td>
                           <td class = "tieu-de-tin-moi" style="text-align:left; padding-left: 10px;"><a href="/chi-tiet-tin/{{$fn['tieudekhongdau']}}">{{ $fn['tieude'] }}</a></td>
                           <td class = "tom-tat-tin-moi" style="display:none;">
                             {{ $fn['tomtat'] }}
                           </td>
                         </tr>
                       </table>
                     </div>
                   @endif
                   @foreach ($toptenNews as $ttn)
                     <div class="tin-moi">
                       <table>
                         <tr>
                           <td class = "minh-hoa-tin-moi">
                           @if ($ttn->urlhinh)
                             <img src="{{ $ttn->urlhinh }}" alt="">
                           @else
                               <img src="image/placeholder.png" alt="">
                           @endif
                           </td>
                           <td  class="tieu-de-tin-moi" style="text-align:left; padding-left: 10px;"><a href="/chi-tiet-tin/{{$ttn->tieudekhongdau}}">{{ $ttn->tieude }}</a></td>
                           <td class = "tom-tat-tin-moi" style="display:none;">
                             {{ $ttn->tomtat }}
                           </td>
                         </tr>
                       </table>
                     </div>
                   @endforeach
                 </div>
               </div>
             </div>
           </div>

           {{-- Them thuoc tinh mouse enter --}}
           <script type="text/javascript">
             $(document).ready(function() {
              $(".tin-moi").mouseenter(function() {
                console.log("mouseenter");

                $(this).css({"background-color":"#337ab7"});


                $("#fnHinhMinhHoa").html($(this).find(".minh-hoa-tin-moi").html());
                $("#fnTieuDe").html("<h4 style='text-transform: uppercase; text-align:center'>"+ $(this).find(".tieu-de-tin-moi").html() +"</h4>");
                $("#fnTomTat").html($(this).find(".tom-tat-tin-moi").html());

                $(this).find("a").css({"color":"white"});

                // alert($(this).find(".minh-hoa-tin-moi").html());

              });

              $(".tin-moi").mouseleave(function() {
                console.log("mouseleave");
                $(this).css({"background-color":"transparent"})
                $(this).find("a").css({"color":"#337ab7"});
              });
            });
           </script>
           {{-- <div class="tab-pane" id="profile">Tin mới</div> --}}
         </div>
       </div>

  </div>
  <!-- end slide -->

  <div class="list-group">

  {{-- <div class="banner-giua"> --}}
    <img src="/img/banner/thuong-binh-liet-sy.jpg" alt="" width="100%">
  </div>

    @php
      $mt = $menutop->find(2);
      $loaitin = $mt->loaitin->all();
    @endphp

    @foreach ($loaitin as $lt)

        <div class="list-group">
          <a class="list-group-item active main-color-bg" href="/loai-tin/{{ $lt->slug }}" style="text-transform:uppercase">
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

              <div class="col-md-7 col-sm-12 col-xs-12 tintuc">
                <div class="col-md-5 col-sm-5 minhhoa">
                  @if ($tin1['urlhinh'])
                    <a href="/chi-tiet-tin/{{ $tin1['tieudekhongdau']}}">
                        <img src="{{ $tin1['urlhinh'] }}" alt="" width="100%">
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

              <div class="col-md-5 col-sm-5 hidden-xs hidden-sm">
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
                          <img src="{{ $tt->urlhinh }}" alt="" style="max-width:50px;">
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
              <a href="/loai-tin/{{ $lt->slug }}"><small>Nhiều hơn...</small></a>
            </div>
          </div>
        </div>

  @endforeach

{{-- </div> --}}
@endsection
