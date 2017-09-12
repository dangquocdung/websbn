@extends('front.layouts.home')
@section('title')
  <title>Quản trị hình slide | {{ config('app.name', 'Dang Quoc Dung') }}</title>
@endsection
@section('menu-ngang')
  @include('qtht.layouts.menu-ngang')
@endsection
@section('content')
  <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading  in-hoa-dam">
              <strong>Danh sách hình slide</strong>
            </div>
            <div class="panel-body">
              <div style="padding-bottom:10px">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSlide">Thêm Slide</button>
                {{-- <a class="btn btn-primary" href="/qtht/hinh-slide/them-hinh-slide"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm hình slide</a> --}}
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <tr>
                    <th>TT</th>
                    <th>Tiêu đề</th>
                    <th>Hình</th>
                    <th>Thứ tự hiện thị</th>
                    <th>Thao tác</th>
                  </tr>
                  @foreach ($slider as $slide)
                  <tr>
                    <td>{{ $slide->id }}</td>
                    <td style="text-align:left;">{{ $slide->tieude }}</td>
                    <td>
                      <a class="urlhinh" href="{{ $slide->hinh }}">
                        <img class="img-responsive" src="./img/hinh-slide/{{ $slide->hinh }}" style="max-width:100px; max-height:50px; float:left">
                      </a>
                    </td>
                    <td>{{ $slide->thutu }}</td>
                    <td style="text-align: center;">
                      <form action="#" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <a class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editSlide{{$slide->id}}">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="{{ url('qtht/hinh-slide/xoa-hinh-slide/'.$slide->id.'?token='.csrf_token()) }}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn chắc chắn muốn xoá hình slide này?')">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </form>
                    </td>
                    <!-- Modal Sửa -->
                    <div class="modal fade" id="editSlide{{$slide->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        {!! Form::open(['method'=>'POST','url'=>'qtht/hinh-slide/sua-hinh-slide','enctype'=>'multipart/form-data']) !!}
                          <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                          <input type="hidden" name="id" value="{{ $slide->id }}"/>
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><strong>Edit Slide</strong></h4>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <label>Tiêu đề</label>
                              <input type="text" class="form-control" name="tieude" value="{{ $slide->tieude }}{{ old('tieude')}}" placeholder="Nhập Tiêu đề" required="">
                            </div>
                            <div class="form-group">
                              <label>Hình Ảnh</label>
                              <p style="font-style:italic;"><small>(độ phân giải tốt nhất 960x430px)</small></p>
                                <img src="{{ $slide->hinh }}" id="showimages" >
                                <input type="file" name="hinh" id="inputimages" />
                            </div>
                            <div class="form-group">
                              <label>Thứ tự hiển thị</label>
                              <select class="form-control" name="thutu" required="">
                                @for ($i = 1; $i < 10; $i++)
                                  @if ($i== $slide->thutu)
                                    <option value="{{ $i }}" selected="">{{ $i }}</option>
                                  @else
                                    <option value="{{ $i }}">{{ $i }}</option>
                                  @endif
                                @endfor
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Ghi chú</label>
                              <input class="form-control" name="ghichu" value="{{ $slide->ghichu }}{{ old('ghichu')}}" placeholder="Nhập ghi chú"/>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <input type="submit" name="publish" value="Cập nhật" class="btn btn-primary" >
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
        <div class="modal fade" id="addSlide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              {!! Form::open(['method'=>'POST','url'=>'qtht/hinh-slide','enctype'=>'multipart/form-data']) !!}
              <input type="hidden" name="_token" value="{{csrf_token()}}"/>
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><strong>Thêm Slide</strong></h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Tiêu đề</label>
                  <input type="text" class="form-control" name="tieude" value="{{ old('tieude')}}" placeholder="Nhập Tiêu đề" required="">
                </div>
                <div class="form-group">
                    <label>Hình Ảnh</label>
                    <p style="font-style:italic;"><small>(độ phân giải tốt nhất 960x430px)</small></p>
                    <img src="http://placehold.it/100x100" id="showimages" >
                    <input type="file" name="hinh" id="inputimages" required="" />
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
