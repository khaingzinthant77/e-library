<?php

namespace App\Http\Controllers;

use App\Member;
use App\User;
use App\BookIssue;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $members = new User();
        // dd($members->get()[0]->getRoleNames());
        if ($request->keyword != null) {
            $members = $members->where('name','like','%'.$request->keyword.'%');
        }

        $members = $members->whereHas('roles', function ($q) {
              $q->where('roles.name', '=', 'Member'); // or whatever constraint you need here
            });

        $count = $members->get()->count();

        $members = $members->orderBy('created_at','desc')->paginate(10);
        
        return view('backend.member.index',compact('members','count'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $member = User::find($id);
        // dd($member);
        $rent_books = new BookIssue();
        $rent_books = $rent_books->leftjoin('categories','categories.id','=','book_issues.cat_id')
                                ->leftjoin('physical_books','physical_books.id','=','book_issues.book_id')->leftjoin('authors','authors.id','=','physical_books.author_id')
                                ->select('physical_books.name','physical_books.path','physical_books.cover_photo','categories.name AS cat_name','book_issues.issue_date','book_issues.remark','book_issues.rent_expire','physical_books.code_no','authors.name AS author_name')->where('book_issues.member_id',$id);
        $count = $rent_books->get()->count();
        
        $rent_books = $rent_books->orderBy('book_issues.created_at','desc')->paginate(10);

        return view('backend.member.view',compact('member','count','rent_books'))->with('i', (request()->input('page', 1) - 1) * 10);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }
}
