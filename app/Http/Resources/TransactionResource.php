<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'idtransac'=> $this->idtransac,
            'amount'=> $this->amount,
            'annonceId'=> new AnnonceResource($this->annonceId),
            'senderId'=> new UserResource($this->senderId),
            'receiverId'=> new UserResource($this->receiverId),
            'status'=> $this->status,
            'created_at'=> $this->created_at,
            'end_at'=> $this->end_at
        ];
    }
}
