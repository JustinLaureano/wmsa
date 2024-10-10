<?php

namespace App\Domain\Auth\Ldap;

use LdapRecord\Models\ActiveDirectory\User as LdapUser;
use App\Models\User as DatabaseUser;

class OrganizationIdAttributeHandler
{
    public function handle(LdapUser $ldap, DatabaseUser $database)
    {
        // $company = $ldap->getAttribute('company');
        // TODO: use company to determine org id

        $database->organization_id = 1;
    }
}
