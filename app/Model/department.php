<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Model\emp;
use App\Model\administration;
use Illuminate\Database\Eloquent\SoftDeletes;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class department extends Model implements Auditable {

	use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];

protected $table    = 'departments';
protected $fillable = [
		'id',

    'updating_reason',

		'admin_id',
		              '',
'department_name',
'department_id',

'department_desc',
		'created_at',
		'updated_at',
		'deleted_at',
    'administration',
    'administration_id',
	];
    public function administration(){
        return $this->belongsTo(\App\Model\administration::class)
            ->withDefault([
                'administration' => 'لا يوجد ادارة',
            ]);;
    }
    public function emps(){
        return $this->hasMany(\App\Model\emp::class);
    }

}
