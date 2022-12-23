<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingContact extends Model
{
    use HasFactory;

    protected $table = 'billing_contacts';
    protected $fillable = ['contact_text'];

    public static function list($param)
    {
        $data = new BillingContact();
        return $data;
    }
}
