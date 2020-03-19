<template>
    <div class="reset-container container-fluid">

        <div class="chat-flex">
            <div class="contacts flex-column" :class="{menuToggle: toggle}">
                <search :showConversation="showConversation"
                        @newConversation="showConversation = $event"
                        @searchStarted="startSearch($event)"
                ></search>
                <div class="contact-book-component-wrapper"
                     :class="{'hide': showConversation}">
                    <!-- contact-book has all components -->
                    <contact-book :contacts="contacts" @newUserSelected="user = $event"
                                  :query="search"></contact-book>
                </div>
                <div class="conversation-component-wrapper"
                     :class="{'hide': !showConversation}">
                    <!-- conversation component -->
                    <conversation @newUserSelected="user = $event"></conversation>
                </div>
                <!-- Should switch between contact book and conversation component upon clicking the buttons-->
            </div>
            <div class="flex-column reset-container message-area-container">
                <message-area :user="user" @menuToggled="toggleMenu($event)"></message-area>
            </div>
        </div>

    </div>
</template>

<script>

    import {mapState, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                user: {},
                showConversation: false,
                toggle: '',
                search: ''
            }
        },
        computed: {
            ...mapState([
                'conversations',
                'contacts',
                'searchContacts',
                'chats'
            ]),

        },
        methods: {
            getChat(id) {
                this.$store.dispatch('setChat', id);
            },
            selectedNewUser(user) {
                this.user = user;
            },
            startSearch(value) {
                this.search = value;
            },
            toggleMenu(toggle) {
                this.toggle = toggle;
            },
        },
        mounted: function () {
            // first storing contacts on start
            this.$store.dispatch('setContacts').then(() => {
                this.user = this.$store.getters.getContacts[0];
                this.getChat(this.user.id);
            });

            this.$store.dispatch('setConversations');
            this.$store.dispatch('getLoggedInUser');

        }
    }
</script>

<style scoped>

</style>
