<?php

namespace App\Notifications;

use App\Models\SortList;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SortListMaterialAdded extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected SortList $sortList)
    {
        $this->sortList->load('material');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        app()->setLocale($notifiable->settings?->locale ?? 'en');

        return (new MailMessage)
            ->subject(__('notifications.sort_list_material_added.subject'))
            ->line(__('notifications.sort_list_material_added.header', [
                'part_number' => $this->sortList->material->part_number,
            ]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'uuid' => $this->sortList->uuid,
            'sort_list_customer_uuid' => $this->sortList->sort_list_customer_uuid,
            'material_uuid' => $this->sortList->material_uuid,
        ];
    }
}
