<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'student' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'status' => $this->status,
                'code' => $this->code,
                'links' => [
                    'family' =>$this->when(User::where('status','family')
                        ->where('code',$this->code)
                        ->first(),route('users.family',$this->code)) // todo: buradaki sorguya bakılacak
                ]
            ]
        ];
    }
}
