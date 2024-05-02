<?php

namespace App\Jobs;

use App\Events\NotificationsEvent;
use App\Models\NotificationMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $userId,
        public string $title,
        public string $body,
        public ?string $link,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $message = NotificationMessage::create([
            'user_id' => $this->userId,
            'title'   => $this->title,
            'body'    => $this->body,
            'link'    => $this->link,
        ]);
        NotificationsEvent::dispatch($message);
    }
}
