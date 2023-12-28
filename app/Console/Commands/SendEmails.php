<?php

namespace App\Console\Commands;

use App\Jobs\SendStoryApprovalEmail;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    protected $signature = 'send:email';
    protected $description = 'Command description';
    public function handle()
    {
        $stories = \App\Models\Story::where('approved', false)->get();
        foreach ($stories as $story) {
            SendStoryApprovalEmail::dispatch($story)->onQueue('emails');
        }
    }
}
