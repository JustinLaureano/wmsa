import { ReactNode } from "react";
import { ConversationResource, MessageResource } from '../domains/messaging/resources';

export interface MessagingProviderProps {
    children: ReactNode;
}

export interface MessagingContextValue {
    conversations: ConversationResource[];
    setConversations: (conversations: ConversationResource[]) => void;
    unreadMessages: number;
    setUnreadMessages: (count: number) => void;
    activeConversation: ConversationResource | null;
    setActiveConversation: (conversation: ConversationResource | null) => void;
    activeMessages: MessageResource[] | null;
    setActiveMessages: (messages: MessageResource[] | null) => void;
    handleNewMessageRequest: (content: string) => Promise<MessageResource | null>;
}