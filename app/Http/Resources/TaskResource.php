<?php

namespace App\Http\Resources;

use App\Core\Task\Services\Delivery\DeliveryStatusService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $deliveryService = resolve(DeliveryStatusService::class);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'priority' => $this->priority,
            'is_completed' => $this->is_completed ? 1 : 0,
            'due_date' => Carbon::parse($this->due_date)->format('d/m/Y H:i:s'),
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d/m/Y H:i:s'),
            'delivery_status' => $deliveryService->getStatus($this->resource),
            'user' => $this->user ? [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
            ] : null,
        ];
    }
}
