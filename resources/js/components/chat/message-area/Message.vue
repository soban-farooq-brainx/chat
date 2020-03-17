<template>
    <div class="messages-container">
        <template v-if="chats.length > 0">
            <div v-for="chat in chats"
                 class="message"
                 :class="{myMessage: chat.sender_id === logged_in_user.id,
                      notMyMessage: chat.sender_id !== logged_in_user.id }">
                <p class="margin-fix">
                    {{chat.messages}}
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
        computed: {
            ...mapState([
                'contacts',
                'chats',
                'logged_in_user'
            ]),
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
            messageContainer.scrollTop(messageContainer.height());
        }
    }
</script>

<style scoped>

</style>
