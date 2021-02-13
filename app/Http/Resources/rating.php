<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class rating extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            
            'task_id'=>$this->task_id,
            'rating'=>$this->rating,
        ];
    }
}
