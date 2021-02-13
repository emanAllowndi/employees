<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Model\App\task;
// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class rating extends Model {

	use SoftDeletes;
	protected $dates = ['deleted_at'];

protected $table    = 'ratings';
protected $fillable = [
		'id',
	    'task_id',
        'Admin_id',
		'rating',

		'created_at',
		'updated_at',
		'deleted_at',
	];

   public function task(){
      return $this->belongsTo(\App\Model\task::class,'id','task_id');
   }

   public function Admin_id(){
      return $this->hasOne(\App\Admin::class,'id','Admin_id');
   }

}
