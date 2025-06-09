import { createContext } from "react";
import {
    ConversationResource,
    MessageResource,
    ParticipantAutocompleteResource,
} from "@/types";

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
    isStartingNewConversation: false,
    setIsStartingNewConversation: () => {},
    newConversationParticipants: [],
    setNewConversationParticipants: () => {},
    handleStartNewConversation: async () => {},
    handleAddNewConversationParticipant: () => {},
    handleRemoveNewConversationParticipant: () => {},
    handleCreateNewConversation: async () => {},
    participantOptions: [],
});

export default MessagingContext;