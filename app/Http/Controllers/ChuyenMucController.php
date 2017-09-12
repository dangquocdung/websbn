<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


use App\MenuTop;
use App\LoaiTin;
use App\TinTuc;
use App\BannerTop;

class ChuyenMucController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $loaitin = LoaiTin::orderby('id','asc')->get();
        view()->share('loaitin',$loaitin);

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
      $search = $request->get('search');

      $chuyenmuc = MenuTop::where('ten','like','%'.$search.'%')->orderBy('created_at')->get();

      return view('qtht.chuyenmuc',['chuyenmuc'=>$chuyenmuc]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if ( Auth::user()->is_admin() || Auth::user()->is_admin() ){

        return view('qtht.themchuyenmuc');

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
      $chuyenmuc =  new MenuTop;

      $chuyenmuc->ten = $request->get('ten');
      $chuyenmuc->slug = str_slug($request->get('ten'));
      $chuyenmuc->thutu = $request->get('thutu');
      $chuyenmuc->ghichu = $request->get('ghichu');

      $chuyenmuc->save();

      return redirect('qtht/chuyen-muc');
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
      $chuyenmuc = MenuTop::where('slug',$slug)->first();

      if ($chuyenmuc && Auth::user()->is_admin()){

        return view ('qtht.suachuyenmuc',['chuyenmuc'=>$chuyenmuc]);

      }else{

        return redirect ('qtht/chuyen-muc')->withErrors('Bạn không có quyền sửa tin bài này!');

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

      $chuyenmuc = MenuTop::find($id);

      if ($chuyenmuc && Auth::user()->is_admin()){

        $chuyenmuc->ten = $request->get('ten');
        $chuyenmuc->slug = str_slug($request->get('ten'));
        $chuyenmuc->thutu = $request->get('thutu');
        $chuyenmuc->ghichu = $request->get('ghichu');

        $chuyenmuc->update();

        return redirect('qtht/chuyen-muc');

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
      $chuyenmuc = MenuTop::find($id);

      if ($chuyenmuc && ( Auth::user()->is_tbbt() || Auth::user()->is_admin() ) ){
        $chuyenmuc->delete();
        $data['message'] = 'Xoá loại tin thành công!';
      }else{
        $data['errors'] = 'Bạn không có quyền thực hiện thao tác này!';
      }

      return redirect('qtht/chuyen-muc')->with($data);
    }

}
