import React from 'react';
import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function NavTabs(props : Record<string, any>) {
    const href = window.location.href;

    const tabs = [
        { label: 'Material Requests', route: route('production.requests') },
        { label: 'New Request', route: route('production.requests.create') },
    ]

    let value = 0;

    tabs.map((tab, index) => {
        if (href == tab.route) {
            value = index;
        }
    })

    return (
        <SubpageNavigationTabs
            tabs={tabs}
            value={value}
        />
    )
}
