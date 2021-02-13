<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class training extends Model {

	use SoftDeletes;
	protected $dates = ['deleted_at'];

protected $table    = 'trainings';
protected $fillable = [
		'id',
		'admin_id',
		              'emp_id',
'coursenum',
'tradate',
'trayear',
'emp_id',
    'month',


    'created_at',
		'updated_at',
		'deleted_at',
	];
    protected $casts = [
        'tradate' => 'date'
    ];

   public function emp(){
      return $this->belongsTo(\App\Model\emp::class)->withDefault([
          'coursenum' =>0,     ]);
   }

}
