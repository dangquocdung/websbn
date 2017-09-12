@extends('front.layouts.home')

@section('title')
  <title>Đổi mật khẩu | {{ config('app.name', 'Dang Quoc Dung') }}</title>
@endsection

@section('menu-ngang')

  @include('qtht.layouts.menu-ngang')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading  in-hoa-dam">Đổi mật khẩu tài khoản {{ Auth::user()->email }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/qtht/doi-mat-khau') }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <input type="hidden" name="id" value="{{ Auth::user()->id }}">


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


                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label for="password" class="col-md-4 control-label">Mật khẩu hiện tại</label>

                          <div class="col-md-6">
                              <input id="password" type="password" class="form-control" name="password" placeholder="Mật khẩu hiện thời" required>
                          </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label for="password" class="col-md-4 control-label">Mật khẩu mới</label>

                          <div class="col-md-6">
                            <input id="password-new" type="password" class="form-control" name="password_new" placeholder="Mật khẩu mới" required>
                          </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label for="password" class="col-md-4 control-label">Xác nhận mật khẩu mới</label>

                          <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirm" placeholder="Nhập lại mật khẩu mới"required>
                          </div>
                        </div>
                        <br>



                      <div class="form-group">
                          <div style="text-align:right; padding-right:12px">
                              <button onclick="return confirm('Tiếp tục để đổi mật khẩu?');" type="submit" class="btn btn-primary">
                                  Đổi mật khẩu
                              </button>
                              <button onclick="goBack()" class="btn btn-primary">Trở về</button>
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

  var password = document.getElementById("password-new")
    , confirm_password = document.getElementById("password-confirm");

  function validatePassword(){
    if(password.value != confirm_password.value) {
      confirm_password.setCustomValidity("Mật khẩu chưa giống!");
    } else {
      confirm_password.setCustomValidity('');
    }
  }

  password.onchange = validatePassword;
  confirm_password.onkeyup = validatePassword;

</script>

@endsection
