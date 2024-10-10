<?php

namespace App\Domain\Auth\Ldap;

use LdapRecord\Models\Scope;
use LdapRecord\Models\Model;
use LdapRecord\Query\Model\Builder;

class OnlyUsersScope implements Scope
{
    /**
     * Apply the scope to the query.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where([
            ['samaccountname', 'not_contains', 'DBAdmin'],
            ['samaccountname', 'not_contains', 'HealthMailbox'],
            ['samaccountname', 'not_contains', 'internet'],
            ['samaccountname', 'not_contains', 'Radley'],
            ['samaccountname', 'not_contains', 'test'],
            ['samaccountname', 'not_contains', 'tuser'],
            ['samaccountname', 'not_starts_with', '$'],
            ['samaccountname', 'not_starts_with', 'avd'],
            ['samaccountname', 'not_starts_with', 'backup'],
            ['samaccountname', 'not_starts_with', 'bapm'],
            ['samaccountname', 'not_starts_with', 'DDNS'],
            ['samaccountname', 'not_starts_with', 'fpd'],
            ['samaccountname', 'not_starts_with', 'http'],
            ['samaccountname', 'not_starts_with', 'ILS_'],
            ['samaccountname', 'not_starts_with', 'P1'],
            ['samaccountname', 'not_starts_with', 'P2'],
            ['samaccountname', 'not_starts_with', 'SM_'],
            ['samaccountname', 'not_starts_with', 'SQL'],
            ['samaccountname', 'not_starts_with', 'svc-'],
            ['samaccountname', '!=', 'anipirakis'],
            ['samaccountname', '!=', 'ASPNET'],
            ['samaccountname', '!=', 'aspuser'],
            ['samaccountname', '!=', 'AUTOCH2'],
            ['samaccountname', '!=', 'brinell'],
            ['samaccountname', '!=', 'BXSMITH'],
            ['samaccountname', '!=', 'contracer'],
            ['samaccountname', '!=', 'dcadmin'],
            ['samaccountname', '!=', 'exchuser'],
            ['samaccountname', '!=', 'faoguestconf'],
            ['samaccountname', '!=', 'faro'],
            ['samaccountname', '!=', 'forklifts'],
            ['samaccountname', '!=', 'FTAdmin'],
            ['samaccountname', '!=', 'Gotosuser'],
            ['samaccountname', '!=', 'Guest'],
            ['samaccountname', '!=', 'hdv300user'],
            ['samaccountname', '!=', 'helpdesk'],
            ['samaccountname', '!=', 'hexagon'],
            ['samaccountname', '!=', 'hrscanuser'],
            ['samaccountname', '!=', 'IcarasAdmin'],
            ['samaccountname', '!=', 'irm'],
            ['samaccountname', '!=', 'irmtech'],
            ['samaccountname', '!=', 'leoni'],
            ['samaccountname', '!=', 'licensing'],
            ['samaccountname', '!=', 'kace'],
            ['samaccountname', '!=', 'MAINT2'],
            ['samaccountname', '!=', 'MTS'],
            ['samaccountname', '!=', 'nurse'],
            ['samaccountname', '!=', 'nurseprac'],
            ['samaccountname', '!=', 'phosphate'],
            ['samaccountname', '!=', 'PCGREEN'],
            ['samaccountname', '!=', 'presses'],
            ['samaccountname', '!=', 'process'],
            ['samaccountname', '!=', 'rodcadmin'],
            ['samaccountname', '!=', 'tordival'],
            ['samaccountname', '!=', 'xfserver'],
            ['description', 'not_contains', 'Exchange'],
            ['description', 'not_contains', 'Key Distribution'],
            ['description', 'not_contains', 'Machine Administrator'],
            ['description', 'not_contains', 'Mailbox'],
            ['description', 'not_contains', 'veeam'],
            ['displayname', 'not_contains', 'Microsoft'],
            ['displayname', 'not_contains', 'Radley'],
            ['givenname', 'not_contains', 'SVC'],
        ]);
    }
}
