import { Teammate, User } from "@/types";

export function getPrimaryAuthIdentifiers(teammate: Teammate|null, user: User|null)
{
    let id, type = '';

    if (teammate) {
        id = teammate.clock_number.toString();
        type = 'teammate';
    }
    else if (user) {
        id = user.guid;
        type = 'user';
    }

    return { id, type };
}