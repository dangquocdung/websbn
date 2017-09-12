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

@if ( Auth::user()->level > 1 )
  <div class="panel panel-default">
      <div class="panel-heading in-hoa-dam">
        @if ($loai == 'hoidap')
          <strong>Danh sách Hỏi & Đáp</strong>
        @else
          <strong>Danh sách Góp Ý</strong>
        @endif
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <tbody>
            <tr>
              <th>TT</th>
              <th>Họ tên</th>
              <th>Địa chỉ</th>
              <th>Điện thoại</th>
              <th>Email</th>
              <th>Tiêu đề</th>
              <th>Nội dung</th>
              <th>Đã duyệt</th>
              @if ($loai == 'hoidap')
                <th>Trả lời</th>
              @endif
              <th>Thao tác</th>
            </tr>
            @foreach ($hoidap as $hd)
              <tr>
                <td>{{ $hd->id}}</td>
                <td>{{ $hd->hoten}}</td>
                <td>{{ $hd->diachi}}</td>
                <td>{{ $hd->dienthoai}}</td>
                <td>{{ $hd->email}}</td>
                <td>{{ $hd->tieude}}</td>
                <td>{!! $hd->noidung !!}</td>
                <td>
                  @if ($hd->active==0)
                    <input type="checkbox" disabled="">
                  @else
                    <input type="checkbox" checked="" disabled="">
                  @endif
                </td>
                @if ($loai == 'hoidap')
                  <td>{!! $hd->traloi !!}</td>
                @endif
                <td style="text-align: center;">
                    <form action="#" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">

                      <a data-toggle="modal" data-target="#{{$hd->id}}" class="btn btn-warning btn-xs">
                        <span class="glyphicon glyphicon-edit"></span>
                      </a>
                      @if ($loai == 'hoidap')
                        <a href="{{ url('qtht/hoi-dap/xoa/'.$hd->id.'?token='.csrf_token()) }}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn chắc chắn muốn xoá?')">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      @else
                        <a href="{{ url('qtht/gop-y/xoa/'.$hd->id.'?token='.csrf_token()) }}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn chắc chắn muốn xoá?')">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      @endif
                    </form>
                </td>
              </tr>

              <!-- Modal -->
              <div class="modal fade" id="{{$hd->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    @if ($loai == 'hoidap')
                      {!! Form::open(['method'=>'POST','url'=>'/qtht/hoi-dap']) !!}
                    @else
                      {!! Form::open(['method'=>'POST','url'=>'/qtht/gop-y']) !!}
                    @endif

                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input type="hidden" name="id_cauhoi" value="{{$hd->id}}"/>

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Trả lời nhanh</h4>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                          <label>Họ tên: {{ $hd->hoten }}</label>
                      </div>
                      <div class="form-group">
                          <label>Địa chỉ:</label><span>&nbsp{{ $hd->diachi }}</span>
                      </div>
                      <div class="form-group">
                          <label>Điện thoại:</label><span>&nbsp{{ $hd->dienthoai }}</span>
                          &nbsp&nbsp&nbsp-&nbsp&nbsp&nbsp
                          <label>Email:</label><span>&nbsp{{ $hd->email }}</span>
                      </div>

                      <div class="form-group">
                          <label>Tiêu đề: {{ $hd->tieude }}</label>
                      </div>
                      <div class="form-group">
                          <label>Nội dung: </label>
                          <p>{!! $hd->noidung !!}</p>
                      </div>
                      {{-- <div class="form-group">
                          <label>Duyệt đăng:</label>
                          @if ($hd->active==0)
                            <input type="checkbox" name="capnhat">
                          @else
                            <input type="checkbox" name="duyetdang" checked="">
                          @endif
                      </div> --}}
                      @if ($loai == 'hoidap')
                        <div class="form-group">
                            <label>Trả lời:</label>
                            <textarea name="noidungtraloi" id="noidung" class="form-control" rows="10">{{$hd->traloi}}</textarea>
                        </div>
                      @endif
                    </div>
                    <div class="modal-footer">
                      {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                      <button onclick="return confirm('Bạn muốn tiếp tục?')" type="submit" class="btn btn-primary">Duyệt Đăng</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Đóng</button>
                    </div>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>

            @endforeach
            </tbody>
          </table>
          {{-- pagination --}}
          {{-- {!! $posts->links() !!} --}}
        </div>
      </div>
  </div>
@endif

@endsection
