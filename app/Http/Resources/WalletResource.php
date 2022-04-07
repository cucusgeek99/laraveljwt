<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
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

             'idUser'=> new UserResource($this->idUser),
            'amount'=> $this->amount,
          'crypto'=> new CryptoResource($this->crypto),
            'lastUserAdress'=> $this->lastUserAdress
        ];
    }
}
