@extends('front.layouts.home')

@section('title')
  <title>Lịch công tác</title>
@endsection

@section('content')

  <div class="row">
    <div class="list-group">
      <a  class="list-group-item active main-color-bg in-hoa-dam">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Lịch Công tác
      </a>

      <div class="list-group-item">
        <div class="table-responsive">
          <table class="table table-hover">
            <tbody>
              <tr>
                <th>Ngày</th>
                <th>Thời gian</th>
                <th>Nội dung</th>
                <th>Thành phần</th>
                <th>Địa điểm</th>

              </tr>
              @foreach ($lichcongtac as $lct)
                <tr>
                  <td>{{ Carbon\Carbon::parse($lct->ngay)->format('d-m-Y') }}</td>
                  <td>{{ $lct->gio }}</td>
                  <td>
                    {{ $lct->tieude }}
                  </td>
                  <td>
                    {{ $lct->thanhphan }}
                  </td>
                  <td>
                    {{ $lct->diadiem }}
                  </td>

                </tr>
              @endforeach
            </tbody>
          </table>

          {!! $lichcongtac->links() !!}

        </div>
      </div>


    </div>
  </div>


@endsection
