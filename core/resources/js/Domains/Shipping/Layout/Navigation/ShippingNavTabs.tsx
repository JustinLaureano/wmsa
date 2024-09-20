import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function ShippingNavTabs(props : Record<string, any>) {
    const tabs = [
        { label: 'Shipping Requests', route: route('shipping.requests') },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
