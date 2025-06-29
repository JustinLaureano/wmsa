<?php

namespace App\Notifications\Support;

use App\Models\SortList;
use App\Models\User;
use App\Notifications\SortListMaterialAdded;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as NotificationFacade;

class NotificationDispatcher
{
    /**
     * Send a notification to the recipients.
     */
    public static function sendNotification(
        Collection $recipients,
        Notification $notification
    ) : void
    {
        if ($recipients->isEmpty()) {
            return;
        }

        NotificationFacade::send($recipients, $notification);
    }

    /**
     * Get the recipients for a notification type.
     */
    public static function getRecipients(string $notificationType) : Collection
    {
        return User::query()
            ->whereHas('notificationPreferences', function ($query) use ($notificationType) {
                $query->where('notification_type', $notificationType)
                    ->where('email_enabled', true);
            })
            ->whereHas('domainAccount')
            ->get();
    }

    /**
     * Send a notification to the recipients of the sort list material added.
     *
     * @param SortList $sortList
     * @return void
     */
    public static function sendSortListMaterialAddedNotification(SortList $sortList)
    {
        $recipients = self::getRecipients(NotificationTypeEnum::SORT_LIST_MATERIAL_ADDED->value);

        self::sendNotification($recipients, new SortListMaterialAdded($sortList));
    }
}
