<?php

namespace Module\General\Http\Resources\Gender;

use Illuminate\Support\Str;
use Module\Languages\Service\LanguagesService;
use Illuminate\Http\Resources\Json\JsonResource;
use Module\General\Http\Resources\Status\StatusResource as StatusResource;

class GenderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'id' => (integer) $this->id,
            'name' => (string) LanguagesService::getName($this->nameTrans),
            'status' => (array) [
                'name' => (string) LanguagesService::getName($this->statusTrans),
                'code' => (integer) $this->status,
                'color' => (string) StatusResource::getStatusColor($this->status),
            ]
        ];

        if(_is_admin()){
            $data['actions'] = [
                "createdBy" => (Str::substr($this->created_by, 0, 4) == 'LAND')? Str::ucfirst(_trans("Admins", "administration")) : $this->created_by,
                "lastUpdatedBy" => $this->last_updated_by,
                "createdAt" => $this->created_at->toDateTimeString(),
                "updatedAt" => ($this->updated_at == null) ? null : $this->updated_at->toDateTimeString(),
                "deletedAt" => ($this->deleted_at == null) ? null : $this->deleted_at->toDateTimeString(),
             ];
        }

        return $data;
    }
}
