let chatMutations = {
    fetchContacts: (state, users) => {
        state.contacts = users;
        return users
    },
    fetchChat: (state, chat) => {
        state.chats = chat;
        return chat;
    }
};

export default chatMutations
