<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class sector extends Model  implements Auditable {

    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
	protected $dates = ['deleted_at'];

protected $table    = 'sectors';
protected $fillable = [
		'id',

    'updating_reason',

		'admin_id',
		      'sector',
		'created_at',
		'updated_at',
		'deleted_at',
	];
    public function emps(){
        return $this->hasMany(\App\Model\emp::class);
    }

}
