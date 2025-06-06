import { ConversationResource, MessageResource } from "@/types/domains/messaging";

export interface MessagingContextValue {
    conversations: ConversationResource[];
    setConversations: (conversations: ConversationResource[]) => void;
    unreadMessages: number;
    setUnreadMessages: (unread: number) => void;
    activeConversation: ConversationResource | null;
    setActiveConversation: (conversation: ConversationResource | null) => void;
    activeMessages: MessageResource[] | null;
    setActiveMessages: (messages: MessageResource[] | null) => void;
    handleNewMessageRequest: (content: string) => Promise<MessageResource | null>;
    handleConversationMessagesRead: (conversationUuid: string) => Promise<void>;
    isLoadingMessages: boolean;
}