let chatMutations = {
    setContacts: (state, users) => {
        state.contacts = users;
    },
    getContacts: (state) => {
        return state.contacts;
    },
    setChat: (state, chat) => {
        state.chats = chat;
    },
    getLoggedInUser: (state, user) => {
        state.logged_in_user = user
    },
    sendMessage: (state, payload) => {
        // console.log(state.chats);
        state.chats.push(payload);
    }
};

export default chatMutations
