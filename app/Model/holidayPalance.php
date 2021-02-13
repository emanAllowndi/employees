<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use OwenIt\Auditing\Contracts\Audit;
use OwenIt\Auditing\Contracts\Auditable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class holidayPalance extends Model implements Auditable {


    use SoftDeletes;
	protected $dates = ['deleted_at'];

protected $table    = 'holiday_palances';
protected $fillable = [
		'id',

    'updating_reason',

		'admin_id',
    'month',

    'palyear',
    'paldate',

    'holidayPalance',
'emp_id',

'holidaytype_id',

'note',
		'created_at',
		'updated_at',
		'deleted_at',
	];

    public function emp(){
        return $this->belongsTo(\App\Model\emp::class)->withDefault();
    }
    public function holidaytype(){
        return $this->belongsTo(\App\Model\holidaytype::class)->withDefault();
    }

    /**
     * @inheritDoc
     */
    public function audits(): MorphMany
    {
        // TODO: Implement audits() method.
    }

    /**
     * @inheritDoc
     */
    public function setAuditEvent(string $event): Auditable
    {
        // TODO: Implement setAuditEvent() method.
    }

    /**
     * @inheritDoc
     */
    public function getAuditEvent()
    {
        // TODO: Implement getAuditEvent() method.
    }

    /**
     * @inheritDoc
     */
    public function getAuditEvents(): array
    {
        // TODO: Implement getAuditEvents() method.
    }

    /**
     * @inheritDoc
     */
    public function readyForAuditing(): bool
    {
        // TODO: Implement readyForAuditing() method.
    }

    /**
     * @inheritDoc
     */
    public function toAudit(): array
    {
        // TODO: Implement toAudit() method.
    }

    /**
     * @inheritDoc
     */
    public function getAuditInclude(): array
    {
        // TODO: Implement getAuditInclude() method.
    }

    /**
     * @inheritDoc
     */
    public function getAuditExclude(): array
    {
        // TODO: Implement getAuditExclude() method.
    }

    /**
     * @inheritDoc
     */
    public function getAuditStrict(): bool
    {
        // TODO: Implement getAuditStrict() method.
    }

    /**
     * @inheritDoc
     */
    public function getAuditTimestamps(): bool
    {
        // TODO: Implement getAuditTimestamps() method.
    }

    /**
     * @inheritDoc
     */
    public function getAuditDriver()
    {
        // TODO: Implement getAuditDriver() method.
    }

    /**
     * @inheritDoc
     */
    public function getAuditThreshold(): int
    {
        // TODO: Implement getAuditThreshold() method.
    }

    /**
     * @inheritDoc
     */
    public function getAttributeModifiers(): array
    {
        // TODO: Implement getAttributeModifiers() method.
    }

    /**
     * @inheritDoc
     */
    public function transformAudit(array $data): array
    {
        // TODO: Implement transformAudit() method.
    }

    /**
     * @inheritDoc
     */
    public function generateTags(): array
    {
        // TODO: Implement generateTags() method.
    }

    /**
     * @inheritDoc
     */
    public function transitionTo(Audit $audit, bool $old = false): Auditable
    {
        // TODO: Implement transitionTo() method.
    }



}
