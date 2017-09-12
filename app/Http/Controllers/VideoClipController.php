<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;
use App\VideoClip;

class VideoClipController extends Controller
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
      $videos = VideoClip::where('tieude','like','%'.$search.'%')->orderBy('created_at')->get();

      return view('qtht.videoclip',['videos'=>$videos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (Auth::user()->is_tbbt() || Auth::user()->is_admin() ){

        return view('qtht.themvideoclip');

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
      $video = new VideoClip;

      $video->user_id = Auth::user()->id;
      $video->tieude = $request->get('tieude');
      $video->videoclip = $request->get('videoclip');
      $video->thutu = $request->get('thutu');
      $video->ghichu = $request->get('ghichu');

      $video->save();

      return redirect('qtht/video-clip');
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
      $video = VideoClip::find($id);

      if ($video && ( Auth::user()->is_tbbt() || Auth::user()->is_admin())){
        return view ('qtht.suavideoclip')->with('video',$video);
      }else{
        return redirect ('qtht/video-clip')->withErrors('Bạn không có quyền sửa tin bài này!');
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
      $video_id = $request->get('id');

      $video = VideoClip::find($video_id);

      if ($video && (Auth::user()->is_tbbt() || Auth::user()->is_admin())){
        $video->tieude = $request->get('tieude');
        $video->videoclip = $request->get('videoclip');
        $video->thutu = $request->get('thutu');
        $video->ghichu = $request->get('ghichu');

        $video->save();

        return redirect('qtht/video-clip');

      }else{
        return redirect ('qtht/video-clip')->withErrors('Bạn không có quyền sửa tin bài này!');
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
      $video = VideoClip::find($id);

      if ($video && (Auth::user()->is_tbbt() || Auth::user()->is_admin())){
        $video->delete();
        $data['message'] = 'Xoá hình slide thành công!';
      }else{
        $data['errors'] = 'Bạn không có quyền xoá tin này!';
      }

      return redirect('qtht/video-clip')->with($data);
    }

}
