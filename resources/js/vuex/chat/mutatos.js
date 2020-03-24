let chatMutations = {
    setConversations: (state, users) => {
        state.conversations = users;
    },

    setContacts: (state, users) => {
        state.contacts = users;
        state.searchContacts = users;
    },
    markAsRead: (state, payload) => {
        state.contacts.forEach((item) => {
            item.messages.forEach(message => {
                if ((message.receiver_id === payload.receiver_id && message.user_id === payload.sender_id) ||
                    (message.receiver_id === payload.sender_id && message.user_id === payload.receiver_id)) {
                    message.is_read = 1;
                }
            })
        });
    },
    markAsUnread: (state, payload) => {
        state.contacts.forEach((item) => {
            if (item.id === payload.user_id) {
                item.messages.push(payload);
            }
        });
    },
    setChat: (state, chat) => {
        state.chats = chat;
    },
    getLoggedInUser: (state, user) => {
        state.logged_in_user = user
    },
    appendMessage: (state, payload) => {
        state.chats.push(payload);
    }
};

export default chatMutations
