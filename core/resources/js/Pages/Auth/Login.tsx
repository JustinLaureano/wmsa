import { FormEventHandler } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Head, useForm } from '@inertiajs/react';

export default function Login({ status, canResetPassword }: { status?: string, canResetPassword: boolean }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        samaccountname: '',
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
        <DashboardLayout title={"Login"}>
            <form onSubmit={submit}>
                <div>Login</div>

                <div className="flex flex-col gap-3">
                    <input onChange={e => setData('samaccountname', e.target.value)} />
                    <input onChange={e => setData('password', e.target.value)} />
                </div>

                <button type="submit">Submit</button>

            </form>
        </DashboardLayout>
    );
}
