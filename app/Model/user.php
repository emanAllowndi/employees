<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Activitylog\Contracts\Activity;

use Illuminate\Support\Facades\Cache;
use Laratrust\Traits\LaratrustUserTrait;
use Nagy\LaravelRating\Traits\Rate\CanRate;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;
use App\Model\emp;




// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class user extends Authenticatable  implements Auditable  {
	use LaratrustUserTrait;
    use \OwenIt\Auditing\Auditable;


    use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;
	use SoftDeletes;
	use Notifiable;
	use CanRate;
    //public function isOnline(){ return Cache::has('user-is-online'.$this->id); }


protected $table    = 'users';
protected $fillable = [
		'id',

    'emp_id',
    'updating_reason',


    'admin_id',
		'remember_token',

		      'first_name',
'middel_name',
'last_name',
'email',
'password',
    'photo_profile',

		'created_at',
		'updated_at',
		'deleted_at',
	];


    protected $hidden = [
        'password', 'remember_token',
    ];
	protected $dates = ['deleted_at'];

    public function emps(){
        return $this->hasMany(\App\Model\emp::class);
    }




}
