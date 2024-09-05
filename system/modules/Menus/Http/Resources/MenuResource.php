<?php

namespace Module\Menus\Http\Resources;

use Module\Menus\Models\Menu;
use Module\Languages\Service\LanguagesService;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            'id' => (string) $this->id,
            'url' => (string) $this->url,
            'icon' => (string) $this->icon,
            'name' => (string) LanguagesService::getName($this->menuTrans),
            'parent' => (string) $this->parent,
            'module' => (string) $this->module,
            'children' => MenuCollection::make(Menu::where('parent', $this->id)->with('menuTrans')->get())->resolve(),
        ];

        return $data;
    }
}
