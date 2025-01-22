import { useContext } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ProductionPageHeader from '@/Domains/Production/Layout/Header/ProductionPageHeader';
import ComboBox from '@/Components/Inputs/ComboBox';

interface MachineOptionResource {
    uuid: string;
    label: string;
    value: string;
}

interface NewMaterialRequestFormProps {
    machines: MachineOptionResource[];
}

export default function NewMaterialRequestForm({ ...props } : NewMaterialRequestFormProps) {
    const { lang } = useContext(LanguageContext);
    const { machines } = props;

    return (
        <DashboardLayout title={lang.requests}>
            <ProductionPageHeader />

            <ComboBox
                options={machines}
                inputLabel="Choose a machine"
                onChange={(value) => {

                    console.log(value);
                }}
            />
        </DashboardLayout>
    );
}
