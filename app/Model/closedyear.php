<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

use Illuminate\Database\Eloquent\SoftDeletes;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class closedyear extends Model implements Auditable {

    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
	protected $dates = ['deleted_at'];

protected $table    = 'closedyears';
protected $fillable = [
		'id',

    'updating_reason',

		'admin_id',
		      'closedyear',
		'created_at',
		'updated_at',
		'deleted_at',
	];

}
