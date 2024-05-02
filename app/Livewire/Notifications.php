<?php

namespace App\Livewire;

use App\Models\NotificationMessage;
use Livewire\Attributes\On;
use Livewire\Component;

class Notifications extends Component
{
    public $unread;

    public $messages;

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $this->unread = $this->announcements = collect([]);

        $messages       = auth()->user()->notificationMessages()->latest()->get();
        $this->messages = $messages->whereNotNull('read_at');
        $this->unread   = $messages->whereNull('read_at');
    }

    #[On('newMessage')]
    public function getNotifications()
    {
        $this->loadNotifications();
    }

    public function markAsRead(NotificationMessage $notification)
    {
        $notification->markAsRead();
        $this->loadNotifications();
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
