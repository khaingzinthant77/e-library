<?php

namespace App\Http\Controllers;

use App\Models\news;
use App\Models\Token;
use Illuminate\Http\Request;
// use Jenssegers\Agent\Agent;
use Session;
use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Str;


class NewsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $token = Session::get('access_token');
        if($token === null){
          return redirect('/login');
        }

        $news= news::orderby('updated_at', 'desc')->paginate(10);
        return view('news.index',compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $token = Session::get('access_token');
      if($token === null){
        return redirect('/login');
      }
       return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all())
         $request->validate([ 
            'title' => 'required',
            'feature_photo' => 'required',
            'detail_description' => 'required',
            'publish_date' => 'required'
        ]);


        $structure= "uploads/posts/";
        $feature_photo="";
       if ($file = $request->file('feature_photo')) {
    
            $feature_photo = $request->file('feature_photo');
            $ext = '.'.$request->feature_photo->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->feature_photo->getClientOriginalName());
            $file->move($structure, $fileName);
            $feature_photo = $fileName;
          

        }


        $detail_photo="";
        if ($file = $request->file('detail_photo')) {
    
            $detail_photo = $request->file('detail_photo');
            $ext = '.'.$request->detail_photo->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->detail_photo->getClientOriginalName());
            $file->move($structure, $fileName);
            $detail_photo = $fileName;
          
        }

        $arr=[
                'post_category'=>$request->post_category,
                'title' => $request->title,
                'status' => $request->status,
                'feature_photo' => $feature_photo,
                'detail_description' => ($request->detail_description)? $request->detail_description : '',
                'detail_photo' => $detail_photo,
                'publish_date' => ($request->publish_date)? $request->publish_date : ''
            ];
            // dd($arr);

        $res=news::create($arr);
        $dataJSON = json_encode($res->toArray());
        
        if ($request->post_category == 1) {
            $this->notification($request->title,$request->detail_description,$detail_photo);
            
            $noti_tokens = Token::all();

            $tokens = [];
            foreach ($noti_tokens as $key => $noti_token) {
                array_push($tokens, $noti_tokens[$key]->token);
            }
            
            // dd($tokens);
            $this->IOSNotification($tokens,$request->title,$request->detail_description,$dataJSON);
        }

        return redirect()->route('news.index')->with('message1','Post create successfully');
    }

    public function IOSNotification($token,$title,$body,$jsondata)
    {
        $client = new Client();
        $apiUrl = "https://exp.host/--/api/v2/push/send";

            foreach ($token as $key => $t) {
                    $headers =  [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Accept-encoding'=> 'gzip, deflate',
                        'Content-Type' => 'application/json',
                    ],
                    'body' => json_encode(
                            [
                            "to"=>$t,
                            "sound"=>"default",
                            "title"=> $title,
                            "badge" => 1,
                            "body"=>strip_tags($body),
                            "data"=>$jsondata
                        ]
                        )
                  ];
            }
            
            // dd($headers);
            $res = $client->request('POST',$apiUrl , $headers);
            // dd($res);
            return true;
    }

    public function notification($title,$body,$detail_photo) 
    {
        

        $title = $title;
        $body = $body;

        $imageUrl = 'https://news.mm-link.net/uploads/posts/'.$detail_photo; 
        
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

        $notification = [
            'title' => $title,
            'sound' => true,
            'body' => $body,
            'image' => $imageUrl,
            'click_action'=>'com.linn.solution.fcm_2021.FCM_NOTIFICATION_DETAIL',
        ];

        $data = [
            'title' => $title,
            'body' => $body,
            'image' => $imageUrl,
        ];

        $url = config('app.env');
        if ($url == 'local') {
                $fcmNotification = [
                'to'        => "/topics/uat_news", 
                'notification' => $notification,
                'data' => $data,
            ];
        }else{
                $fcmNotification = [
                'to'        => "/topics/news", 
                'notification' => $notification,
                'data' => $data,
            ];
        }
        

        $headers = [
            'Authorization: key=AAAA4aaK6KQ:APA91bGiDRdofxQaBk_GPXNXyPtv-widpRPRQghe-_uMNpsLfDMaZcM2zKFE3u6n2lOqmWxMkFgU4dhZ9F-v-xlYd4jr45mI5FX3Tf3tltD_BM6JozRpe1scssEmOH1MRlMrky4zU6vY',
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);

        return true;
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = news::findOrFail($id);
        return view('news.show',compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = news::find($id);
        return view('news.edit',compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $news = news::findOrFail($id);

        $request->validate([
            'post_category'=>'required',
            'title' => 'required',
            'detail_description' => 'required',
            'publish_date' => 'required'
        ]);


        $structure= "uploads/posts/";
        $feature_photo=($request->feature_photo != '') ? $request->feature_photo : $news->feature_photo;

        if ($file = $request->file('feature_photo')) {
    
            $feature_photo = $request->file('feature_photo');
            $ext = '.'.$request->feature_photo->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->feature_photo->getClientOriginalName());
            $file->move($structure, $fileName);
            $feature_photo = $fileName;
          

        }

        $detail_photo=($request->detail_photo != '') ? $request->detail_photo : $news->detail_photo;
        if ($file = $request->file('detail_photo')) {
    
            $detail_photo = $request->file('detail_photo');
            $ext = '.'.$request->detail_photo->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->detail_photo->getClientOriginalName());
            $file->move($structure, $fileName);
            $detail_photo = $fileName;
          
        }

        $arr=[
                'id'=>$id,
                'post_category'=>$request->post_category,
                'title' => $request->title,
                'short_description' => $request->short_description,
                'feature_photo' => $feature_photo,
                'detail_description' => $request->detail_description,
                'detail_photo' => $detail_photo,
                'publish_date' => ($request->publish_date)? $request->publish_date : '',
                'status' => $request->status
               
            ];

        // $input = $request->all();
        $news->fill($arr)->save();

         return redirect()->route('news.index')->with('message1','Post Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $token = Session::get('access_token');
        if($token === null){
          return redirect('/login');
        }
         $news = news::find($id)->delete();
        return redirect()->back()->with('success','Post is successfully deleted!');
    }

    public function changestatus(Request $request)
    {
        // dd($request->all());
        $news = news::find($request->file_id);
        $news->status = $request->status;

        $news->save();
        return response()->json(['message1'=>'Status change successfully.']);
    }

    public function contract()
    {
        return view('aggrement.index');
    }

    public function tokenlist()
    {
        $tokens = Token::all();
        return view('token.list',compact('tokens'));

    }

    public function tokendestory($id){
        $tokens = Token::find($id)->delete();
        return redirect()->back()->with('success','Token is successfully deleted!');

    }
}
