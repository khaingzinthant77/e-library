<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\news;
use App\FileUpload;
use App\Models\BillingContact;
use App\Models\Setting;
use Validator;
use Log;
use DB;
class PostApiController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $a = $request->all();
        $news = new news();

        if(isset($request->post_type)){
            $news = $news->where('post_category',$request->post_type);
        }

        $news = $news->where('status',1)->orderBy('id','desc')->limit(10)->paginate(10);

        return $this->sendResponse($news->toArray(), 'News retrieved successfully.');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $news = new news();
        // $feature_photo="";
        // $detail_photo="";
        // if($request->file('feature_photo')!=NULL){
        //     $target_dir=  public_path() . '/uploads/posts/';
        //     $feature_photo = basename($_FILES['feature_photo']["name"]);

        //     $target_file = $target_dir. basename($_FILES['feature_photo']["name"]);

        //     move_uploaded_file($_FILES['feature_photo']["tmp_name"], $target_file);

        // }

        // if($request->file('detail_photo')!=NULL){
        //     $target_dir=  public_path() . '/uploads/posts/';
        //     $detail_photo = basename($_FILES['detail_photo']["name"]);

        //     $target_file = $target_dir. basename($_FILES['detail_photo']["name"]);

        //     move_uploaded_file($_FILES['detail_photo']["tmp_name"], $target_file);

        // }

        // $today = date("Y-m-d");

        // $arr=[
        //         'post_category' => $request->post_type,
        //         'title' => $request->title,
        //         'feature_photo' => $feature_photo,
        //         'detail_description' => ($request->detail_description)? $request->detail_description : '',
        //         'detail_photo' =>$detail_photo,
        //         'publish_date' => ($request->publish_date)? $request->publish_date : $today ,
        //         'status' => $request->status,
        //     ];
        //     if (isset($request->post_type)) {
        //         $news = $news::where('post_category',$request->post_type);
            
        //     }
        //     $newscreate = $news->orderBy('publish_date','desc')->create($arr);
        //     return $this->sendResponse($newscreate->toArray(), 'News created successfully.');
        
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $Post =news::find($id);

        // if (is_null($Post)) {
        //     return $this->sendError('Post not found.');
        // }


        // return $this->sendResponse($Post->toArray(), 'Post retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // $post = news::findorfail($id);
        // $feature_photo=$post->feature_photo;
        
        // if($request->file('feature_photo')!=NULL){
        //     $target_dir=  public_path() . '/uploads/posts/';
        //     $feature_photo = basename($_FILES['feature_photo']["name"]);

        //     $target_file = $target_dir. basename($_FILES['feature_photo']["name"]);

        //     move_uploaded_file($_FILES['feature_photo']["tmp_name"], $target_file);

        // }
        // $post->post_category = $request->post_type;
        // $post->title = $request->title;
        // $post->detail_description = $request->detail_description;
        // $post->feature_photo = $feature_photo;
        // $post->save();
        // return $this->sendResponse($post->toArray(), 'Post updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $post = news::findorfail($id);
        // $post->delete();
        // return $this->sendResponse($post->toArray(), 'Post deleted successfully.');
    }

    public function getNoti()
    {
        $noti = DB::table('news')->where('status',1)->latest()->first();

        if ($noti != null) {
            $noti = [
                'title' =>$noti->title,
                'detail_description'=>$noti->detail_description,
                'detail_photo'=>$noti->detail_photo
            ];
            
        }
        return response(['data' => $noti, 'message'=>"Success",'status'=>1]);
    }

    public function billing_contact()
    {
        $billing_contact = BillingContact::first();
        return response(['data' => $billing_contact, 'message'=>"Success",'status'=>1]);
    }

    public function setting_url()
    {
        $setting = Setting::where('status',1)->first();
        return response(['data' => $setting, 'message'=>"Success",'status'=>1]);
    }

}
