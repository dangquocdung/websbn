<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Input;
use Validator;
use Response;
use Redirect;
use Session;
use File;
use App\Uploads;

class UploadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');


    }

    public function index(){

      $images = Uploads::orderBy('created_at','desc')->get();

      return view('qtht.imageupload',compact('images'));
    }

    public function multiple_uploads(){
      // getting all of the post data
      $files = Input::file('images');
      // making counting of uploaded images
      $file_count = count($files);
      //start count how many uploaded
      $uploadcount = 0;

      if ($files){
        foreach ($files as $file) {
          $rules = array('file' => 'required|mimes:jpg,jpeg,bmp,png');
          
          $validator = Validator::make(array('file'=>$file), $rules);

          if ($validator->passes()){
            $destinationPath = 'uploads'; //upload folder in public Directory
            $filename = $file->getClientOriginalName();
            $upload_success = $file->move($destinationPath, $filename);
            $uploadcount++;

            //save into Database
            $extension = $file->getClientOriginalExtension();
            $entry = new Uploads;
            $entry->mime = $file->getClientMimeType();
            $entry->original_filename = $filename;
            $entry->filename = $file->getFileName().'.'.$extension;
            $entry->save();
          }
        }
      }

      if ($uploadcount == 0){
        Session::flash('success','Bạn chưa chọn hình ảnh từ máy tính hoặc hình ảnh không hợp lệ!');
        return Redirect::to('/qtht/thu-vien-hinh-anh');
      }elseif ($uploadcount == $file_count){
        Session::flash('success','Tải hình ảnh thành công!');
        return Redirect::to('/qtht/thu-vien-hinh-anh');
      }else{
        // return Redirect::to('/qtht/thu-vien-hinh-anh')->withInput()->withErrors($validator);

        return redirect()->back()->withInput()->withErrors($validator);
      }
    }

    public function destroy($id)
    {
      $hinhanh = Uploads::find($id);

      if ($hinhanh && (Auth::user()->is_tbbt() || Auth::user()->is_admin())){

        File::delete('./uploads/'.$hinhanh->original_filename);

        $hinhanh->delete();

        $data['message'] = 'Xoá hình ảnh thành công!';
      }else{
        $data['error-xoahinh'] = 'Bạn không có quyền hình ảnh này!';
      }

      return redirect()->back()->with($data);
    }
}
