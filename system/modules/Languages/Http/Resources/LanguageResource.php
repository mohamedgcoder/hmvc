<?php

namespace Module\Languages\Http\Resources;

use Illuminate\Support\Str;
use Module\Languages\Service\LanguagesService;
use Illuminate\Http\Resources\Json\JsonResource;
use Module\Admins\Models\Admin;
use Module\General\Http\Resources\Status\StatusResource as StatusResource;

class LanguageResource extends JsonResource
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
            'code' => (string) $this->code,
            'dir' => (string) $this->direction,
            'flag' => (string) $this->flag,
        ];
        $data['default_name'] = (string) $this->name;
        $data['name'] = (string) (_current_Language() == "en") ? $this->name : LanguagesService::getName($this->nameTrans);
        $data['status'] = (array) [
            'code' => (integer) $this->status,
            'name' => (string) LanguagesService::getName($this->statusTrans),
            'color' => (string) StatusResource::getStatusColor($this->status),
        ];

        if(_is_admin()){
            $data['actions'] = [
                "createdBy" => (Str::substr($this->created_by, 0, 4) == 'LAND')? Str::ucfirst(_trans("Admins", "administration")) : $this->created_by,
                "lastUpdatedBy" => ($this->last_updated_by != null)? Admin::where('id', $this->last_updated_by)->first()->name : $this->last_updated_by,
                "createdAt" => $this->created_at->toDateTimeString(),
                "updatedAt" => ($this->updated_at == null) ? null : $this->updated_at->toDateTimeString(),
                "deletedAt" => ($this->deleted_at == null) ? null : $this->deleted_at->toDateTimeString(),
             ];
        }

        return $data;
    }
}
