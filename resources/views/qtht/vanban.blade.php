@extends('front.layouts.home')
@section('title')
  <title>Quản trị Văn bản | {{ config('app.name', 'Dang Quoc Dung') }}</title>
@endsection
@section('menu-ngang')
  @include('qtht.layouts.menu-ngang')
@endsection
@section('content')
  <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading  in-hoa-dam">
          <strong>Danh sách văn bản</strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-2 col-xs-4">
              <div style="padding-bottom:10px">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addVanBan">Thêm Văn bản</button>
                {{-- <a class="btn btn-primary" href="/qtht/van-ban/them-van-ban"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm văn bản</a> --}}
              </div>
            </div>
            <div class="col-md-4 col-md-push-6 col-xs-6 col-xs-push-2">
              {!! Form::open(['method'=>'GET', 'ulr'=>'qtht/van-ban/home', 'role'=>'search']) !!}
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
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <tbody>
              <tr>
                <th>Ngày ban hành</th>
                <th>Số</th>
                <th>Trích yếu</th>
                <th>Tệp Văn bản</th>
                <th>Người kí</th>
                <th>Loại văn bản</th>
                <th>Chuyên mục</th>
                <th>Người đăng</th>
                <th>Đã duyệt</th>
                <th>Thao tác</th>
              </tr>
              @foreach ($vanban as $vb)
              <tr>
                <td>{{ $vb->ngaybanhanhvb }}</td>
                <td>{{ $vb->sovb }}</td>
                <td style="text-align:left;">{{ str_limit($vb->trichyeuvb, $limit=120, $end='......') }}</td>
                <td style="text-align:left;">
                  <a href="./van-ban/tep-van-ban/{{$vb->tepvanban}}" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                </td>
                <td>{{ $vb->nguoiki }}</td>
                <td>{{ $vb->loaivb->ten }}</td>
                <td>{{ $vb->menuvb->ten }}</td>
                <td>{{ $vb->nguoidang->name }}</td>
                <td>
                  @if ($vb->active==0)
                    <input type="checkbox" name="" value="" disabled="">
                  @else
                    <input type="checkbox" name="" value="" checked="" disabled="">
                  @endif
                </td>
                <td style="text-align: center;">
                  @if ($vb->active==0 || Auth::user()->level > 2 )
                    <form action="#" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <a class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editVanBan">
                        <span class="glyphicon glyphicon-edit"></span>
                      </a>
                      <a href="{{ url('qtht/van-ban/xoa-van-ban/'.$vb->id.'?token='.csrf_token()) }}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn chắc chắn muốn xoá văn bản này?')">
                        <span class="glyphicon glyphicon-trash"></span>
                      </a>
                    </form>
                  @endif
                </td>
              </tr>
              @endforeach
              </tbody>
            </table>
            {{-- pagination --}}
            {!! $vanban->links() !!}
          </div>
        </div>
    </div>
  </div>
  <!-- Thêm Văn bản -->
  <div class="modal fade" id="addVanBan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        {!! Form::open(['method'=>'POST','url'=>'qtht/van-ban','enctype'=>'multipart/form-data']) !!}
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><strong>Thêm văn bản</strong></h4>
        </div>
        <div class="modal-body">
          <div class="modal-body">
            <div class="form-group">
              <label>Chọn chuyên mục văn bản</label>
              <select class="form-control" name="menuvb_id" required="">
                @foreach ($menuvb as $lt)
                  <option value="{{ $lt->id}}">{{ $lt->ten}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Loại văn bản</label>
              <select class="form-control" name="loaivb_id" required="">
                @foreach ($loaivb as $lvb)
                  <option value="{{ $lvb->id}}">{{ $lvb->ten }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Số, kí hiệu</label>
              <input type="text" class="form-control" name="sovb" value="{{ old('sovb')}}" placeholder="Số, kí hiệu văn bản" required="">
            </div>
            <div class="form-group">
              <label>Trích yếu văn bản</label>
              <input type="text" class="form-control" name="trichyeuvb" value="{{ old('trichyeuvb')}}" placeholder="Trích yếu văn bản" required=""/>
            </div>
            <div class="form-group">
                <label>Tệp văn bản (đính kèm)</label>
                <input type="file" name="tepvanban" required=""/>
            </div>
            <div class="form-group">
              <label>Ngày ban hành</label>
              <input type="date" class="form-control" name="ngaybanhanhvb" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required=""/>
            </div>
            <div class="form-group">
              <label>Người kí</label>
              <input class="form-control" name="nguoiki" value="{{ old('nguoiki')}}" placeholder="Người kí văn bản..." required=""/>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

  <!-- Sửa Văn bản -->
  @if (count($vanban) > 0)
  <div class="modal fade" id="editVanBan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        {!! Form::open(['method'=>'POST','url'=>'qtht/van-ban/sua-van-ban','enctype'=>'multipart/form-data']) !!}
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden" name="id" value="{{ $vb->id }}"/>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><strong>Edit văn bản</strong></h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Chuyên mục văn bản</label>
            <select class="form-control" name="menuvb_id" required="">
              @foreach ($menuvb as $lt)
                @if ($vb->menuvb_id == $lt->id)
                  <option value="{{ $lt->id}}" selected="">{{ $lt->ten}}</option>
                @else
                  <option value="{{ $lt->id}}">{{ $lt->ten}}</option>
                @endif
              @endforeach

            </select>
          </div>

          <div class="form-group">
            <label>Loại văn bản</label>
            <select class="form-control" name="loaivb_id" required="">
              @foreach ($loaivb as $lvb)
                @if ($vb->loaivb_id == $lvb->id)
                  <option value="{{ $lvb->id}}" selected="">{{ $lvb->ten }}</option>
                @else
                  <option value="{{ $lvb->id}}">{{ $lvb->ten }}</option>
                @endif

              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Số, kí hiệu</label>
            <input type="text" class="form-control" name="sovb" value="{{ $vb->sovb }}{{ old('sovb')}}" placeholder="Số, kí hiệu văn bản" required="">
          </div>

          <div class="form-group">
            <label>Trích yếu văn bản</label>
            <input type="text" class="form-control" name="trichyeuvb" value="{{ $vb->trichyeuvb }}{{ old('trichyeuvb')}}" placeholder="Trích yêu văn bản" required=""/>
          </div>

          <div class="form-group">
              <label>Tệp văn bản (đính kèm)</label>
              <br>
              <a href="{{$vb->tepvanban}}" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp{{ $vb->sovb }}</a>
              <input type="file" name="tepvanban"/>
          </div>

          <div class="form-group">
            <label>Ngày ban hành</label>
            <input type="date" class="form-control" name="ngaybanhanhvb" value="{{ $vb->ngaybanhanhvb }}{{ old('ghichu')}}" required=""/>
          </div>

          <div class="form-group">
            <label>Người kí</label>
            <input class="form-control" name="nguoiki" value="{{ $vb->nguoiki }}{{ old('nguoiki')}}" placeholder="Người kí văn bản..." required=""/>
          </div>
        </div>
        <div class="modal-footer">
          @if ( Auth::user()->is_admin() )
            <input type="submit" name="capnhat" value="Cập nhật" class="btn btn-success" >
            <input type="submit" name="duyetdang" value="Duyệt Đăng" class="btn btn-primary" >
          @elseif ( Auth::user()->is_tbbt() )
            <input type="submit" name="duyetdang" value="Duyệt Đăng" class="btn btn-primary" >
          @elseif ( $vb->user_id == Auth::user()->id )
            <input type="submit" name="capnhat" value="Cập nhật" class="btn btn-success" >
          @endif
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
  @endif
@endsection
