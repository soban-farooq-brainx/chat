let chatActions = {
    fetchContacts: (context) => {
        axios.post('/users', {}).then(response => {
            let users = response.data;
            context.commit('fetchContacts', users)
        });
    }
};

export default chatActions
