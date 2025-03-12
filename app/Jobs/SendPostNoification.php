<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPostNoification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $post;
    
    public function __construct(Post $post)
    {
        $this->post = $post;        
    }

    public function handle()
    {
        $subscribers = \App\Models\User::subscribers()->get();
        foreach($subscribers as $subscriber){
            Mail::to($subscriber->email)->send(new \App\Mail\PostPublished($this->post));
        }
    }
}
