<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    protected $table = 'book_issues';
    protected $fillable = ['member_id','cat_id','book_id','issue_date','remark','delete_at','c_by','u_by','rent_expire','issue_status','return_date'];

    public function member()
    {
        return $this->hasOne('App\User','id','member_id');
    }

    public function category()
    {
        return $this->hasOne('App\Category','id','cat_id');
    }

    public function book()
    {
        return $this->hasOne('App\PhysicalBook','id','book_id');
    }

    public static function list($param)
    {
        $data = new BookIssue();
        $data = $data->leftjoin('users','users.id','=','book_issues.member_id')
                    ->leftjoin('categories','categories.id','=','book_issues.cat_id')
                    ->leftjoin('physical_books','physical_books.id','=','book_issues.book_id')
                    ->select('book_issues.*','users.name AS member_name','categories.name AS cat_name','physical_books.name AS book_name','physical_books.code_no','book_issues.issue_date','physical_books.read_day');

        if (count($param) > 0 ) {
            if ($param['keyword'] != null) {
                $data = $data->where('users.name','like','%'.$param['keyword'].'%');
            }
        }
        
        return $data;
    }

    public static function store_data($param,$return_date)
    {
        
        $rent_qty = PhysicalBook::find($param['book_id'])->rent_count;
        $qty_update = PhysicalBook::find($param['book_id'])->update([
            'rent_count'=>$rent_qty + 1,
        ]);
        $data = BookIssue::create([
            'member_id'=>$param['member_id'],
            'cat_id'=>$param['cat_id'],
            'book_id'=>$param['book_id'],
            'issue_date'=>date('Y-m-d',strtotime($param['issue_date'])),
            'remark'=>$param['notes'],
            'issue_status'=>$param['issue_status'],
            'rent_expire'=>date('Y-m-d',strtotime($param['rent_expire'])),
            'return_date'=>$return_date != null ? date('Y-m-d',strtotime($return_date)) : null,
            
        ]);

        return $data;
    }

    public static function update_data($param,$id,$return_date)
    {
        // dd($param);
        $exp_date = BookIssue::find($id)->rent_expire;
        if ($exp_date == null) {
            $rent_qty = PhysicalBook::find($param['book_id'])->rent_count;
            $qty_update = PhysicalBook::find($param['book_id'])->update([
                'rent_count'=>$rent_qty + 1,
            ]);
        }
         

        $data = BookIssue::find($id)->update([
            'member_id'=>$param['member_id'],
            'cat_id'=>$param['cat_id'],
            'book_id'=>$param['book_id'],
            'issue_date'=>date('Y-m-d',strtotime($param['issue_date'])),
            'remark'=>$param['notes'],
            'issue_status'=>$param['issue_status'],
            'rent_expire'=>date('Y-m-d',strtotime($param['rent_expire'])),
            'return_date'=>$return_date != null ? date('Y-m-d',strtotime($return_date)) : null
        ]);
        return $data;
    }

    public static function show_data($id)
    {
        $data = new BookIssue();
        $data = $data->leftjoin('users','users.id','=','book_issues.member_id')
                    ->leftjoin('categories','categories.id','=','book_issues.cat_id')
                    ->leftjoin('physical_books','physical_books.id','=','book_issues.book_id')
                    ->leftjoin('authors','authors.id','=','physical_books.author_id')
                    ->leftjoin('racks','racks.id','=','physical_books.rack_id')
                    ->select('book_issues.*','users.name AS member_name','categories.name AS cat_name','physical_books.name AS book_name','users.ph_no','users.email','physical_books.code_no','authors.name AS author_name','racks.name AS rack_name','users.id AS member_id','categories.id AS cat_id','physical_books.id AS book_id','book_issues.issue_status','book_issues.return_date','physical_books.read_day')->find($id);
        // dd($data);
        return $data;
    }

}
