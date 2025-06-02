import { useContext } from 'react';
import { MessageProps } from '@/types';
import AuthContext from '@/Contexts/AuthContext';
import MessageContainer from './MessageContainer';
import MessageMeta from './MessageMeta';
import MessageCard from './MessageCard';

export default function Message({ message, ...props }: MessageProps) {
    const { user } = useContext(AuthContext);
    const { sender_uuid } = message.computed;

    let justify = 'left';

    if (
        user &&
        user.uuid == sender_uuid
    ) {
        justify = 'right';
    }

    return (
        <MessageContainer justify={justify}>
            <MessageMeta
                justify={justify}
                message={message}
            />
            <MessageCard
                justify={justify}
                message={message}
            />
        </MessageContainer>
    );
}
