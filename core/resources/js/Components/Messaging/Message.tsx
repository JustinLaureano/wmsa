import { useContext } from 'react';
import { MessageProps } from '@/types';
import AuthContext from '@/Contexts/AuthContext';
import MessageContainer from './MessageContainer';
import MessageMeta from './MessageMeta';
import MessageCard from './MessageCard';

export default function Message({ message, ...props }: MessageProps) {
    const { teammate, user } = useContext(AuthContext);

    // const {} = message.computed;

    let justify = 'left';

    if (
        (
            teammate && 
            teammate.clock_number == message.attributes.sender_id &&
            message.attributes.sender_type == 'teammate'
        ) ||
        (
            user &&
            user.guid == message.attributes.sender_id &&
            message.attributes.sender_type == 'user'
        )
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
