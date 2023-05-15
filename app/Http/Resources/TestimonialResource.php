<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->employee->name,
            'company' => $this->employee->company->name,
            'position' => $this->employee->position->name,
            'desc' => $this->description,
            'reviewerName' => $this->reviewer->name,
            'rating' => $this->rating
        ];
    }
}
