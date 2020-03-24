let chatGetters = {
    getContacts: (state) => {
        return state.contacts;
    },
    getConversations: (state) => {
        return state.conversations;
    },
    getSearchContacts: (state) => {
        return state.searchContacts
    }
};

export default chatGetters
