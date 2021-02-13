<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

use Illuminate\Database\Eloquent\SoftDeletes;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class job extends Model  implements Auditable {

	use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];

protected $table    = 'jobs';
protected $fillable = [
		'id',

    'updating_reason',

		'admin_id',
		      'job_name',
'job_desc',
		'created_at',
		'updated_at',
		'deleted_at',
	];
    public function emps(){
        return $this->hasMany(\App\Model\emp::class);
    }


}
