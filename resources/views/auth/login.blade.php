@extends('front.layouts.home')
@section('title')
  <title>Đăng nhập | {{ config('app.name', 'Dang Quoc Dung') }}</title>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="border-radius: 5px; margin-top: 50px;">
                <div class="panel-heading" style="border-radius: 5px 5px 0 0;">Đăng nhập quản trị</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        @if ($message = Session::get('success'))
                          <div class="alert alert-success">
                            <p>
                              {{ $message }}
                            </p>
                          </div>
                        @endif
                        @if ($message = Session::get('warning'))
                          <div class="alert alert-warning">
                            <p>
                              {{ $message }}
                            </p>
                          </div>
                        @endif
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Tài khoản</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label for="password" class="col-md-4 control-label">Mật khẩu</label>

                          <div class="col-md-6">
                              <input id="password" type="password" class="form-control" name="password" required>

                              @if ($errors->has('password'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <div class="checkbox">
                                  <label>
                                      <input type="checkbox" name="remember"> Remember Me
                                  </label>
                              </div>
                          </div>
                      </div> --}}

                      <div class="form-group">
                          <div class="col-md-4 col-md-offset-8">
                              <button type="submit" class="btn btn-primary" style="float: right">
                                  Đăng nhập
                              </button>

                              {{-- <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                  Forgot Your Password?
                              </a> --}}
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
