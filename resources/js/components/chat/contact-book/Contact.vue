<template>
    <div>
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

</template>

<script>
    export default {
        props: [
            'contacts'
        ],
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
