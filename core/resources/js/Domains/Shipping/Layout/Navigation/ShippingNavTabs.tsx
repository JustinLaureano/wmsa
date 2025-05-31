import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function ShippingNavTabs() {
    const tabs = [
        { label: 'Shipping Requests', route: route('shipping.requests') },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
