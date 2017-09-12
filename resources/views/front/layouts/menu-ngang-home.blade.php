@section('menu-ngang')
  <div class="menu-ngang">
    <div class="container">
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active">
            <a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
          </li>
          @if ($menutop)
            @foreach ($menutop as $mt)
              {{-- @if ($mt->id < 4) --}}
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ $mt->ten }} 
                    @if (count($mt->loaitin) > 0)
                      <span class="caret"></span>
                    @endif
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    @foreach ($mt->loaitin as $lt)
                      @if ( $lt->menutop_id == $mt->id )
                        <li><a href="/loai-tin/{{$lt->slug}}"><i class="fa fa-tag" aria-hidden="true"></i> &nbsp{{ $lt->ten }}</a></li>
                      @endif
                    @endforeach
                    {{-- Hỏi đáp --}}
                    @if ($mt->slug == 'lien-he')

                    <li class="divider"></li>
                    <li><a href="/hoi-dap"><i class="fa fa-comments-o" aria-hidden="true"></i> &nbsp;Hỏi & Đáp</a></li>
                    <li><a href="/gop-y"><i class="fa fa-envelope-o" aria-hidden="true"></i> &nbsp;Góp Ý</a></li>

                    @endif
                  </ul>
                </li>
            @endforeach
          @endif
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
            @if (Auth::guest())
                <li><a href="{{ route('login') }}"><i class="fa fa-user" aria-hidden="true"></i> &nbspĐăng nhập</a></li>
                {{-- <li><a href="{{ route('register') }}">Đăng kí</a></li> --}}
            @else

              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  <i class="fa fa-user" aria-hidden="true"></i> &nbsp{{ Auth::user()->name }} ({{ Auth::user()->level }})<span class="caret"></span>
              </a>

              <ul class="dropdown-menu" role="menu">
                  <li><a href="/qtht"><i class="fa fa-sign-in" aria-hidden="true"></i> Trang quản trị</a></li>
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
            @endif
          </li>
        </ul>
      </div><!-- /.nav-collapse -->
    </div>
  </div>
@endsection