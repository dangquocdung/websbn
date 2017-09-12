<?php

namespace App\Http\Controllers;

use App\GopY;
use Illuminate\Http\Request;

class GopYController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function front_index()
    {
      $hoidap = GopY::where('active','1')->orderby('created_at','desc')->paginate(6);
      $loai = 'gopy';

      return view('front.hoidap',compact('hoidap','loai'));

    }

    public function index()
    {
      $hoidap = GopY::orderby('created_at','desc')->paginate(12);
      $loai = 'gopy';

      return view('qtht.hoidap',compact('hoidap','loai'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('front.thugopy');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $dch = new GopY;

      $tieude = $request->get('tieude');
      $slug = str_slug($tieude);

      $dch->hoten = $request->get('hoten');
      $dch->diachi = $request->get('diachi');
      $dch->dienthoai = $request->get('dienthoai');
      $dch->email = $request->get('email');
      $dch->tieude = $tieude;
      $dch->slug = $slug;
      $dch->noidung = $request->get('noidung');

      $dch->save();

      return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GopY  $gopY
     * @return \Illuminate\Http\Response
     */
    public function show(GopY $gopY)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GopY  $gopY
     * @return \Illuminate\Http\Response
     */
    public function edit(GopY $gopY)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GopY  $gopY
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $dch = GopY::find($request->get('id_cauhoi'));
      $dch->active = 1;
      $dch->save();
      return redirect()->to('/qtht/gop-y');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GopY  $gopY
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $dch = GopY::find($id);

      if ( $dch ){
        $dch->delete();
        $data['message'] = 'Xoá thành công!';
      }else{
        $data['errors'] = 'Bạn không có quyền xoá!';
      }

      return redirect('qtht/gop-y')->with($data);

    }
}
