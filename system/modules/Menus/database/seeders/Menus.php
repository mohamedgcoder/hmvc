<?php

namespace Module\Menus\database\seeders;

use Carbon\Carbon;
use Module\Menus\Models\Menu;
use Illuminate\Database\Seeder;
use Module\Languages\Models\Translations;

class Menus extends Seeder
{
    protected array $data;
    protected array $menu;
    protected mixed $group;
    protected string $module;
    protected string $type;
    protected array $item;
    protected array $items;
    protected int $itemId;
    protected int $groupId;
    protected int $parentId;
    protected string $insertType;

    public function __construct(array $data)
    {
        // set Menu Data
        $this->data = $data;

        $this->run();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // save Menu
        $this->parentId = 0;

        foreach ($this->data as $menu) {
            $this->menu = $menu;
            $this->storeGroup();
        }
    }

    public function storeGroup()
    {
        // set group data
        $this->group = $this->menu['group'];
        // set items data
        $this->items = $this->menu['items'];

        // set module name
        $this->module = $this->group['module'];
        // set type name
        $this->type = $this->group['type'];

        if(is_array($this->group['name'])){
            $this->item = $this->group;
            $this->parentId = 0;
            $this->groupId = 0;
            $this->insertType = 'group';
            $this->insert();
        }else{
            $this->groupId = $this->group['name'];
        }

        $this->storeMenu();
    }

    public function storeMenu()
    {
        try {
            $children = [];
            foreach($this->items as $item){
                $this->item = $item;
                $this->insertType = 'item';
                $parentId = $this->insert();
                if(is_array($item['children'])){
                    $children[$parentId] = $item['children'];
                }
            }

            if(!empty($children)){
                $this->items = $children;
                $this->insertchildren();
            };
            return true;

        } catch (\Throwable $th) {
            throw $th;
        }

    }

    protected function insertchildren()
    {
        foreach($this->items as $k => $child) {
            $this->parentId = $k;
            $this->items = $child;
            $this->storeMenu();
        }

        return true;
    }

    protected function insert()
    {
        $Id = Menu::insertGetId([
            'module' => ($this->insertType != 'group')? $this->module : 'group',
            'type' => $this->type,
            'url' => $this->item['url']?? '#',
            'group' => $this->groupId?? 0,
            'parent' => $this->item['parent']??$this->parentId?? 0,
            'icon' => $this->item['icon']?? null,
            'arrangement' => $this->item['arrangement']?? 10000,
            'created_by' => 1
        ]);

        if(is_array($this->item['name'])){
            $this->itemId = $Id;
            $this->insertTranslations();
        }

        if($this->insertType == 'group')
            $this->groupId = $Id;

        return $Id;
    }

    protected function insertTranslations()
    {
        foreach($this->item['name'] as $lang => $v){
            Translations::create([
                'key' => $this->itemId,
                'value' => $v,
                'lang' => $lang,
                'module' => 'menus',
            ]);
        }

        return true;
    }
}
