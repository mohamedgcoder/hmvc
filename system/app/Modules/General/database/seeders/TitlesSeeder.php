<?php

namespace general\Database\Seeders;

use General\Models\Title;
use General\Data\TitlesData;
use Languages\Models\Translations;

use Illuminate\Database\Seeder;

class TitlesSeeder extends Seeder
{
    protected $Titles;

    public function __construct()
    {
        $this->Titles = TitlesData::getTitles();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!empty($this->Titles)){
            foreach($this->Titles as $k => $title){
                foreach($title as $trans){
                    $id = Title::insertGetId([
                        'status' => 2,
                        'module' => $k,
                        'created_by' => 1
                    ]);

                    foreach($trans as $lang => $v){
                        Translations::create([
                            'key' => $id,
                            'value' => $v,
                            'lang' => $lang,
                            'module' => 'titles',
                        ]);
                    }
                }
            }
        }
    }
}
