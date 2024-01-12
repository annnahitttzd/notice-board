<?php

namespace App\Console\Commands;

use App\Jobs\SendStoryApprovalEmail;
use Illuminate\Console\Command;
use App\Models\Story;
class SendEmails extends Command
{
    protected $signature = 'send:email';
    protected $description = 'New email sending';
    public function handle()
    {
        $stories = Story::where('approved', false)->get();
        foreach ($stories as $story) {
            SendStoryApprovalEmail::dispatch($story)->onQueue('emails');
        }
    }
}
