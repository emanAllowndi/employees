<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\attendance;
use App\Model\user;
use App\Model\task;
use App\Model\per;
use App\Model\job;
use App\Model\rating;
use App\Model\audit;





// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class emp extends Model implements Auditable {

	use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
	protected $dates = ['deleted_at'];

protected $table    = 'emps';
protected $fillable = [
		'id',

    'updating_reason',

		'admin_id',
			  'emp_name',
			  'second_name',
			  'third_name',
			  'last_name',
			  'department_id',
			  'department_name',

			  'job_id',
			  'user_id',
			  'first_name',

			  'job_name',

				'salary',
				'major',
				'qulification',
		'created_at',
		'updated_at',
		'updated_at',
		'deleted_at',
		'task_name',
		'rating',
    'motivation',
    'administration_id',
    'publicadmin_id',
    'sector_id',

'gender',
'status',
'start_date',
'phone_number',
'emergency_number',
'emergency_person',
'email',
'social',
'nationality',
'snn',
'passport',
'birth_date',
'birth_place',
'sons',
'employment_number',
    'cv',
    'contract',
    'photo_profile',
    'fingerprint',
    'account_num',
    'work_nature',
    'level',
    'transportation',
    'activity',



];

	public function tasks(){
		return $this->hasMany(\App\Model\task::class);
	 }
	 public function department(){
		return $this->belongsTo(\App\Model\department::class)
            ->withDefault([
                'department_name' => 'لا يوجد قسم',
            ]);
	 }
    public function administration(){
        return $this->belongsTo(\App\Model\administration::class)
            ->withDefault([
                'administration' => 'لا يوجد ادارة',
            ]);
    }
    public function publicAdmin(){
        return $this->belongsTo(\App\Model\publicAdmin::class)
            ->withDefault([
                'publicAdmin' => 'لا يوجد ادارة عامة',
            ]);
    }
    public function sector(){
        return $this->belongsTo(\App\Model\sector::class)
            ->withDefault([
                'sector' => 'لا يوجد قطاع',
            ]);
    }
	 public function job(){
		return $this->belongsTo(\App\Model\job::class)->withDefault([
            'job_name' => 'لا يوجد وظيفة',
        ]);
	 }

	 public function user(){
		return $this->belongsTo(\App\Model\user::class)->withDefault([
            'first_name' => 'لا يوجد مسؤول مشرف',
            'middel_name' => '',
            'last_name' => '',
        ]);
	 }
	 public function holidays(){
		return $this->hasMany(\App\Model\holiday::class);
	 }
	 public function pers(){
		return $this->hasMany(\App\Model\per::class);
	 }

	 public function attendances(){
		return $this->hasMany(\App\Model\attendance::class);
	 }

    public function holidayPalances(){
        return $this->hasMany(\App\Model\holidayPalance::class);
    }
}
