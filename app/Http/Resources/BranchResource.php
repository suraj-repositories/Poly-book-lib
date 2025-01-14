<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
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
            'name' => $this->name,
            'image' => $this->getFullImageUrl($this->image),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
         ];
    }



    // Custom method to get the full image URL
    private function getFullImageUrl()
    {
        return url('storage/' . $this->image); // Assuming images are stored in the 'storage' directory
    }
}
