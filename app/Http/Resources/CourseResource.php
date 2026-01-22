<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //حنتحكم في الحقول اللي حترجع
        //فقط الحقول اللي حيتم ذكرها هي اللي حترجع
        //وكمان حنقدر نغير اسماء الحقول اسماء الاعمدة
        return [
            'id' => $this->id,
            'the_name' => $this->name,
            'the_status' => $this->active ? 'active' : 'inactive'


        ];
    }
}
