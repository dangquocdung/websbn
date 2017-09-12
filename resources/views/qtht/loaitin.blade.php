@extends('front.layouts.home')

@section('title')
  <title>Quản trị Loại tin | {{ config('app.name', 'Dang Quoc Dung') }}</title>
@endsection

@section('menu-ngang')

  @include('qtht.layouts.menu-ngang')

@endsection

@section('content')

<div class="col-md-12">


  <div class="panel panel-default">
      <div class="panel-heading  in-hoa-dam">
        <strong>Danh sách Loại tin</strong>
      </div>

      <div class="panel-body">
        <div style="padding-bottom:10px">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addVideo">Thêm Loại Tin</button>

          {{-- <a class="btn btn-primary" href="/qtht/menu/them-loai-tin"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm Loại tin</a> --}}
        </div>

        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <tr>
              <th>Chuyên mục</th>
              <th>Loại tin</th>
              <th>URL</th>
              <th>TT Hiển thị</th>
              <th>Số tin</th>
              <th>Ghi chú</th>
              <th>Thao tác</th>
            </tr>
            @foreach ($chuyenmuc as $cm)

              @foreach ($cm->loaitin as $lt)
              <tr>
                <td style="text-align:left;">{{ $lt->menutop->ten }}</td>
                <td style="text-align:left;">{{ $lt->ten }}</td>
                <td style="text-align:left;">{{ $lt->slug }}</td>
                <td>{{ $lt->thutu }}</td>
                <td>
                  <?php $i=0; ?>
                  @foreach ($tintuc as $tt)
                    @if ($tt->loaitin_id == $lt->id)
                      <?php $i++ ; ?>
                    @endif
                  @endforeach
                  {{ $i }}
                </td>
                <td style="text-align:left;">{{ $lt->ghichu }}</td>
                <td style="text-align: center;">
                  <form action="#" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <a data-toggle="modal" data-target="#editLoaiTin{{$lt->id}}" class="btn btn-warning btn-xs">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="{{ url('qtht/menu/xoa-loai-tin/'.$lt->id.'?token='.csrf_token()) }}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn chắc chắn muốn xoá loại tin này?')">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </form>
                </td>
                <!-- Modal Sửa -->
                <div class="modal fade" id="editLoaiTin{{$lt->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><strong>Edit Loại Tin</strong></h4>
                      </div>

                      {!! Form::open(['method'=>'POST','url'=>'qtht/menu/sua-loai-tin']) !!}
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input type="hidden" name="id" value="{{ $lt->id }}"/>

                        <div class="modal-body">
                          <div class="form-group">
                            <label>Chuyên mục</label>
                            <select class="form-control" name="menutop_id" required="">
                              @foreach ($chuyenmuc as $cm)
                                @if($lt->menutop_id == $cm->id)
                                  <option value="{{ $cm->id}}" selected="">{{ $cm->ten}}</option>
                                @else
                                  <option value="{{ $cm->id}}">{{ $cm->ten}}</option>
                                @endif
                              @endforeach
                            </select>
                          </div>

                          <div class="form-group">
                            <label>Loại Tin</label>
                            <input type="text" class="form-control" name="ten" value="{{ $lt->ten }}{{ old('ten')}}" placeholder="Nhập Tên Loại tin" required="">

                          </div>

                          <div class="form-group">
                            <label>Thứ tự hiển thị</label>
                            <select class="form-control" name="thutu" required="">
                              @for ($i = 1; $i < 10; $i++)
                                @if ($i== $lt->thutu)
                                  <option value="{{ $i }}" selected="">{{ $i }}</option>
                                @else
                                  <option value="{{ $i }}">{{ $i }}</option>
                                @endif
                              @endfor
                            </select>
                          </div>


                          <div class="form-group">
                            <label>Ghi chú</label>
                            <input class="form-control" name="ghichu" value="{{ $lt->ghichu }}{{ old('ghichu')}}" placeholder="Nhập ghi chú"/>
                          </div>



                        </div>

                        <div class="modal-footer">
                          <input type="submit" value="Cập nhật" class="btn btn-primary" >
                        </div>
                        {!! Form::close() !!}





                    </div>
                  </div>
                </div>

              </tr>

              @endforeach
              <tr>
                <td colspan="7"></td>
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
          <h4 class="modal-title" id="myModalLabel"><strong>Thêm Loại Tin</strong></h4>
        </div>
        {!! Form::open(['method'=>'POST','url'=>'qtht/menu','enctype'=>'multipart/form-data']) !!}
          <input type="hidden" name="_token" value="{{csrf_token()}}"/>
          <div class="modal-body">
            <div class="form-group">
              <label>Chuyên mục</label>
              <select class="form-control" name="menutop_id" required="">
                @foreach ($chuyenmuc as $cm)
                <option value="{{ $cm->id}}">{{ $cm->ten}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label>Loại Tin</label>
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
