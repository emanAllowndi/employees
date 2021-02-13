<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

use Illuminate\Database\Eloquent\SoftDeletes;
use Nagy\LaravelRating\Traits\Rate\Rateable;
use Model\App\rating;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class task extends Model  implements Auditable  {

	use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    use Rateable;
	protected $dates = ['deleted_at'];

protected $table    = 'tasks';
protected $fillable = [
		'id',

    'updating_reason',

    'tyear',
    'month',
    'type',
    'note',


    'admin_id',
		      'task_name',
'task_desc',
'days',
'status',
'task_rate',
		'created_at',
		'updated_at',
		'deleted_at',
		'emp_name',
		'emp_id',
    'tdate',

	];
    protected $casts = [
        'tdate' => 'date'
    ];

	public function emp(){
		return $this->belongsTo(\App\Model\emp::class);
	 }

	 public function rating(){
		return $this->hasOne(\App\Model\rating::class,'task_id','id');
	 }

}
