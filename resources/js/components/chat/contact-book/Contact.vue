<template>
    <div>
        <div class="contact" v-for="contact in performSearch" :key="contact.id"
             @click="[getChat(contact.id), selectUser(contact)]">
            <p class="margin-fix contact-name">
                {{contact.name}}
            </p>
            <p class="margin-fix contact-email">
                {{contact.email}}
            </p>
        </div>
    </div>

</template>

<script>
    export default {
        props: [
            'contacts',
            'query'
        ],
        data() {
            return {
                searchResults: ''
            }
        },
        computed: {
            performSearch() {
                let contacts = '';
                if (!this.searchResults) {
                    console.log('contacts are not loaded yet.');
                    return;
                }
                // perform search
                contacts = this.searchResults.filter(contact => {
                    return contact.name.toLowerCase().includes(this.query.toLowerCase())
                });
                return contacts;
            }
        },
        watch: {
            contacts(contacts) {
                this.searchResults = contacts;
            }
        },
        methods: {
            getChat(id) {
                this.$store.dispatch('setChat', id);
            },
            selectUser(user) {
                this.$emit('newUserSelected', user);
            },
        }
    }
</script>

<style scoped>

</style>
