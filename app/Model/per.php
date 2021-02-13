<?php
namespace App\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Model\emp;
use App\Model\job;
use Barryvdh\DomPDF\PDF;




// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class per extends Model implements Auditable {

	use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];

protected $table    = 'pers';
protected $fillable = [
		'id',

    'updating_reason',

    'per_pic',
    'pyear',
    'month',


    'admin_id',
		'emp_id',
		'per_cause',
		'job_name',
		'from',
		'to',
		'created_at',
		'updated_at',
		'deleted_at',
    'pdate',
	];
    protected $casts = [
        'pdate' => 'date'
    ];

	public function emp(){
		return $this->belongsTo(\App\Model\emp::class);
	 }

}
