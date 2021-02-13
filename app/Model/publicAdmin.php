<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class publicAdmin extends Model  implements Auditable {

    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
	protected $dates = ['deleted_at'];

protected $table    = 'public_admins';
protected $fillable = [
		'id',

    'updating_reason',

		'admin_id',
		              'sector_id',
'publicAdmin',
'sector_id',

		'created_at',
		'updated_at',
		'deleted_at',
	];

    public function sector(){
      return $this->belongsTo(\App\sector::class)
          ->withDefault([
              'sector' => 'لا يوجد قطاع',
          ]);
   }
    public function emps(){
        return $this->hasMany(\App\Model\emp::class);
    }


}
