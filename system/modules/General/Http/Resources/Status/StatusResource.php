<?php

namespace Module\General\Http\Resources\Status;

use Illuminate\Support\Str;
use Module\Languages\Service\LanguagesService;
use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
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
            'name' => (string) LanguagesService::getName($this->statusTrans),
            'color' => (string) $this->getStatusColor($this->id),
            'icon' => (string) $this->getStatusIcon()
            // 'children' => CategoryCollection::make($this->whenLoaded('children'))
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

    static function getStatusColor($code) : string
    {
        switch ($code) {
          case 1:
            return 'primary';
            break;
          case 2:
              return 'success';
            break;
          case 3:
              return 'danger';
            break;
          case 4:
              return 'dark';
            break;

          default:
            return 'secondary';
        }
    }

    private function getStatusIcon() : string
    {
        $code = $this->id;
        switch ($code) {
            case 1:
              return 'icon-file-empty';
              break;
            case 2:
                return 'icon-clipboard2';
              break;
            case 3:
                return 'icon-lock5';
              break;
            case 4:
                return 'icon-user-block';
              break;

            default:
              return 'secondary';
        }
    }
}
