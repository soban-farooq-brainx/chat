<template>
    <div>
        <div class="contact" v-for="(contact,index) in performSearch"
             :class="[index === 0 ? 'active': '']"
             :key="contact.id"
             @click="[getChat(contact.id), selectUser(contact), addActiveClass(index)]"
        >
            <span :class="[unread(contact) ? 'unread' : '']"></span>
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
            addActiveClass(index) {
                let elements = [...document.querySelectorAll('.contact')];
                elements.forEach(element => {
                    element.classList.remove('active');
                });
                elements[index].classList.add('active');
            },
            unread(contact) {
                if (contact.messages.length > 0) {
                    return contact.messages[0].is_read === 0;
                }
            },
        }
    }
</script>

<style scoped>

</style>
