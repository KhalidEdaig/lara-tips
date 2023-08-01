<?php

namespace App\Jobs;

use App\Helpers\Utilities;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMessageToSubscriptionExpireJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private Customer $customer, private string $expire_date)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Utilities::sendMail('emails.subscription-expiration', $this->customer->email, 'Your subscription has been expired', $this->customer);
    }
}
