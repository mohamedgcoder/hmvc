<?php

namespace module\General\Database\Seeders;

use Module\General\Models\Status;
use Module\Languages\Models\Translations;
use Module\General\Data\StatusData;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    protected $Status;

    public function __construct()
    {
        $this->Status = StatusData::getStatus();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!empty($this->Status)){
            foreach($this->Status as $k => $stat){
                foreach($stat as $trans){
                    $id = Status::insertGetId([
                        'module' => $k,
                        'created_by' => 1
                    ]);

                    foreach($trans as $lang => $v){
                        Translations::create([
                            'key' => $id,
                            'value' => $v,
                            'lang' => $lang,
                            'module' => 'status',
                        ]);
                    }
                }

            }
        }
    }
}
