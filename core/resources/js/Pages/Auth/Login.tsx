import { FormEventHandler, useState } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Login({ status, canResetPassword }: { status?: string, canResetPassword: boolean }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('login'), {
            onFinish: () => reset('password'),
        });
    };

    return (
        <DashboardLayout>
            <Head title="Log in" />

            <form onSubmit={submit}>
                <div>Login</div>

                <div className="flex flex-col gap-3">
                    <input onChange={e => setData('email', e.target.value)} />
                    <input onChange={e => setData('password', e.target.value)} />
                </div>

                <button type="submit">Submit</button>

            </form>
        </DashboardLayout>
    );
}
