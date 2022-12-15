<?php

namespace App\Jobs;

use App\Mail\EmployeeJoined;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $template;
    protected $email;
    protected $body;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mail)
    {
        $this->template = $mail["template"];
        $this->email = $mail["email"];
        $this->body = $mail["body"];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        switch($this->template)
        {
            case "employeejoined":
                Mail::to($this->email)->send(new EmployeeJoined($this->body));
                break;
            default:
                dd("SendMail: Invalid Template");
                break;
        }
    }
}
