<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SoalResource extends JsonResource
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
            'pertanyaan' => $this->pertanyaan,
            'kategori' => $this->kategori,
            'opsi_a' => $this->opsi_a,
            'opsi_b' => $this->opsi_b,
            'opsi_c' => $this->opsi_c,
            'opsi_d' => $this->opsi_d,
        ];
    }
}
