import { FormEventHandler, useState } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import { Head, useForm } from '@inertiajs/react';
import PrimaryLogo from '@/Components/PrimaryLogo';

export default function Clockin(props: any) {
    const { data, setData, post, processing, errors, reset } = useForm({
        clock_number: '',
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('clockin'), {
            onSuccess: () => window.location.reload(),
        });
    };

    return (
        <SidebarLayout title="Clock In">
            <Head title="Clock In" />

            <div>
                <PrimaryLogo />
            </div>

            <form onSubmit={submit}>
                <div>Clock Number</div>

                <div className="flex flex-col gap-3">
                    <input onChange={e => setData('clock_number', e.target.value)} />
                </div>

                <button type="submit">Submit</button>

            </form>
        </SidebarLayout>
    );
}
