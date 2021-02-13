<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\emp;
use App\Model\holidaytype;



// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class holiday extends Model implements Auditable {

	use SoftDeletes;
	protected $dates = ['deleted_at'];
    use \OwenIt\Auditing\Auditable;

protected $table    = 'holidaies';
protected $fillable = [
		'id',

    'updating_reason',

    'hyear',
    'month',

    'admin_id',
		'emp_id',
		'holidaytype_id',


		      'holiday_type',
'holiday_desc',
'holidays_days',
		'created_at',
		'updated_at',
		'deleted_at',
		'todate',
		'fromdate',
		'hdate',
	];
	protected $casts = [
		'hdate' => 'date'
	];
	public function emp(){
		return $this->belongsTo(\App\Model\emp::class);
	 }
	 public function holidaytype(){
		return $this->belongsTo(\App\Model\holidaytype::class);
	 }
	 public function attendances(){
		return $this->belongsTo(\App\Model\attendance::class);
	 }


}
