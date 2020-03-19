<template>
    <div class="row reset-row">
        <input class="form-control" id="search-field" type="text" placeholder="Type to search."
               v-model="search" @keyup="searchContacts()">
        <div class="switch-buttons">
            <button class="btn btn-sm" id="contacts-switch-button" @click="switchComponent()">Contacts</button>
            <button class="btn btn-sm" id="conversation-switch-button" @click="switchComponent()">Conversations</button>
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
                let search = false;
                search = this.search.length > 0;
                this.$emit('searchStarted', search);
                // if (!this.contacts) {
                //     console.log('please let the contacts load, thanks');
                //     return;
                // }
                // // perform search
                // let contacts = this.contacts.filter(contact => {
                //     return contact.name.toLowerCase().includes(this.search.toLowerCase())
                // });
                //
                // console.log(contacts)
            }
        }
    }
</script>

<style scoped>

</style>
