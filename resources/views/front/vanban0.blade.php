@extends('front.layouts.home')
@section('content')

  <div class="list-group">
    <div  class="list-group-item active main-color-bg in-hoa-dam">
      {{-- <a href="/"><i class="fa fa-home" aria-hidden="true"></i> &nbspTrang chủ</a> /  --}}
      <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> &nbsp{{ $loaitinvb->ten}}

      <p class="pull-right visible-xs" >
        <a data-toggle="offcanvas" style="color:red">
          <span class="glyphicon glyphicon-forward site-logo" aria-hidden="true"></span>
        </a>
      </p>
    </div>


    <div class="panel panel-default" style="margin-bottom: 0">
      <div class="panel-heading in-hoa-dam">
          <i class="fa fa-calendar" aria-hidden="true"></i>  {{ $loaitinvb->ten}}
         <p class="pull-right visible-xs" >
           <a data-toggle="offcanvas" style="color:red">
             <span class="glyphicon glyphicon-forward site-logo" aria-hidden="true"></span>
           </a>
         </p>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <tbody>
            <tr>
              <th>Ngày ban hành</th>
              <th>Loại văn bản</th>
              <th>Số</th>
              <th>Trích yếu</th>
              <th>Tệp Văn bản</th>
              <th>Người kí</th>
            </tr>
            @foreach ($vbtheoloai as $vb)
            <tr>
              <td>{{ $vb->ngaybanhanhvb }}</td>
              <td>{{ $vb->loaivb->tenloaivb }}</td>
              <td>{{ $vb->sovb }}</td>
              <td style="text-align:left;">{{ str_limit($vb->trichyeuvb, $limit=120, $end='......') }}</td>
              <td>
                <a href="{{$vb->tepvanban}}" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
              </td>
              <td>{{ $vb->nguoiki }}</td>

            </tr>
            @endforeach
            </tbody>
          </table>
          {{-- pagination --}}
          {!! $vbtheoloai->links() !!}
        </div>
      </div>
    </div>





@endsection
