<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class test extends Model {
	use SoftDeletes;
	protected $dates = ['deleted_at'];

protected $table    = 'tests';
protected $fillable = [
		'id',
		'admin_id',
		              'department_id',
'test_name',
'department_id',

		'created_at',
		'updated_at',
		'deleted_at',
	];

   public function department_id(){
      return $this->hasOne(\App\Model\department::class,'id','department_id');
   }

}
