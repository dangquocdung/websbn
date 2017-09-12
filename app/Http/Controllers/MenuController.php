<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


use App\MenuTop;
use App\LoaiTin;
use App\TinTuc;
use App\BannerTop;

class MenuController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');

      $chuyenmuc = MenuTop::orderby('thutu','asc')->get();
      view()->share('chuyenmuc',$chuyenmuc);

      $tintuc = TinTuc::orderby('id','desc')->get();
      view()->share('tintuc',$tintuc);

  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      // $search = $request->get('search');
      //
      // $loaitin = LoaiTin::where('ten','like','%'.$search.'%')->orderBy('menutop_id','asc')->orderBy('thutu','asc')->get();

      return view('qtht.loaitin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if ( Auth::user()->is_tbbt() || Auth::user()->is_admin() ){

        return view('qtht.themloaitin');

      }else{
        return redirect ('/')->withErrors('Bạn không có quyền thực hiện thao tác!');
      }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loaitin =  new LoaiTin;

        $loaitin->menutop_id = $request->get('menutop_id');
        $loaitin->ten = $request->get('ten');
        $loaitin->slug = str_slug($request->get('ten'));
        $loaitin->thutu = $request->get('thutu');
        $loaitin->ghichu = $request->get('ghichu');

        $loaitin->save();

        return redirect('/qtht/menu');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
      $loaitin = LoaiTin::where('slug',$slug)->first();

      if ($loaitin && ( Auth::user()->is_tbbt() || Auth::user()->is_admin() ) ){

        return view ('qtht.sualoaitin',['loaitin'=>$loaitin]);

      }else{

        return redirect ('/qtht')->withErrors('Bạn không có quyền sửa tin bài này!');

      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $id = $request->get('id');

      $loaitin = LoaiTin::find($id);

      if ($loaitin && ( Auth::user()->is_tbbt() || Auth::user()->is_admin() )){

        $loaitin->menutop_id = $request->get('menutop_id');
        $loaitin->ten = $request->get('ten');
        $loaitin->slug = str_slug($request->get('ten'));
        $loaitin->thutu = $request->get('thutu');
        $loaitin->ghichu = $request->get('ghichu');

        $loaitin->update();

        return redirect('/qtht/menu');

      }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $loaitin = LoaiTin::find($id);

      if ($loaitin && ( Auth::user()->is_tbbt() || Auth::user()->is_admin() ) ){
        $loaitin->delete();
        $data['message'] = 'Xoá loại tin thành công!';
      }else{
        $data['errors'] = 'Bạn không có quyền thực hiện thao tác này!';
      }

      return redirect('/qtht/menu')->with($data);
    }
}
