<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class BrandOwnerNotification extends Notification
{
    use Queueable;

    protected $details;
    public $url;

    public function __construct($details, $url)
    {
        $this->details = $details;
        $this->url = $url;
    }

    public function via($notifiable)
    {
        return ['database'];  // Assurez-vous que 'database' est dans le tableau
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Nouveau Panne', 
            'text' => $this->details,
            'message' => $this->details,
            'url' => $this->url,
            'icon' => 'bx-send',
           
        ];
    }
}
