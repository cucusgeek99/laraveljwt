<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CryptoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent => =>toArray($request);
        return 
      [ "idCrypto" => $this->idCrypto,
        "cryptoName" => $this->cryptoName,
        "cryptoSigle" => $this->cryptoSigle,
         "status" => $this->status,
         "cryptoImage" =>$this->cryptoImage,
        "cryptoAddress" =>$this->cryptoAddress,
        "updated_at" => $this->updated_at,
        "created_at" => $this->created_at,
    ];
    }
}
