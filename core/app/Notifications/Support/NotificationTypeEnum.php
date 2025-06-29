<?php

namespace App\Notifications\Support;

enum NotificationTypeEnum: string
{
    case SORT_LIST_MATERIAL_ADDED = 'sort-list-material-added';

    public function label() : string
    {
        return match ($this) {
            static::SORT_LIST_MATERIAL_ADDED => __('notifications.sort_list_material_added.label'),
        };
    }
}
