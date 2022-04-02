<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoadResource extends JsonResource
{
    /**3
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'prefecture_id' => $this->prefecture_id,
            'description' => $this-> description,
            'user_id' => $this->user_id,
            'filename' => $this->filename,
            'created_at' => $this->created_at->format('Y/m/d')
        ];
    }
}
