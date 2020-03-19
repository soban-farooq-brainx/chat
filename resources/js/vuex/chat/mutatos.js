let chatMutations = {
    setConversations: (state, users) => {
        state.conversations = users;
    },

    setContacts: (state, users) => {
        state.contacts = users;
        state.searchContacts = users;
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
