<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $guarded = [];

    protected static function boot() {
		parent::boot();
		static::addGlobalScope('payer', function ($builder) {
			$builder->with('payer');
		});
		static::addGlobalScope('category', function ($builder) {
			$builder->with('category');
		});
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function payer() {
        return $this->belongsTo(User::class,'payer_id','id');
    }
    
    public static function calculateRefunds($logs) {
        $users = User::all();
        $refunds = [];
        foreach ($users as $u) {
            $refunds[$u->name] = 0;
        }
        foreach($logs as $log) {
            $contribution = $log->category->contributors->find($log->payer->id)->pivot->contribution;
            $refund = $log->cost * (100 - $contribution) * 0.01;
            $refunds[$log->payer->name] += $refund;
        }

        return $refunds;
    }
}
