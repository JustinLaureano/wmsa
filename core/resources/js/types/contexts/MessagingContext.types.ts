import {
    ConversationResource,
    MessageResource,
    ParticipantAutocompleteResource,
} from "@/types/domains/messaging";

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
    handleConversationMessagesRead: (conversationUuid: string, userUuid: string) => Promise<void>;
    isLoadingMessages: boolean;
    isStartingNewConversation: boolean;
    setIsStartingNewConversation: (isStarting: boolean) => void;
    newConversationParticipants: string[];
    setNewConversationParticipants: (participants: string[]) => void;
    handleStartNewConversation: (participants: string[]) => void;
    handleAddNewConversationParticipant: (participant: string) => void;
    handleRemoveNewConversationParticipant: (participant: string) => void;
    handleCreateNewConversation: (content: string) => Promise<void>;
    participantOptions: ParticipantAutocompleteResource[];
}