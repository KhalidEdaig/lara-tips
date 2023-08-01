<?php

namespace App\Console\Commands;

use App\Jobs\SendMessageToSubscriptionExpireJob;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SubscriptionExpiryNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:expiry-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check which subscription user has been expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $customers = Customer::where('subscription_end_at', '<', now())->get();


        foreach ($customers as $customer) {
            $expire_date = Carbon::createFromFormat('Y-m-d', $customer->subscription_end_at)->toDateString();
            dispatch(new SendMessageToSubscriptionExpireJob($customer, $expire_date))->onQueue('subscription_expired');
        }
    }
}
