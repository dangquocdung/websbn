<div class="menu-ngang">
  <div class="container">

    <div class="collapse navbar-collapse">


      <ul class="nav navbar-nav">
        <li>
          <a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
        </li>
        <li><a href="/qtht">Tin-Bài</a></li>
        <li><a href="/qtht/thu-vien-hinh-anh">Hình Ảnh</a></li>
        <li><a href="/qtht/van-ban">Văn bản</a></li>
        <li><a href="/qtht/lich-cong-tac">Lịch công tác</a></li>
        <li><a href="/qtht/hoi-dap">Hỏi đáp</a></li>
        <li><a href="/qtht/gop-y">Góp ý</a></li>
      </ul>


      <ul class="nav navbar-nav navbar-right">

        <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <i class="fa fa-user" aria-hidden="true"></i> &nbsp{{ Auth::user()->name }} ({{ Auth::user()->level }})<span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                @if ( Auth::user()->is_admin() || Auth::user()->is_tbbt() )
                  <li>
                    <a href="/qtht/hinh-slide">
                      <i class="fa fa-cog" aria-hidden="true"></i> Quản lí hình slide
                    </a>
                  </li>
                  <li>
                    <a href="/qtht/video-clip">
                      <i class="fa fa-cog" aria-hidden="true"></i> Quản lí Video
                    </a>
                  </li>
                  <li class="divider"></li>
                @endif


                @if ( Auth::user()->is_admin() )

                  <li>
                    <a href="/qtht/chuyen-muc">
                      <i class="fa fa-cog" aria-hidden="true"></i> Quản lí chuyên mục
                    </a>
                  </li>

                  <li>
                    <a href="/qtht/menu">
                      <i class="fa fa-cog" aria-hidden="true"></i> Quản lí loại tin
                    </a>
                  </li>
                  <li class="divider"></li>
                @endif


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
