import {
    JsonApiResource,
    Teammate,
    DomainAccount,
    User,
    Role,
    Permission,
    UserSetting,
} from '@/types';

export type UserDetailAttributes = User;

export interface UserDetailRelations {
    teammate: Teammate;
    domainAccount: DomainAccount;
    roles: Role[];
    permissions: Permission[];
    settings: UserSetting[];
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
    user_uuid: string;
}

export type UserDetailResource = JsonApiResource<
    UserDetailAttributes,
    UserDetailRelations,
    UserDetailComputed
>;