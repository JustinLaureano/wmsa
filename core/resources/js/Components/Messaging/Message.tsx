import MessageContainer from './MessageContainer';
import { MessageResource } from '@/types/messaging';
import AuthContext from '@/Contexts/AuthContext';
import { useContext } from 'react';

interface MessageProps {
    message: MessageResource;
}

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
            <div>{message.attributes.created_at}</div>
            <div>{message.computed.filtered_content}</div>
        </MessageContainer>
    );
}
