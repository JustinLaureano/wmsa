import { JsonApiResource } from '../../../shared/JsonApiResource.types';
import { Teammate, DomainAccount, User } from '../entities';

export type UserDetailAttributes = User;

export interface UserDetailRelations {
    teammate: Teammate;
    domainAccount: DomainAccount;
}

export interface UserDetailComputed {
    clock_number: string;
    domain_account_guid: string;
    first_name: string;
    last_name: string;
    display_name: string;
    title: string;
    description: string;
    department: string;
    email: string;
    hire_date: string;
}

export type UserDetailResource = JsonApiResource<
    UserDetailAttributes,
    UserDetailRelations,
    UserDetailComputed
>;