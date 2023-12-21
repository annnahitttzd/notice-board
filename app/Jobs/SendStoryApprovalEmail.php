<?php

namespace App\Jobs;

use App\Mail\ApproveStory;
use App\Models\StoryApproval;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
class SendStoryApprovalEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $story;

    public function __construct($story)
    {
    $this->story = $story;
    }
    public function handle(): void
    {
        $this->onQueue('emails');
       Mail::to("recipient@example.com")->send(new ApproveStory($this->story));

    }
}
