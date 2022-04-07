<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnnonceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // parent::toArray($request); 
        return[
                "idAn"=> $this->idAn,
                "paymentMethodId"=> $this->paymentMethodId,
                "anNumber"=> $this->anNumber, 
                 "user"=> new UserResource($this->user),
                "dollarPrice"=> $this->dollarPrice,
                "cryptoPrice"=> $this->cryptoPrice,
                "quantMin"=> $this->quantMin,
                "quantMax"=> $this->quantMax,
                 "crypto"=> new CryptoResource($this->crypto),
                "created_at"=>$this->created_at,
                "updated_at"=> $this->updated_at,
                "status"=> $this->status,  
   
        ];


    }
}
