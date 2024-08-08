<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SmsQueueJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $numbers;
    public $message;

    public $tries = 5;
    public $timeout = 5;
    public function __construct($numbers, $message)
    {
        $this->numbers = $numbers;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        sms_send($this->numbers, $this->message);
    }
}
