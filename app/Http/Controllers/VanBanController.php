<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use Validator;

use App\VanBan;
use App\MenuVB;
use App\LoaiVB;

class VanBanController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');

      $loaivb = LoaiVB::orderby('id','asc')->get();
      view()->share('loaivb',$loaivb);

      $menuvb = MenuVB::orderby('thutu','asc')->get();
      view()->share('menuvb',$menuvb);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
       $search = $request->get('search');
       $vanban = VanBan::where('trichyeuvb','like','%'.$search.'%')->orderBy('created_at','desc')->paginate(10);

       return view('qtht.vanban',['vanban'=>$vanban]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (Auth::user()->can_post() || Auth::user()->is_admin() ){

        return view('qtht.themvanban');

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
      $vb = new VanBan;

        $vb->user_id = Auth::user()->id;
        $vb->menuvb_id = $request->get('menuvb_id');
        $vb->loaivb_id = $request->get('loaivb_id');

        $vb->ngaybanhanhvb = $request->get('ngaybanhanhvb');

        $vb->sovb = $request->get('sovb');
        $vb->trichyeuvb = $request->get('trichyeuvb');
        $vb->slug = str_slug($request->get('trichyeuvb'));

        $vb->nguoiki = $request->get('nguoiki');

        $file = Input::file('tepvanban');
          // making counting of uploaded images

          if ($file){
            $rules = array('file' => 'required|mimes:pdf,doc,xls');
            
            $validator = Validator::make(array('file'=>$file), $rules);

            if ($validator->passes()){
              $destinationPath = './van-ban/tep-van-ban/'; //upload folder in public Directory
              $tentepvb = $file->getClientOriginalName();
              $upload_success = $file->move($destinationPath, $tentepvb);
            }else{
              $tentepvb = $vb->tepvanban;
            }
          }

        // $file = $request->file('tepvanban');
        // $tentepvb = Storage::put('public/tep-van-ban', $file);


        $vb->tepvanban = $tentepvb;

      $vb->save();

      return redirect('qtht/van-ban');
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
      $vanban = VanBan::where('slug',$slug)->first();

      if ( $vanban && ( $vanban->user_id == Auth::user()->id || Auth::user()->is_tbbt() || Auth::user()->is_admin() ) ){
        return view ('qtht.suavanban')->with('vb',$vanban);
      }else{
        return redirect ('qtht/van-ban')->withErrors('Bạn không có quyền sửa tin bài này!');
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
      $vanban_id = $request->get('id');

      $vb = VanBan::find($vanban_id);

      if ($vb && ($vb->user_id == Auth::user()->id || Auth::user()->is_tbbt() || Auth::user()->is_admin() ) ){

        $vb->menuvb_id = $request->get('menuvb_id');
        $vb->loaivb_id = $request->get('loaivb_id');
        $vb->ngaybanhanhvb = $request->get('ngaybanhanhvb');
        $vb->sovb = $request->get('sovb');
        $vb->trichyeuvb = $request->get('trichyeuvb');
        $vb->slug = str_slug($request->get('trichyeuvb'));
        $vb->nguoiki = $request->get('nguoiki');

        if ($request->file('tepvanban')){
          $file = $request->file('tepvanban');
          $tentepvb = Storage::put('public/tep-van-ban', $file);
          $vb->tepvanban = $tentepvb;
        }

        if ($request->get('duyetdang')){
          $vb->active = 1;
        }

        $vb->update();
      }

      return redirect('qtht/van-ban');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $vanban = VanBan::find($id);

      if ($vanban && ($vanban->user_id == Auth::user()->id || Auth::user()->is_tbbt() || Auth::user()->is_admin())){
        $vanban->delete();
        $data['message'] = 'Xoá tin thành công!';
      }else{
        $data['errors'] = 'Bạn không có quyền xoá tin này!';
      }

      return redirect('qtht/van-ban')->with($data);
    }
}
