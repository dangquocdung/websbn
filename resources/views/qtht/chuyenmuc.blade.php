@extends('front.layouts.home')
@section('title')
  <title>Quản trị Chuyên mục | {{ config('app.name', 'Dang Quoc Dung') }}</title>
@endsection
@section('menu-ngang')
  @include('qtht.layouts.menu-ngang')
@endsection
@section('content')

  <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading in-hoa-dam">
              <strong>Danh sách Loại tin</strong>
            </div>
            <div class="panel-body">
              <div style="padding-bottom:10px">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addVideo">Thêm Chuyên mục</button>
                {{-- <a class="btn btn-primary" href="/qtht/chuyen-muc/them-chuyen-muc"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm Chuyên mục</a> --}}
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <tr>
                    <th>TT</th>
                    <th>Chuyên mục</th>
                    <th>URL</th>
                    <th>TT Hiển thị</th>
                    <th>Số Loại tin</th>
                    <th>Số tin</th>
                    <th>Ghi chú</th>
                    <th>Thao tác</th>
                  </tr>
                  @foreach ($chuyenmuc as $cm)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td style="text-align:left;">{{ $cm->ten }}</td>
                    <td style="text-align:left;">{{ $cm->slug }}</td>
                    <td>{{ $cm->thutu }}</td>
                    <td>
                      <?php $i=0; ?>
                      @foreach ($loaitin as $lt)
                        @if ($lt->menutop_id == $cm->id)
                          <?php $i++ ; ?>
                        @endif
                      @endforeach
                      {{ $i }}
                    </td>
                    <td>
                      <?php $i=0; ?>
                      @foreach ($tintuc as $tt)
                        @if ($tt->loaitin->menutop->id == $cm->id)
                          <?php $i++ ; ?>
                        @endif
                      @endforeach
                      {{ $i }}
                    </td>
                    <td style="text-align:left;">{{ $cm->ghichu }}</td>
                    <td style="text-align: center;">
                      <form action="#" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <a class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editChuyenMuc{{$cm->id}}">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="{{ url('qtht/chuyen-muc/xoa-chuyen-muc/'.$cm->id.'?token='.csrf_token()) }}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn chắc chắn muốn xoá chuyên mục này?')">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </form>
                    </td>
                    <!-- Modal Sửa -->
                    <div class="modal fade" id="editChuyenMuc{{$cm->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><strong>Edit Chuyêm mục</strong></h4>
                          </div>
                          {!! Form::open(['method'=>'POST','url'=>'qtht/chuyen-muc/sua-chuyen-muc']) !!}
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <input type="hidden" name="id" value="{{ $cm->id }}}"/>
                            <div class="modal-body">
                              <div class="form-group">
                                <label>Chuyên mục</label>
                                <input type="text" class="form-control" name="ten" value="{{ $cm->ten }}{{ old('ten')}}" placeholder="Nhập Tên Loại tin" required="">
                              </div>
                              <div class="form-group">
                                <label>Thứ tự hiển thị</label>
                                <select class="form-control" name="thutu" required="">
                                  @for ($i = 1; $i < 10; $i++)
                                    @if ($cm->thutu == $i )
                                      <option value="{{ $i }}" selected="">{{ $i }}</option>
                                    @else
                                      <option value="{{ $i }}">{{ $i }}</option>
                                    @endif
                                  @endfor
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Ghi chú</label>
                                <input class="form-control" name="ghichu" value="{{ $cm->ghichu }}{{ old('ghichu')}}" placeholder="Nhập ghi chú"/>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <input type="submit" value="Lưu" class="btn btn-primary" >
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
                <h4 class="modal-title" id="myModalLabel"><strong>Thêm Chuyên mục</strong></h4>
              </div>
              {!! Form::open(['method'=>'POST','url'=>'qtht/chuyen-muc']) !!}
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <div class="modal-body">
                  <div class="form-group">
                    <label>Chuyên mục</label>
                    <input type="text" class="form-control" name="ten" value="{{ old('ten')}}" placeholder="Nhập Tên Loại tin" required="">
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
                  <input type="submit" value="Thêm" class="btn btn-primary" >
                </div>
                {!! Form::close() !!}
            </div>
          </div>
        </div>
</div>
@endsection
