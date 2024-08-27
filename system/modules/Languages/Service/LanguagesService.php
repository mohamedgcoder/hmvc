<?php

namespace Module\Languages\Service;

class LanguagesService
{
    public static function getName($nameTrans) : string
    {
        $data = [];
        foreach($nameTrans as $s){
            $data[$s->lang]['name'] = $s->value;
        }

        return (isset($data[_current_Language()])) ? $data[_current_Language()]['name'] : $data[_default_lang()]['name'] ;
    }
}
