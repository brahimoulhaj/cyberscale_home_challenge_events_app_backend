<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

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
            'is_past' => Carbon::parse($this->date.' '.$this->time)->isPast(),
            'location' => $this->location,
            'host' => $this->whenLoaded('host', fn () => UserResource::make($this->host)),
            'max_participants' => $this->max_participants,
            'count_participants' => $this->whenCounted('participants'),
            'participants' => $this->whenLoaded('participants', function () use ($request) {
                if ($request->routeIs('events.show')) {
                    return UserResource::collection($this->participants);
                }

                return $this->participants->pluck('id');
            }),
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
