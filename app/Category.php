<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    protected static function boot() {
		parent::boot();
		static::addGlobalScope('contributors', function ($builder) {
			$builder->with('contributors');
		});
    }
    
    public function contributors() {
        return $this->belongsToMany('App\User','contributors','category_id','user_id')->withPivot('contribution');
    }
}
