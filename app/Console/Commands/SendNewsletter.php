<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Campaign;
use App\MemberList;
use App\Mail\Newsletter;
use Mail;

class SendNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send newsletters';

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
     * @return mixed
     */
    public function handle()
    {
        $now = \Carbon\Carbon::now();
        $now->second = 00;
        $date = $now->format('Y-m-d H:i');

        $campaigns = Campaign::where('active', true)->where('send', false)->where('send_time', $date)->get();
        
        foreach ($campaigns as $campaign) {
            $list = MemberList::where('id', $campaign->list_id)->first();
            foreach ($list->members as $member) {
                Mail::to($member->member->email)->queue(new Newsletter($campaign->title, $campaign->content));
            }

            $campaign->send = 1;
            $campaign->save();
        }
    }
}
