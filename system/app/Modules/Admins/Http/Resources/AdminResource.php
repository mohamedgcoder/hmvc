<?php

namespace Admins\Http\Resources;

use General\Http\Resources\Status\StatusResource as StatusResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
            'name' => (string) $this->name,
            'phone' => (string) $this->phone,
            'email' => (string) $this->email,
            'profile_pic' => (string) $this->avatar,
            'status_message' => (string) $this->status_message,
            'status' => [
                'code' => (integer) $this->status,
                'name' => (string) StatusResource::getStatusName($this->adminStatus),
                'color' => (string) StatusResource::getStatusColor($this->status),
            ],
            'title' => [
                'name' => (string) $this->getTitle($this->adminTitle),
                'code' => (integer) $this->title,
            ],
            'gender' => [
                'name' => (string) $this->getGender($this->adminGender),
                'code' => (integer) $this->gender,
            ],
            'created_at' => $this->created_at->toDateTimeString(),
            'deleted_at' => ($this->deleted_at == null) ? null : $this->deleted_at->toDateTimeString(),
        ];

        return $data;
    }

    private function getTitle($title): string
    {
        $data = [];
        foreach ($title as $s) {
            $data[$s->lang]['name'] = $s->value;
        }

        return (isset($data[_current_Language()])) ? $data[_current_Language()]['name'] : $data[_default_lang()]['name'];
    }

    private function getGender($gender): string
    {
        $data = [];
        foreach ($gender as $s) {
            $data[$s->lang]['name'] = $s->value;
        }

        return (isset($data[_current_Language()])) ? $data[_current_Language()]['name'] : $data[_default_lang()]['name'];
    }
}
