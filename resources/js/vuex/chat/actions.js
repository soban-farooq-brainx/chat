let chatActions = {
    setContacts: (context) => {
        return new Promise((resolve, reject) => {
            axios.post('/users').then(response => {
                let users = response.data;
                context.commit('setContacts', users);
                resolve('success')
            }).catch(err => {
                reject(err)
            });
        })
    },
    setChat: (context, id) => {
        axios.get(`/conversations/${id}`).then(response => {
            let chat = response.data;
            context.commit('setChat', chat);
        });
    },
    sendMessage: (context, payload) => {
        axios.post('/send-message', payload).then((response) => {
            console.log(response)
        }).catch(err => {
            console.log(err)
        });
        context.commit('sendMessage', payload)
    },
    getLoggedInUser: (context) => {
        axios.get('/user').then(response => {
            context.commit('getLoggedInUser', response.data);
        })
    }
};

export default chatActions
