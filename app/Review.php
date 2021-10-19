<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TransactionDetail;

class Review extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'products_id',
        'transaction_details_id',
        'transaction_id',
        'stars',
        'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'products_id',  'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
