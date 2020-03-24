<template>
    <div class="message-footer-container">
        <input class="form-control" v-model="message" @keyup.enter="sendMessage()" type="text" id="message-input"
               placeholder="Start to type here..">
    </div>

</template>

<script>

    import {mapState, mapMutations} from 'vuex';

    export default {
        props: ['user'],
        data: function () {
            return {
                message: '',
                messageObj: {}
            }
        },
        computed: {
            ...mapState([
                'chats',
                'logged_in_user'
            ]),
        },
        methods: {
            ...mapMutations([
                'appendMessage'
            ])
            ,
            sendMessage() {
                this.messageObj = {
                    user_id: this.logged_in_user.id,
                    receiver_id: this.user.id,
                    message: this.message,
                    is_read: 0
                };
                this.message = '';
                this.$store.dispatch('sendMessage', this.messageObj).then((response) => {
                    console.log(response);
                });
                this.appendMessage(this.messageObj)
            },
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
