import { ConversationResource, MessageResource } from "@/types/messaging";
import { createContext } from "react";

type MessagingContextType = {
    conversations: ConversationResource[];
    setConversations: (conversations: ConversationResource[]) => void;

    unreadMessages: number;
    setUnreadMessages: (unreadMessages: number) => void;

    activeConversation: ConversationResource | null;
    setActiveConversation: (activeConversation: ConversationResource | null) => void;

    activeMessages: MessageResource[] | null;
    setActiveMessages: (activeMessages: MessageResource[] | null) => void;

    handleNewMessageRequest: (content: string) => Promise<MessageResource|null|undefined>;
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
    handleNewMessageRequest: async () => (null)
});

export default MessagingContext;