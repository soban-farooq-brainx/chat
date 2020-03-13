let chatMutations = {
    fetchContacts: (state, users) => {
        state.contacts = users;
        return users
    }
};

export default chatMutations
