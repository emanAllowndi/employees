<?php
namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];


}
