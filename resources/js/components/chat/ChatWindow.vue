<template>
    <div class="reset-container container-fluid">

        <div class="chat-flex">
            <div class="contacts flex-column">
                <search></search>

                <div class="contact" v-for="contact in contacts" :key="contact.id"
                     @click="[getChat(contact.id), selectUser(contact)]">
                    <p class="margin-fix contact-name">
                        {{contact.name}}
                    </p>
                    <p class="margin-fix contact-email">
                        {{contact.email}}
                    </p>
                </div>

            </div>
            <div class="flex-column reset-container message-area-container">
                <message-area :user="user"></message-area>
            </div>
        </div>

    </div>
</template>

<script>

    import {mapState, mapActions} from 'vuex';

    export default {
        data() {
            return {
                user: {},
            }
        },
        computed: {
            ...mapState([
                'contacts',
                'chats'
            ]),
        },
        methods: {
            getChat(id) {
                this.$store.dispatch('setChat', id);
            },
            selectUser(user) {
                this.user = user;
            },
        },
        mounted: function () {
            this.$store.dispatch('setContacts').then(() => {
                this.user = this.$store.getters.getContacts[0];
                this.getChat(this.user.id);
            });
            this.$store.dispatch('getLoggedInUser');
        }
    }
</script>

<style scoped>

</style>
