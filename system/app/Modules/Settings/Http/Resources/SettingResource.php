<?php

namespace Settings\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
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
            'module' => (string) $this->module,
            'setting' => (string) $this->setting,
            'value' => $this->getValue(),
        ];

        return $data;
    }

    private function getValue(): string
    {
        $data = [];
        if(!$this->translation){
            return $this->setting;
        }else{
            foreach ($this->valueTrans as $valueTrans) {
                $data[$valueTrans->lang]['name'] = $valueTrans->value;
            }
        }

        return (isset($data[_current_Language()])) ? $data[_current_Language()]['name'] : $data[_default_lang()]['name'];
    }
}
