<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApproveStory extends Mailable
{
    use Queueable, SerializesModels;
    public $story;
    public function __construct($story)
    {
        $this->story= $story;
    }
    public function build()
    {
        return $this->view('email')
            ->subject('Approve Story');
    }

}
