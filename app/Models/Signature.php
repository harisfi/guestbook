<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory;

    /**
     * Field to be mass-assigned.
     * @var array
     */
    protected $fillable = ['name', 'email', 'body', 'flagged_at'];

    /**
     * Ignore flagged signatures.
     * 
     * @param $query
     * @return mixed
     */
    public function scopeIgnoreFlagged($query)
    {
        return $query->where('flagged_at', null);
    }

    public function flag()
    {
        return $this->update(['flagged_at' => \Carbon\Carbon::now()]);
    }

    /**
     * Get the user gravatar by their email address.
     * 
     * @return string
     */
    public function getAvatarAttribute()
    {
        return sprintf('https://www.gravatar.com/avatar/%s?s=100', md5($this->email));
    }
}
