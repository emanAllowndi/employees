<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class administration extends Model {

	use SoftDeletes;
	protected $dates = ['deleted_at'];

protected $table    = 'administrations';
protected $fillable = [
		'id',
		'admin_id',
		              'publicAdmin_id',
'administration',
'publicAdmin_id',

		'created_at',
		'updated_at',
		'deleted_at',
	];

   public function publicAdmin(){
      return $this->belongsTo(\App\Model\publicAdmin::class)
          ->withDefault([
              'publicAdmin' => 'لا يوجد ادارة عامة',
          ]);
   }
    public function emps(){
        return $this->hasMany(\App\Model\emp::class);
    }

}
