<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\RoadLike;

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
        $like = new RoadLike();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'prefecture_id' => $this->prefecture_id,
            'description' => $this-> description,
            'user_name' => $this->user->name,
            'filename' => $this->filename,
            'created_at' => $this->created_at->format('Y/m/d'),
            'updated_at' => $this->updated_at->format('Y/m/d'),
            'road_likes_count' => $this->roadLikes->count(),
            'road_like' => $like->like_exist(1, $this->id),
        ];
    }
}
