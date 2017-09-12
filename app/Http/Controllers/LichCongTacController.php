<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


use App\LichCongTac;


class LichCongTacController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $search = $request->get('search');
      $lichcongtac = LichCongTac::where('tieude','like','%'.$search.'%')->orderBy('created_at')->get();

      return view('qtht.lichcongtac',['lichcongtac'=>$lichcongtac]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //

      return view('qtht.themlichcongtac');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {

          
         $lct =  new LichCongTac;

         $lct->user_id = Auth::user()->id;

         $lct->ngay = $request->get('ngay');
         $lct->gio = $request->get('gio');
         $lct->tieude = $request->get('tieude');
         $lct->slug = str_slug($request->get('tieude'));
         $lct->thanhphan = $request->get('thanhphan');
         $lct->diadiem = $request->get('diadiem');

         $lct->save();

         return redirect('qtht/lich-cong-tac/home');

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
    public function edit($id)
    {
      $lct = LichCongTac::find($id);
      if ( $lct && ( $lct->user_id == Auth::user()->id || Auth::user()->is_tbbt() || Auth::user()->is_admin() ) ){
        return view ('qtht.sualichcongtac')->with('lct',$lct);
      }else{
        return redirect ('qtht/lich-cong-tac/home')->withErrors('Bạn không có quyền sửa mục này!');
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
      $lct_id = $request->get('id');

      $lct = LichCongTac::find($lct_id);

      if ( $lct && ( $lct->user_id == Auth::user()->id || Auth::user()->is_tbbt() || Auth::user()->is_admin() ) ){
        $lct->user_id = Auth::user()->id;

        $lct->ngay = $request->get('ngay');
        $lct->gio = $request->get('gio');
        $lct->tieude = $request->get('tieude');
        $lct->slug = str_slug($request->get('tieude'));
        $lct->thanhphan = $request->get('thanhphan');
        $lct->diadiem = $request->get('diadiem');

        $lct->update();

      }

      return redirect('qtht/lich-cong-tac/home');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $lct = LichCongTac::find($id);

      if ( $lct && ( $lct->user_id == Auth::user()->id || Auth::user()->is_tbbt() || Auth::user()->is_admin() ) ){
        $lct->delete();
        $data['message'] = 'Xoá tin thành công!';
      }else{
        $data['errors'] = 'Bạn không có quyền xoá tin này!';
      }

      return redirect('qtht/lich-cong-tac/home')->with($data);
    }

}
