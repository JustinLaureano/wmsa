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
}

const MessagingContext = createContext<MessagingContextType>({
    conversations: [],
    setConversations: () => {},
    unreadMessages: 0,
    setUnreadMessages: () => {},
    activeConversation: null,
    setActiveConversation: () => {},
    activeMessages: null,
    setActiveMessages: () => {}
});

export default MessagingContext;