<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use twilio\sdk\Services\Twilio;

class SendReminderSMS extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
     public $user = null,$data = [];


    public function __construct(User $user,$data)
    {
        $this->user = $user;
        $this->data = $data;


    }



    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // set your AccountSid and AuthToken from www.twilio.com/user/account
        $AccountSid = "ACae8728fd2ac2d6ea9f4860e632ef077a";
        $AuthToken = "2623e244fb5f103a4b41dc59b6f2fc5a";

        $client = new Services_Twilio($AccountSid, $AuthToken);

        $message = $client->account->messages->create(array(
            "From" => "YYY-YYY-YYYY",
            "To" => "XXX-XXX-XXXX",
            "Body" => "Test message!",
        ));

        // Display a confirmation message on the screen
        echo "Sent message {$message->sid}";

            \Log::info('DATA: ' . $this->data['message']);
    }
}
