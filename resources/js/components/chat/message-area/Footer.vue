<template>
    <div class="message-footer-container">
        <input class="form-control" v-model="message" @keyup.enter="sendMessage()" type="text" id="message-input"
               placeholder="Start to type here..">
    </div>

</template>

<script>

    import {mapState} from 'vuex';

    export default {
        props: ['user'],
        data: function () {
            return {
                message: '',
                lastMessage: {}
            }
        },
        computed: {
            ...mapState([
                'chats',
                'logged_in_user'
            ])
        },
        methods: {
            sendMessage() {
                this.$store.dispatch('sendMessage', {
                    user_id: this.logged_in_user.id,
                    receiver_id: this.user.id,
                    message: this.message
                });
                this.message = ''
            }
        },
        mounted() {
            const message_container = $('.message-area-container');
            const to_set_width = message_container.innerWidth();
            const footer_container = $('.message-footer-container');
            footer_container.width(to_set_width - 1);
        },

    }
</script>

<style scoped>

</style>
