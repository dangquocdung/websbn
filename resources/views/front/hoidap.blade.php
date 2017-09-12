@extends('front.layouts.home')
@section('title')
  <title>Hỏi & Đáp</title>
@endsection
@section('content')
  <div class="list-group">
    <div  class="list-group-item active main-color-bg in-hoa-dam">
      <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> &nbspHỏi & Đáp

      <p class="pull-right visible-xs" >
        <a data-toggle="offcanvas" style="color:red">
          <span class="glyphicon glyphicon-forward site-logo" aria-hidden="true"></span>
        </a>
      </p>
    </div>
    <div class="list-group-item">
      @if (count($hoidap) == 0)
        @if ($loai == 'hoidap')
          <p style="text-align: center"><i class="fa fa-cubes" aria-hidden="true"></i> <em>Chỉ những câu hỏi đã được BBT kiểm duyệt mới được hiện thị!</em></p>
        @else
          <p style="text-align: center"><i class="fa fa-cubes" aria-hidden="true"></i> <em>Chỉ những góp ý đã được BBT kiểm duyệt mới được hiện thị!</em></p>
        @endif
          <a href="/">
            <p style="text-align: center"><i class="fa fa-reply" aria-hidden="true"></i> <strong>Quay lại</strong></p>
          </a>
      @else
        @foreach ($hoidap as $hd)
              <p class="pull-right"><em>Ngày {{ Carbon\Carbon::parse($hd->created_at)->format('d-m-Y h:i:s') }} - {{ $hd->hoten }} ({{ $hd->email }})</em></p>
              <p><strong><em>{{ $hd->tieude }}</em></strong></p>
              <p><em>{!! $hd->noidung !!}</em></p>
              <p><strong><u>Ban biên tập</u>:</strong></p>
              @if ($loai == 'hoidap')
                @if ($hd->nguoitraloi )
                  <p>{!! $hd->traloi !!}</p>
                @else
                  <p><em>Cảm ơn bạn đã đặt câu hỏi, chúng tôi sẽ trả lời câu hỏi của bạn trong thời gian nhanh nhất có thể!</em></p>
                @endif
              @endif
          <hr>
        @endforeach
      @endif
      </div>
    </div>


    <p class="pull-right" >
      @if ($loai == 'hoidap')
        <a class="btn btn-info" href="dat-cau-hoi"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbspĐặt câu hỏi</a>
      @else
        <a class="btn btn-info" href="thu-gop-y"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbspThư góp ý</a>
      @endif

    </p>
@endsection
