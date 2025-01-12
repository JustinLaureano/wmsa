<?php

namespace App\Repositories;

use App\Models\DomainAccount;
use LdapRecord\Container;

class DomainAccountRepository
{
    /**
     * Find a domain account record by a given column name.
     */
    public function findBy(string $column, string $value) : DomainAccount|null
    {
        return DomainAccount::query()->where($column, $value)->first();
    }

    /**
     * Find a domain account record for a teammate by the given first and last name.
     */
    public function findForTeammate(string $firstName, string $lastName) : DomainAccount|null
    {
        return DomainAccount::query()->whereName($firstName, $lastName)->first();
    }

    /**
     * Authenticate the given domain account using the AD password.
     */
    public function validateCredentials(string $dn, string $password) : bool
    {
        $connection = Container::getConnection('default');

        return $connection->auth()->attempt($dn, $password);
    }
}
