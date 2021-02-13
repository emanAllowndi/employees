<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

use Illuminate\Database\Eloquent\SoftDeletes;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class officialHoliday extends Model  implements Auditable {

	use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];

protected $table    = 'official_holidaies';
protected $fillable = [
		'id',

    'updating_reason',

    'oyear',
    'month',


    'admin_id',
		              '',
'holiday_name',
'official_holidays_days',
'holiday_month',
'holiday_month_end',
'off_days',


		'created_at',
		'updated_at',
		'deleted_at',
		'odate',
	];
	protected $casts = [
		'odate' => 'date'
	];
	public function attendance(){
		return $this->belongsToMany(\App\Model\attendance::class,'attendance_official','official_id','attendance_id');
	 }

}
