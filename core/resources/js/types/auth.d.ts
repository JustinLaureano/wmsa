export interface User {
    guid: string;
    organization_id: string;
    first_name: string;
    last_name: string;
    title: string;
    description: string;
    department: string;
    email: string;
}

export interface Teammate {
    [key: string]: any;
}
