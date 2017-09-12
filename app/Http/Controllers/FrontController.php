<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MenuTop;
use App\MenuVB;
use App\LoaiTin;
use App\TinTuc;
use App\BannerTop;
use App\HinhSlide;
use App\LoaiVB;
use App\VanBan;
use App\LichCongTac;
use App\VideoClip;



class FrontController extends Controller
{

  public function getHome()
  {
      return view('front.trangchu');
  }

  public function lichCongTac()
  {
    $lichcongtac = LichCongTac::orderby('created_at','asc')->paginate(12);
    return view('front.lichcongtac',['lichcongtac'=>$lichcongtac]);
  }

  public function getChuyenMuc($slug)
  {

      $chuyenmuc = MenuTop::where('slug',$slug)->first();

      return view('front.chuyen-muc',compact('chuyenmuc'));
  }

  public function getVideo()
  {
      $videos = VideoClip::orderby('created_at','asc')->get();
      return view('front.video',['videos'=>$videos]);
  }


  public function getLoaiTin($slug)
  {

      $loaitin = LoaiTin::where('slug',$slug)->first();

      $tintheoloai = TinTuc::where('active','1')->where('loaitin_id',$loaitin->id)->orderby('created_at','desc')->paginate(12);

      $loai = 'loaitin';

      return view('front.loaitin',compact('loaitin','tintheoloai','loai'));
  }

  public function postTimKiem(Request $request)
  {

      $loaitin = $request->get("timkiem");

      $tintheoloai = TinTuc::where('active','1')->where('noidung','like','%'.$loaitin.'%')->orderby('created_at','desc')->paginate(12);

      $loai = 'timkiem';

      return view('front.loaitin',compact('loaitin','tintheoloai','loai'));
  }

  public function getChiTietTin($slug)
  {
    $tintuc = TinTuc::where('active','1')->where('tieudekhongdau',$slug)->first();

    $loaitinchitiet = LoaiTin::find($tintuc->loaitin_id);


    return view('front.chitiettin',['tin'=>$tintuc,'loaitinchitiet'=>$loaitinchitiet]);
  }

  public function getVanBan($slug)
  {

      $loaitin = MenuVB::where('slug',$slug)->first();

      $vbtheoloai = VanBan::where('active','1')->where('menuvb_id',$loaitin->id)->orderby('created_at','desc')->paginate(12);

      return view('front.vanban',compact('loaitin','vbtheoloai'));
    }

    public function getLoaiVanBan($slug)
    {

      $loaitin = LoaiVB::where('slug',$slug)->first();

      $vbtheoloai = VanBan::where('active','1')->where('loaivb_id',$loaitin->id)->orderby('created_at','desc')->paginate(12);

      return view('front.vanban',compact('loaitin','vbtheoloai'));
    }

    public function getGopY()
    {
      return view('front.thugopy');
    }

    public function getHoiDap()
    {
      return view('front.hoidap');
    }
}
