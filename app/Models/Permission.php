<?php

namespace App\Models;

use App\Models\User;
use App\Models\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
