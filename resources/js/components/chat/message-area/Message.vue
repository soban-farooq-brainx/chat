<template>
    <div class="messages-container">
        <template v-if="chats.length > 0">
            <div v-for="chat in chats"
                 class="message"
                 :class="{myMessage: chat.user_id === logged_in_user.id,
                      notMyMessage: chat.user_id !== logged_in_user.id }">
                <p class="margin-fix">
                    {{chat.message}}
                </p>
            </div>
        </template>
        <template v-else>
            <p id="start-conversation">
                <!--                Start a conversation with {{user.name}}-->
                Start a conversation.
            </p>
        </template>

    </div>
</template>

<script>
    import {mapState} from 'vuex'

    export default {
        props: ['user'],
        data: function () {
            return {
                listenCalled: false
            }
        },
        computed: {
            ...mapState([
                'contacts',
                'chats',
                'logged_in_user'
            ]),
        },
        methods: {
            listen() {
                console.log('listen called');
                Echo.private(`messages.${this.logged_in_user.id}`)
                    .listen('NewMessage', (response) => {
                        console.log(this.chats);
                        // check if we are talking to the user right now
                        if (response.message.user_id === this.user.id) {
                            // means we are talking to user
                            this.chats.push(response.message);
                        }
                        console.log(response.message)
                    });
            }
        },
        mounted() {
        },
        updated() {
            // save references
            let messageContainer = $('.messages-container');
            let messageContainerFooter = $('.message-footer-container');
            let messageContainerTop = messageContainer.offset().top;
            let sendMessageInputTop = messageContainerFooter.offset().top;
            let height = sendMessageInputTop - (messageContainerTop);
            messageContainer.height(height);
            // scroll to bottom
            // messageContainer.animate({scrollTop: messageContainer.height()}, 300);
            messageContainer.scrollTop(10000000);
            if(this.listenCalled===false) {
                this.listenCalled = true;
                this.listen();
            }
        }
    }
</script>

<style scoped>

</style>
