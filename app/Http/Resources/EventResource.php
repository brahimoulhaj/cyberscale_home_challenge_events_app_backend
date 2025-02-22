<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'date' => $this->date,
            'time' => $this->time,
            'location' => $this->location,
            'host' => $this->whenLoaded('host', fn () => UserResource::make($this->host)),
            'max_participants' => $this->max_participants,
            'count_participants' => $this->whenCounted('participants'),
            'participants' => $this->whenLoaded('participants', fn () => UserResource::collection($this->participants)),
            'category' => $this->whenLoaded('category', fn () => [
                'name' => $this->category->name,
                'description' => $this->category->description,
            ]),
        ];
    }

    public function with(Request $request): array
    {
        return [
            'success' => true,
        ];
    }
}
