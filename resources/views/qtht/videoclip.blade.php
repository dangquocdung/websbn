@extends('front.layouts.home')
@section('menu-ngang')
  @include('qtht.layouts.menu-ngang')
@endsection
@section('content')
  <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading  in-hoa-dam">
          <strong>Danh sách video</strong>
        </div>
        <div class="panel-body">
          <div style="padding-bottom:10px">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addVideo">Thêm Video</button>
            {{-- <a class="btn btn-primary" href="/qtht/video-clip/them-video"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm video</a> --}}
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <tr>
                <th>TT</th>
                <th>Tiêu đề</th>
                <th>Video</th>
                <th>Thứ tự hiện thị</th>
                <th>Thao tác</th>
              </tr>
              @foreach ($videos as $video)
              <tr>
                <td>{{ $video->id }}</td>
                <td style="text-align:left;">{{ $video->tieude }}</td>
                <td>
                  <div class="video-container">
                    {!! $video->videoclip !!}
                  </div>
                </td>
                <td>{{ $video->thutu }}</td>
                <td style="text-align: center;">
                  <form action="#" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <a class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editVideo{{$video->id}}">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="{{ url('qtht/video-clip/xoa-video/'.$video->id.'?token='.csrf_token()) }}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn chắc chắn muốn xoá video này?')">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </form>
                </td>
                <!-- Modal Sửa -->
                <div class="modal fade" id="editVideo{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      {!! Form::open(['method'=>'POST','url'=>'qtht/video-clip/sua-video']) !!}
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input type="hidden" name="id" value="{{ $video->id }}"/>
                        <div class="modal-body">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><strong>Edit Video</strong></h4>
                          </div>
                          <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" class="form-control" name="tieude" value="{{ $video->tieude }}" placeholder="Nhập Tiêu đề" required="">
                          </div>
                          <div class="form-group">
                            <label>Mã nhúng youtube của video</label>
                            <input type="text" class="form-control" name="videoclip" value="{{ $video->videoclip }}" placeholder="Nhập youtube embed code" required="">
                          </div>
                          <div class="form-group">
                            <label>Thứ tự hiển thị</label>
                            <select class="form-control" name="thutu" required="">
                              @for ($i = 1; $i < 10; $i++)
                                @if ($i== $video->thutu)
                                  <option value="{{ $i }}" selected="">{{ $i }}</option>
                                @else
                                  <option value="{{ $i }}">{{ $i }}</option>
                                @endif
                              @endfor
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Ghi chú</label>
                            <input class="form-control" name="ghichu" value="{{ $video->ghichu }}" placeholder="Nhập ghi chú"/>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <input type="submit" name="publish" value="Đăng" class="btn btn-primary" >
                        </div>
                        {!! Form::close() !!}
                    </div>
                  </div>
                </div>
              </tr>
              @endforeach
            </table>
          </div>
        </div>
    </div>
    <!-- Modal Thêm  -->
    <div class="modal fade" id="addVideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><strong>Thêm Video</strong></h4>
          </div>
          {!! Form::open(['method'=>'POST','url'=>'qtht/video-clip']) !!}
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="modal-body">
              <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" class="form-control" name="tieude" value="{{ old('tieude')}}" placeholder="Nhập Tiêu đề" required="">
              </div>
              <div class="form-group">
                <label>Mã nhúng youtube của video</label>
                <input type="text" class="form-control" name="videoclip" value="{{ old('videoclip')}}" placeholder="Nhập youtube embed code" required="">
              </div>
              <div class="form-group">
                <label>Thứ tự hiển thị</label>
                <select class="form-control" name="thutu" required="">
                  @for ($i = 1; $i < 10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
                </select>
              </div>
              <div class="form-group">
                <label>Ghi chú</label>
                <input class="form-control" name="ghichu" value="{{ old('ghichu')}}" placeholder="Nhập ghi chú"/>
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" name="publish" value="Đăng" class="btn btn-primary" >
            </div>
            {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
