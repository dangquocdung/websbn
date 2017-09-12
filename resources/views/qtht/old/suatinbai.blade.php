@extends('front.layouts.home')

@section('menu-ngang')

<div class="menu-ngang">
  <div class="container">

    <div class="collapse navbar-collapse">


      @if ( Auth::user()->level > 1 )
      <ul class="nav navbar-nav">
        <li class="active">
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

@endsection

@section('content')

        <div class="panel panel-default">

          <div class="panel-heading"><strong>Sửa tin/bài</strong></div>

          <div class="panel-body">
            {!! Form::open(['method'=>'POST','url'=>'qtht/sua-tin-bai/','enctype'=>'multipart/form-data']) !!}
              <input type="hidden" name="_token" value="{{csrf_token()}}"/>
              <input type="hidden" name="tintuc_id" value="{{ $tintuc->id }}"/>

              <div class="modal-body">
                <div class="form-group">
                  <label>Loại tin</label>
                  <select class="form-control" name="loaitin_id" required="">
                    @foreach ($chuyenmuc as $cm)
                      @if ($cm->id < 3 || $cm->id == 4)
                        @foreach ($cm->loaitin as $lt)
                          @if ($tintuc->loaitin_id == $lt->id )
                            <option value="{{ $lt->id}}" selected="">{{ $lt->menutop->ten}} | {{ $lt->ten}}</option>
                          @else
                            <option value="{{ $lt->id}}">{{ $lt->menutop->ten}} | {{ $lt->ten}}</option>
                          @endif
                        @endforeach
                      @endif
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label>Tiêu đề</label>
                  <input type="text" class="form-control" name="tieude" value="{{ $tintuc->tieude }}" required="">
                </div>

                <div class="form-group">
                  <label>Tin nổi bật</label> &nbsp;
                  @if ( $tintuc->tinnoibat == 1)
                    <input type="checkbox" name="tinnoibat" checked >
                  @else
                    <input type="checkbox" name="tinnoibat">

                  @endif
                </div>

                <div class="form-group">
                  <label>Tóm tắt</label>
                  <input type="text" class="form-control" name="tomtat" rows="3" value="{{ $tintuc->tomtat }}" required=""/>
                </div>

                <div class="form-group">
                    <label>Hình Ảnh</label>
                    <img src="{{ $tintuc->urlhinh }}" id="showimages" >
                    <input type="file" name="urlhinh" id="inputimages" />
                </div>

                <div class="form-group">
                    <label>Nội dung</label>
                    <textarea name="noidung" id="noidung" class="form-control" rows="10">
                      {!! $tintuc->noidung !!}
                    </textarea>
                </div>

                <div class="form-group">
                  <label>Ghi chú</label>
                  <input class="form-control" name="ghichu" rows="3" value="{{ $tintuc->ghichu }}"/>
                </div>

              </div>

              <div class="modal-footer">
                @if ( Auth::user()->is_admin() )
                  <input type="submit" name="capnhat" value="Cập nhật" class="btn btn-success" >
                  <input type="submit" name="duyetdang" value="Duyệt Đăng" class="btn btn-primary" >
                @elseif ( Auth::user()->is_tbbt() )
                  <input type="submit" name="duyetdang" value="Duyệt Đăng" class="btn btn-primary" >
                @elseif ( $tintuc->user_id == Auth::user()->id )
                  <input type="submit" name="capnhat" value="Cập nhật" class="btn btn-success" >
                @endif
              </div>
              {!! Form::close() !!}
          </div>
        </div>



@endsection
