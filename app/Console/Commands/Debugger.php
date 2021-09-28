<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Clients\AwsClient;
use App\Models\Merchant;

class Debugger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'debug:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for testing things';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $merchant = Merchant::find(3);
        $awsClient =  app()->make(AwsClient::class);
        $response = $awsClient->getNewAccessTokenByRefreshToken($merchant->username, $merchant->refresh_token);
        $responseData = $response->get("AuthenticationResult");
        $token = $responseData["IdToken"];
        $this->info($token);
        return 0;
    }
}
