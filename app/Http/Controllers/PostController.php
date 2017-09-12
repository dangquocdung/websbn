<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use Validator;
use App\MenuTop;
use App\LoaiTin;
use App\TinTuc;
use App\BannerTop;
use App\User;
use Hash;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');

         $chuyenmuc = MenuTop::orderby('id','asc')->get();
         view()->share('chuyenmuc',$chuyenmuc);

     }

    public function index(Request $request)
    {
        //
        $search = $request->get('search');
        $posts = TinTuc::where('tieude','like','%'.$search.'%')->orderBy('created_at','desc')->paginate(10);

        return view('qtht.trangchu',['posts'=>$posts]);
    }

    public function doiMatKhau()
    {
        //
        return view('qtht.doimatkhau');
    }
    public function postDoiMatKhau(Request $request)
    {
        //
        $user = User::find($request->id);

        if(Hash::check($request->password, $user->password)) {

          // $this->validate($request,[
          //   'password_new' => 'required | min:3 | max: 32',
          //   'password_confirmation' => 'required | same:password_new'
          // ],[
          //   'password_new.required' => 'Ban chua nhap mat khau',
          //   'password_new.min' => 'Mat khau phai co it nhat 3 ki tu',
          //   'password_new.max' => 'Mat khau toi da 32 ki tu',
          //   'password_confirmation.required' => 'Ban chua nhap lai mat khau',
          //   'password_confirmation.same' => 'Mat khau nhap lai chua khop'
          // ]);

          $user->password = bcrypt($request->password_new);

          $user->save();

          return redirect('qtht/doi-mat-khau')->with('success',"Bạn đã đổi mật khẩu thành công!");


        }else {

          return redirect('qtht/doi-mat-khau')->with('warning',"Mật khẩu hiện tại chưa chính xác!");

        }





    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::user()->can_post() || Auth::user()->is_admin() ){

          return view('qtht.themtinbai');

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
    public function store(Request $request)
    {
      $tintuc = new TinTuc;
      $tintuc->user_id = Auth::user()->id;
      $tintuc->loaitin_id = $request->get('loaitin_id');

      $tieude = $request->get('tieude');
      $slug = str_slug($tieude);
      $trungten = TinTuc::where('tieudekhongdau',$slug)->first();

      if ($trungten){
        return redirect('/qtht/them-tin-bai')->withErrors('Tiêu đề đã tồn tại');
      }

      $tintuc->tieude = $tieude;
      $tintuc->tieudekhongdau = $slug;
      $tintuc->tomtat = $request->get('tomtat');
      $tintuc->noidung = $request->get('noidung');
      $tintuc->ghichu = $request->get('ghichu');
      if ($request->get('tinnoibat') == 'on'){
        $tintuc->tinnoibat = 1;
      }else{
        $tintuc->tinnoibat = 0;
      }

      $file = Input::file('urlhinh');
      // making counting of uploaded images

      if ($file){
        $rules = array('file' => 'required|mimes:jpg,jpeg,bmp,png');
        
        $validator = Validator::make(array('file'=>$file), $rules);

        if ($validator->passes()){
          $destinationPath = './img/tin-tuc/'; //upload folder in public Directory
          $tenhinh = $file->getClientOriginalName();
          $upload_success = $file->move($destinationPath, $tenhinh);
        }else{
          $tenhinh = $tintuc->urlhinh;
        }
      }



      // if ($request->file('urlhinh')){
      //   $file = $request->file('urlhinh');
      //   $tenhinh = Storage::put('public/img/tin-tuc', $file);
      // }else{
      //   $tenhinh = $tintuc->urlhinh;
      // }

      $tintuc->urlhinh = $tenhinh;
      $tintuc->active = 0;


      $tintuc->save();

      return redirect('qtht/home');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      $tintuc = TinTuc::where('tieudekhongdau',$slug)->first();
      return view('qtht.chitiettin',['tin'=>$tintuc]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
      $tintuc = TinTuc::where('tieudekhongdau',$slug)->first();
      if ( $tintuc && ( $tintuc->user_id == Auth::user()->id || Auth::user()->is_tbbt() || Auth::user()->is_admin() ) ){
        return view ('qtht.suatinbai')->with('tintuc',$tintuc);
      }else{
        return redirect ('qtht/home')->withErrors('Bạn không có quyền sửa tin bài này!');
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
        $tintuc_id = $request->get('tintuc_id');

        $tintuc = TinTuc::find($tintuc_id);

        if ($tintuc && ($tintuc->user_id == Auth::user()->id || Auth::user()->is_tbbt() || Auth::user()->is_admin() ) ){

          $tieude = $request->get('tieude');
          $slug = str_slug($tieude);

          $tintuc->loaitin_id = $request->get('loaitin_id');
          $tintuc->tieude = $tieude;
          $tintuc->tieudekhongdau = $slug;
          $tintuc->tomtat = $request->get('tomtat');
          $tintuc->noidung = $request->get('noidung');

          if ($request->file('urlhinh')){
            $file = $request->file('urlhinh');
            $tenhinh = Storage::put('public/img/tin-tuc', $file);

            $tintuc->urlhinh = $tenhinh;
          }


          if ($request->get('duyetdang')){
            $tintuc->active = 1;
          }

          if ($request->get('tinnoibat') == 'on'){
            $tintuc->tinnoibat = 1;
          }else{
            $tintuc->tinnoibat = 0;
          }

          $tintuc->ghichu = $request->get('ghichu');

          $tintuc->update();
        }

        return redirect('qtht');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $tintuc = TinTuc::find($id);

      if ($tintuc && ($tintuc->user_id == Auth::user()->id || Auth::user()->is_tbbt() || Auth::user()->is_admin())){
        $tintuc->delete();
        $data['message'] = 'Xoá tin thành công!';
      }else{
        $data['errors'] = 'Bạn không có quyền xoá tin này!';
      }

      return redirect('qtht/home')->with($data);
    }
}
