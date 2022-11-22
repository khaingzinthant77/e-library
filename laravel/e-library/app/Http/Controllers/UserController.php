<?php

namespace App\Http\Controllers;

use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Arr;
use DB;
class UserController extends Controller
{
   public function index(Request $request)
   {
   		$members = new User();

   		if ($request->keyword != null) {
   			$members = $members->where('name','like','%'.$request->keyword.'%');
   		}

   		$count = $members->get()->count();

        $members = $members->orderBy('created_at','desc')->paginate(10);
        
        return view('backend.user.index',compact('members','count'))->with('i', (request()->input('page', 1) - 1) * 10);
   }

   public function create(Request $request)
   {
      $roles = Role::pluck('name','name')->all();

   	return view('backend.user.add',compact('roles'));
   }

   public function store(Request $request)
   {
      // dd($request->input('roles'));
   		$members = User::create([
   			'name'=>$request->name,
   			'ph_no'=>$request->phone,
   			'email'=>$request->email,
   			'status'=>$request->status,
   			'password'=>Hash::make($request->password)
   		]);
         $members->assignRole($request->input('roles'));

   		return redirect()->route('member.index')->with('success','Success');
   }

   public function edit($id)
   {
   		$member = User::find($id);
         $roles = Role::pluck('name','name')->all();
         $userRole = $member->roles->pluck('name')->first();
         // dd($userRole)
   		return view('backend.user.edit',compact('member','roles','userRole'));
   }

   
   public function update($id,Request $request)
   {
      // dd($request->all());
   		$this->validate($request, [
            'name' => 'required',
            'phone'=>'required',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
         // dd("Here");
         $input['password'] = Hash::make($input['password']);
         $user = User::find($id)->update([
            'name'=>$request->name,
            'ph_no'=>$request->phone,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
         ]);

        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');

   }

   
   public function destroy($id)
   {
   		$member = User::find($id)->delete();
   		return redirect()->route('member.index')->with('success','Success');
   }


}