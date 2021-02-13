<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class coursenum extends Model {
	use SoftDeletes;
	protected $dates = ['deleted_at'];

protected $table    = 'coursenums';
protected $fillable = [
		'id',
		'admin_id',
		              'emp_id',
'coursenum',
'numdate',
'numyear',
'nummonth',
'emp_id',

		'created_at',
		'updated_at',
		'deleted_at',
	];

   public function emp_id(){
      return $this->belongsTo(\App\Model\emp::class,'id','emp_id');
   }

}
