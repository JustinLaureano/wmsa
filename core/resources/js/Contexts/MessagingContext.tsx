import { MessagingContextType } from "@/types/contexts";
import { createContext } from "react";

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