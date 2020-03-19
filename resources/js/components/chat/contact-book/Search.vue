<template>
    <div class="row reset-row">
        <input class="form-control" id="search-field" type="text" placeholder="Type to search."
               v-model="search" @keyup="searchContacts">
        <div class="switch-buttons">
            <button class="btn btn-sm" id="contacts-switch-button" @click="switchComponent">Contacts</button>
            <button class="btn btn-sm" id="conversation-switch-button" @click="switchComponent">Conversations</button>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex';

    export default {
        props: ['showConversation'],
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
            searchContacts() {
                this.$emit('searchStarted', this.search);
            }
        }
    }
</script>

<style scoped>

</style>
