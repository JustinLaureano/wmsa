import { createContext } from "react";
import { ConversationResource, MessageResource } from "@/types";

export interface MessagingContextType {
    conversations: ConversationResource[];
    setConversations: (conversations: ConversationResource[]) => void;
    unreadMessages: number;
    setUnreadMessages: (unread: number) => void;
    activeConversation: ConversationResource | null;
    setActiveConversation: (conversation: ConversationResource | null) => void;
    activeMessages: MessageResource[] | null;
    setActiveMessages: (messages: MessageResource[] | null) => void;
    handleNewMessageRequest: (content: string) => Promise<MessageResource | null>;
    handleConversationMessagesRead: (conversationUuid: string, userUuid: string) => Promise<void>;
    isLoadingMessages: boolean;
}

const MessagingContext = createContext<MessagingContextType>({
    conversations: [],
    setConversations: () => {},
    unreadMessages: 0,
    setUnreadMessages: () => {},
    activeConversation: null,
    setActiveConversation: () => {},
    activeMessages: null,
    setActiveMessages: () => {},
    handleNewMessageRequest: async () => null,
    handleConversationMessagesRead: async () => {},
    isLoadingMessages: false,
});

export default MessagingContext;