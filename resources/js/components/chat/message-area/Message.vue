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
    }
</script>

<style scoped>

</style>
