<template>
    <div>
        <div class="conversation" v-for="(conversation, index) in conversations" :class="{'active': index===0}"
             :key="conversation.id"
             @click="[getChat(conversation), addActiveClass(index)]">
            <template v-if="conversation.user.id === logged_in_user.id">
                <p class="margin-fix contact-name">
                    {{conversation.receiver.name}}
                </p>
                <p class="margin-fix contact-email">
                    {{conversation.receiver.email}}
                </p>
            </template>
            <template v-else>
                <p class="margin-fix contact-name">
                    {{conversation.user.name}}
                </p>
                <p class="margin-fix contact-email">
                    {{conversation.user.email}}
                </p>
            </template>

        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex';

    export default {
        data: function () {
            return {
                conversationData: {}
            }
        },
        computed: {
            ...mapState([
                'conversations',
                'contacts',
                'chats',
                'logged_in_user'
            ]),
        },
        methods: {
            getChat(conversation) {
                let id = '';
                if (conversation.user.id === this.logged_in_user.id) {
                    id = conversation.receiver.id;
                    this.selectUser(conversation.receiver);
                } else {
                    id = conversation.user.id;
                    this.selectUser(conversation.user);
                }
                this.$store.dispatch('setChat', id);
            },
            selectUser(user) {
                this.$emit('newUserSelected', user);
            },
            addActiveClass(index) {
                let elements = [...document.querySelectorAll('.conversation')];
                elements.forEach(element => {
                    element.classList.remove('active');
                });
                elements[index].classList.add('active');
            }
        },
        updated() {
            this.conversationData = this.conversations;
        }
    }
</script>

<style scoped>

</style>
