<?php

namespace App\Http\Controllers;

use App\DatCauHoi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatCauHoiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function front_index()
    {
      $hoidap = DatCauHoi::where('active','1')->orderby('created_at','desc')->paginate(6);
      $loai = 'hoidap';

      return view('front.hoidap',compact('hoidap','loai'));

    }


    public function index()
    {
      $hoidap = DatCauHoi::orderby('created_at','desc')->paginate(12);
      $loai = 'hoidap';

      return view('qtht.hoidap',compact('hoidap','loai'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('front.datcauhoi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $dch = new DatCauHoi;

      $tieude = $request->get('tieude');
      $slug = str_slug($tieude);
      $trungten = DatCauHoi::where('slug',$slug)->first();

      if ($trungten){
        return redirect('/dat-cau-hoi')->withErrors('Tiêu đề đã tồn tại');
      }
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
     * @param  \App\DatCauHoi  $datCauHoi
     * @return \Illuminate\Http\Response
     */
    public function show(DatCauHoi $datCauHoi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DatCauHoi  $datCauHoi
     * @return \Illuminate\Http\Response
     */
    public function edit(DatCauHoi $datCauHoi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DatCauHoi  $datCauHoi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $dch = DatCauHoi::find($request->get('id_cauhoi'));
        $dch->user_id = Auth::user()->id;
        $dch->active = 1;
        $dch->traloi = $request->get("noidungtraloi");
        $dch->save();
        return redirect()->to('/qtht/hoi-dap');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DatCauHoi  $datCauHoi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dch = DatCauHoi::find($id);

        if ( $dch ){
          $dch->delete();
          $data['message'] = 'Xoá thành công!';
        }else{
          $data['errors'] = 'Bạn không có quyền xoá!';
        }

        return redirect('qtht/hoi-dap')->with($data);

    }
}
