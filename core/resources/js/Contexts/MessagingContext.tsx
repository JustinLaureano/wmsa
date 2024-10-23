import { createContext } from "react";

export interface Conversation {
    [key: string]: any;
}

type MessagingContextType = {
    conversations: Conversation[];
    setConversations: (conversations: Conversation[]) => void;
}

const MessagingContext = createContext<MessagingContextType>({
    conversations: [],
    setConversations: () => {},
});

export default MessagingContext;