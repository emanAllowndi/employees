<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\emp;
use App\Model\holiday;
use App\Model\audit;




// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class attendance extends Model implements Auditable {

	use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];

protected $table    = 'attendances';
protected $fillable = [
		'id',

    'updating_reason',

		'admin_id',
    'month',

    'emp_id',
    'ayear',
'att_days',
'absent_days',
'note',
'emp_id',

		'created_at',
		'updated_at',
		'deleted_at',
		'adate',

		];
		protected $casts = [
			'adate' => 'date'

		];

   public function emp(){
      return $this->belongsTo(\App\Model\emp::class)
          ->withDefault([

              'att_days'=>0,
              'absent_days'=>0,
          ]);

   }

   public function official_holidays(){
	return $this->belongsToMany(\App\Model\officialHoliday::class,'attendance_official','attendance_id','official_id');
 }
 public function holidays(){
	return $this->hasMany(\App\Model\holiday::class);
 }

}
