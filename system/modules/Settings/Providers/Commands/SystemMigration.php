<?php

namespace Module\Settings\Providers\Commands;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: "system:migrate")]
class SystemMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "system:migrate";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "System Migration";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Start migrating: SYSTEM");
        $this->info("-----------------------------------------");
        Artisan::call("migrate:fresh --database=landlord --seed");
        $this->info(Artisan::output());
        _logoutAllUsers();
        _clearLogs();
        _clearViews();
        $this->info("-----------------------------------------");
        $this->info("You can access Admin Panel at: ".env('APP_DOMAIN')."/panel user owner@".env('APP_DOMAIN')." Password 123456");
    }
}
