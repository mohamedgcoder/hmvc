<?php

namespace module\Contacts\Database\Seeders;

use Carbon\Carbon;
use Module\Contacts\Models\Phone;
use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
{
    protected $MemberCode;
    protected $Phone;

    public function __construct(array $data)
    {
        $this->MemberCode = $data['code'];
        $this->Phone = $data['phone'];

        $this->run();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // store phone
        $this->storePhone();
    }

    public function storePhone()
    {
        try {
            Phone::insert([
                'code' => $this->MemberCode,
                'phone' => $this->Phone,
                'default' => true,
                'phone_verified_at' => Carbon::now(),
                'created_by' => 1
            ]);

            return true;
        } catch (\Throwable $th) {
            throw $th;
        }

    }
}
