let chatActions = {

    setConversations: (context) => {
        return new Promise((resolve, reject) => {
            axios.get('/conversations').then(response => {
                let conversations = response.data;
                context.commit('setConversations', conversations);
                resolve('success')
            }).catch(err => {
                reject(err);
            });
        })
    },
    setContacts: (context) => {
        return new Promise((resolve, reject) => {
            axios.post('/users').then(response => {
                let users = response.data;
                context.commit('setContacts', users);
                resolve()
            }).catch(err => {
                reject(err)
            });
        })
    },
    setChat: (context, id) => {
        axios.get(`/conversation/${id}`).then(response => {
            let chat = response.data;
            context.commit('setChat', chat);
        });
    },
    sendMessage: (context, payload) => {
        return new Promise((resolve, reject) => {
            axios.post('/send-message', payload).then((response) => {
                if (response.status === 201)
                    resolve(response.data);
            }).catch(err => {
                reject(err)
            });
        });

    },
    getLoggedInUser: (context) => {
        return new Promise((resolve, reject) => {
            axios.get('/user').then(response => {
                context.commit('getLoggedInUser', response.data);
                resolve(response.data);
            }).catch(err => {
                reject(err);
            })
        });

    }
};

export default chatActions
