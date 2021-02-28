<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    // protected $fillable = ['name', 'edulevel_id'];
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function edulevel()
    {
        return $this->belongsTo('App\Edulevel');
    }
}
