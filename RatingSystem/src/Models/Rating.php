<?php
namespace RatingSystem\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Rating extends Model
{
    protected $fillable = ['rating', 'review', 'user_id'];

    public function rateable()
    {
        return $this->morphTo();
    }
	
	public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}