export interface MessageFormData {
    conversation_uuid: string;
    sender_id: string;
    sender_type: 'user' | 'teammate';
    content: string;
}