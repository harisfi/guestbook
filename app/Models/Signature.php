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
}
