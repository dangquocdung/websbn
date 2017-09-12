<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Storage;

use Validator;
use App\HinhSlide;

class HinhSlideController extends Controller
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
      $slider = HinhSlide::where('tieude','like','%'.$search.'%')->orderBy('created_at')->get();

      return view('qtht.hinhslide',['slider'=>$slider]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //
      if (Auth::user()->is_tbbt() || Auth::user()->is_admin() ){

        return view('qtht.themhinhslide');

      }else{
        return redirect ('/')->withErrors('Bạn không có quyền đăng bài!');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {


    //   $slide = new HinhSlide;
    //   $slide->user_id = Auth::user()->id;
    //   $slide->tieude = $request->get('tieude');

    //   if ($request->file('hinh')){
    //     $file = $request->file('hinh');
    //     $tenhinh = Storage::put('public/img/hinh-slide', $file);
    //   }else{
    //     $tenhinh = $slide->urlhinh;
    //   }


    //   //
    //   $slide->hinh = $tenhinh;
    //   $slide->thutu = $request->get('thutu');
    //   $slide->ghichu = $request->get('ghichu');

    //   $slide->save();

    //   return redirect('qtht/hinh-slide/home');
    // }

    public function store(){
      $file = Input::file('hinh');
      // making counting of uploaded images

      if ($file){
        $rules = array('file' => 'required|mimes:jpg,jpeg,bmp,png');

        $validator = Validator::make(array('file'=>$file), $rules);

        if ($validator->passes()){
          $destinationPath = './img/hinh-slide/'; //upload folder in public Directory
          $filename = $file->getClientOriginalName();
          $upload_success = $file->move($destinationPath, $filename);

          //save into Database

          $slide = new HinhSlide;
          $slide->user_id = Auth::user()->id;
          $slide->tieude = Input::get('tieude');
          $slide->hinh = $filename;
          $slide->thutu = Input::get('thutu');
          $slide->ghichu = Input::get('ghichu');

          $slide->save();
        }
      }

      return redirect('qtht/hinh-slide');
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
      $slide = HinhSlide::find($id);
      if ($slide && ( Auth::user()->is_tbbt() || Auth::user()->is_admin())){

        return view ('qtht.suahinhslide')->with('slide',$slide);
      }else{
        return redirect ('qtht/hinh-slide')->withErrors('Bạn không có quyền sửa tin bài này!');
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
      $slide_id = $request->get('id');

      $slide = HinhSlide::find($slide_id);

      if ($slide && (Auth::user()->is_tbbt() || Auth::user()->is_admin())){
        $slide->tieude = $request->get('tieude');

        $file = Input::file('hinh');

        if ($file){
          $rules = array('file' => 'required|mimes:jpg,jpeg,bmp,png');

          $validator = Validator::make(array('file'=>$file), $rules);

          if ($validator->passes()){
            $destinationPath = './img/hinh-slide/'; //upload folder in public Directory
            $filename = $file->getClientOriginalName();
            $upload_success = $file->move($destinationPath, $filename);
            $slide->hinh = $filename;
          }
        }




        $slide->thutu = $request->get('thutu');
        $slide->ghichu = $request->get('ghichu');

        $slide->save();

        return redirect('qtht/hinh-slide');

      }else{
        return redirect ('qtht/hinh-slide')->withErrors('Bạn không có quyền sửa tin bài này!');
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
      $slide = HinhSlide::find($id);

      if ($slide && (Auth::user()->is_tbbt() || Auth::user()->is_admin())){
        $slide->delete();
        $data['message'] = 'Xoá hình slide thành công!';
      }else{
        $data['errors'] = 'Bạn không có quyền xoá tin này!';
      }

      return redirect('qtht/hinh-slide')->with($data);
    }
}
