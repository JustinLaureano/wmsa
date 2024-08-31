import { PropsWithChildren } from 'react';

export default function Guest({ children }: PropsWithChildren) {
    return (
        <div className="flex flex-col items-center">
            <h1 className="pb-12">Guest</h1>
            <div>{children}</div>
        </div>
    );
}
