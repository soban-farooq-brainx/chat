let chatActions = {
    fetchContacts: (context) => {
        axios.post('/users', {}).then(response => {
            let users = response.data;
            context.commit('fetchContacts', users)
        });
    },
    fetchChat: (context, id) => {
        axios.get(`/conversations/${id}`).then(response => {
            let chat = response.data;
            context.commit('fetchChat', chat);
        });
    }
};

export default chatActions
