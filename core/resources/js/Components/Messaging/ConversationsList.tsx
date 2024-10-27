import { useContext } from 'react';
import { List } from '@mui/material';
import OverflowScrollBox from '../Shared/OverflowScrollBox';
import MessagingContext from '@/Contexts/MessagingContext';
import ConversationsListItem from './ConversationListItem';

interface ConversationsListProps {}

export default function ConversationsList({ ...props }: ConversationsListProps ) {
    const { conversations } = useContext(MessagingContext);

    return (
        <OverflowScrollBox>
            <List>
                {conversations?.map((conversation, index) => (

                    <ConversationsListItem
                        key={conversation.uuid}
                        conversation={conversation}
                    />

                ))}
            </List>
        </OverflowScrollBox>
    );
}
