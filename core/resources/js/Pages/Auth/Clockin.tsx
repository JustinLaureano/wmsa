import { FormEventHandler, useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import { Head, useForm } from '@inertiajs/react';
import PrimaryLogo from '@/Components/PrimaryLogo';
import LanguageContext from '@/Contexts/LanguageContext';

export default function Clockin(props: any) {
    const { lang } = useContext(LanguageContext);

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
        <SidebarLayout title={lang.clockin}>
            <Head title={lang.clockin} />

            <div>
                <PrimaryLogo />
            </div>

            <form onSubmit={submit}>
                <div>{lang.clock_number}</div>

                <div className="flex flex-col gap-3">
                    <input onChange={e => setData('clock_number', e.target.value)} />
                </div>

                <button type="submit">{lang.submit}</button>

            </form>
        </SidebarLayout>
    );
}
