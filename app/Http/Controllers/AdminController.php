<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\MenuTop;
use App\LoaiTin;
use App\TinTuc;
use App\BannerTop;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $menutop = MenuTop::orderby('id','asc')->get();
        view()->share('menutop',$menutop);

        $loaitin = LoaiTin::orderby('id','asc')->get();
        view()->share('loaitin',$loaitin);

        $tintuc = TinTuc::orderby('id','desc')->get();
        view()->share('tintuc',$tintuc);

        $bannertop = BannerTop::orderby('id','desc')->get();
        view()->share('bannertop',$bannertop);


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAdminHome()
    {
        return view('qtht.home');
    }

    public function getThemTinBai($idlt)
    {
        $themtin = LoaiTin::find($idlt);
        return view('qtht.themtinbai',['themtin'=>$themtin]);
    }

    public function postThemTinBai(Request $request)
    {
        $tintuc = new TinTuc;
        $tintuc->user_id = Auth::user()->id;
        $tintuc->loaitin_id = $request->loaitin_id;
        $tintuc->tieude = $request->tieude;
        $tintuc->tieudekhongdau = changeTitle($request->tieude);
        $tintuc->tomtat = $request->tomtat;
        $tintuc->noidung = $request->noidung;
        $tintuc->ghichu = $request->ghichu;
        $tintuc->tinnoibat = $request->tinnoibat;

        if ($request->file('urlhinh')){

          $tenhinh = str_random(30);

          $request->file('urlhinh')->move("storage/tin-tuc/img/",$tenhinh);

        }else{

          $tenhinh = $tintuc->urlhinh;

        }

        $tintuc->urlhinh = $tenhinh;


        $tintuc->save();

        return redirect( '/qtht/home' );
    }

    public function deleteTinBai($id)
    {
        $tintuc = TinTuc::find($id);
        $tintuc->delete();

        return redirect( route('danh-sach-tin-tuc') );
    }

    public function getSuaTinBai($id)
    {
        $suatin = TinTuc::find($id);

        return view('qtht.suatinbai',['suatin'=>$suatin]);
    }

    public function putTinBai(Request $request, $id)
    {
        $tintuc = TinTuc::find($id);

        $tintuc->loaitin_id = $request->loaitin_id;
        $tintuc->tieude = $request->tieude;
        $tintuc->tieudekhongdau = changeTitle($request->tieude);
        $tintuc->tomtat = $request->tomtat;
        $tintuc->noidung = $request->noidung;
        $tintuc->ghichu = $request->ghichu;
        $tintuc->tinnoibat = $request->tinnoibat;


        if ($request->hasfile('urlhinh')){

          $file = $request->file('urlhinh');

          $name = $file->getClientOriginalName();

          $urlhinh = str_random(4)."_".$name;

          while (file_exists("upload/hinh/tintuc/".$urlhinh)){
            $urlhinh = str_random(4)."_name";
          }

          $file->move("upload/hinh/tintuc",$urlhinh);

          $tintuc->urlhinh = $urlhinh;

        }

        $tintuc->save();

        return redirect('/qtht/home');


    }

    public function getDanhSachTinTheoLoai($idlt)
    {
        $tenloai = LoaiTin::find($idlt);
        $tintheoloai = TinTuc::where('loaitin_id',$idlt)->orderby('id','desc')->get();
        return view('qtht.danhsachtinbai',['tintheoloai'=>$tintheoloai, 'tenloai'=>$tenloai]);
    }

    public function postThemMenu(Request $request)
    {
        $menutop = new MenuTop;

        $menutop->ten = $request->tenMenu;
        $menutop->tenkhongdau = changeTitle($request->tenMenu);

        $menutop->save();

        return redirect('/qtht/danh-sach-menu');
    }

    public function deleteMenuTop($id)
    {
        $menutop = MenuTop::find($id);
        $menutop->delete();

        return redirect('/qtht/danh-sach-menu');
    }

    public function postThemLoaiTin(Request $request)
    {
        $loaitin = new LoaiTin;

        $loaitin->ten = $request->tenLoaiTin;
        $loaitin->tenkhongdau = changeTitle($request->tenLoaiTin);
        $loaitin->menutop_id = $request->menutop_id;

        $loaitin->save();

        return redirect('/qtht/home');
    }

    public function getLoaiTinTheoMenuTop($idmt)
    {
        $lttmtop = LoaiTin::where('menutop_id',$idmt)->orderby('id','desc')->get();
        return view('qtht.danhsachloaitin',['lttmtop'=>$lttmtop]);
    }

    public function getMenuTop()
    {
        return view('qtht.danhsachmenutop');
    }

    public function getBannerTop()
    {
        return view('qtht.danhsachbannertop');
    }


    public function postThemBannerTop(Request $request)
    {
        $banner = new BannerTop;

        $banner->ten = $request->tenBanner;
        $banner->tenkhongdau = changeTitle($request->tenBanner);
        $banner->urlbanner = $request->urlbanner;

        if ($request->hasfile('urlhinh')){

          $file = $request->file('urlhinh');

          $name = $file->getClientOriginalName();

          $urlhinh = str_random(4)."_".$name;

          while (file_exists("./img/bannertop/".$urlhinh)){
            $urlhinh = str_random(4)."_name";
          }

          $file->move("./img/bannertop",$urlhinh);

          $banner->urlhinh = $urlhinh;

        }

        $banner->save();

        return redirect('/qtht/home');
    }


    public function deleteBannerTop($id)
    {
        $banner = BannerTop::find($id);
        $banner->delete();

        return redirect('/qtht/home');
    }


}
