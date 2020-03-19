<template>
    <div class="row reset-row">
        <input class="form-control" id="search-field" type="text" placeholder="Type to search."
               v-model="search" @keyup="searchContacts">
        <div class="switch-buttons">
            <button class="btn btn-sm" id="contacts-switch-button" @click="switchToContacts">Contacts</button>
            <button class="btn btn-sm" id="conversation-switch-button" @click="switchToConversations">Conversations
            </button>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex';

    export default {
        props: ['showConversation', 'showContacts'],
        data() {
            return {
                search: '',
                filtered: this.contacts
            }
        },
        computed: {
            ...mapState([
                'contacts'
            ])
        },
        methods: {
            switchComponent() {
                let conversation = !this.showConversation;
                this.$emit('newConversation', conversation);
            },
            switchToContacts() {
                let showContacts = true;
                let showConversation = false;
                this.emitEvents(showContacts, showConversation);
            },
            switchToConversations() {
                let showConversation = true;
                let showContacts = false;
                this.emitEvents(showContacts, showConversation)
            },
            searchContacts() {
                this.$emit('searchStarted', this.search);
            },
            emitEvents(contact, conversation) {
                let switchComponent = {
                    showContacts: contact,
                    showConversations: conversation,
                };
                this.$emit('switchedBetweenContactAndConversation', switchComponent)
            }
        }
    }
</script>

<style scoped>

</style>
