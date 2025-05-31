import { ConversationResource, MessageResource } from "@/types/domains/messaging";

export type MessagingContextType = {
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