<?php

namespace contacts\Database\Seeders;

use Carbon\Carbon;
use Contacts\Models\Email;
use Illuminate\Database\Seeder;

class EmailSeeder extends Seeder
{
    protected $MemberCode;
    protected $Email;

    public function __construct(array $data)
    {
        $this->MemberCode = $data['code'];
        $this->Email = $data['email'];

        $this->run();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // store email
        $this->storeEmail();
    }

    public function storeEmail()
    {
        try {
            Email::insert([
                'code' => $this->MemberCode,
                'email' => $this->Email,
                'default' => true,
                'email_verified_at' => Carbon::now(),
                'created_by' => 1
            ]);

            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
