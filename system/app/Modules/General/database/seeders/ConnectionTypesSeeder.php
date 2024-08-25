<?php

namespace general\Database\Seeders;

use General\Models\ConnectionType;
use General\Data\ConnectionTypesData;
use Illuminate\Database\Seeder;

class ConnectionTypesSeeder extends Seeder
{
    protected $ConnectionTypes;

    public function __construct()
    {
        $this->ConnectionTypes = ConnectionTypesData::getConnectionTypes();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!empty($this->ConnectionTypes)){
            foreach($this->ConnectionTypes as $type){
                ConnectionType::insert([
                    'name' => $type,
                    'status' => 2,
                    'created_by' => 1
                ]);
            }
        }
    }
}
