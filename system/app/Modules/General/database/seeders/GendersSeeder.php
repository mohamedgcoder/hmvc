<?php

namespace general\Database\Seeders;

use General\Models\Gender;
use Languages\Models\Translations;
use General\Data\GendersData;
use Illuminate\Database\Seeder;

class GendersSeeder extends Seeder
{
    protected $Genders;

    public function __construct()
    {
        $this->Genders = GendersData::getGenders();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!empty($this->Genders)){
            foreach($this->Genders as $k => $gender){
                foreach($gender as $trans){
                    $id = Gender::insertGetId([
                        'status' => 2,
                        'module' => $k,
                        'created_by' => 1
                    ]);

                    foreach($trans as $lang => $v){
                        Translations::create([
                            'key' => $id,
                            'value' => $v,
                            'lang' => $lang,
                            'module' => 'genders',
                        ]);
                    }
                }
            }
        }
    }
}
