<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class misionDaily extends Model
{
    use HasFactory;
    
    protected $fillable = ['template_id', 'tanggal', 'is_completed'];
    protected $table = 'daily_missions';
    protected $casts = [
        'tanggal' => 'date',
        'is_completed' => 'boolean'
    ];

    public function template()
    {
        return $this->belongsTo(templateMision::class, 'template_id');
    }

    public function assignments()
    {
        return $this->hasMany(misionAsignment::class, 'daily_id');
<<<<<<< HEAD
    }
    public function user(){
        return $this->belongsTo(User::class);
=======
>>>>>>> 5d58ca7 (mission tinggal ud)
    }
}
