<template>
    <div class="reset-container container-fluid">

        <div class="row reset-row">
            <div class="col-md-3 contacts">
                <search></search>

                <div class="contact" v-for="contact in contacts" :key="contact.id" @click="fetchChat(contact.id)">
                    <p class="margin-fix contact-name">
                        {{contact.name}}
                    </p>
                    <p class="margin-fix contact-email">
                        {{contact.email}}
                    </p>
                </div>
            </div>
            <div class="col-md-9">

            </div>
        </div>

    </div>
</template>

<script>

    import {mapState, mapActions} from 'vuex';

    export default {
        data() {
            return {}
        },
        computed: {
            ...mapState([
                'contacts',
                'chats'
            ])
        },
        methods: {
            fetchChat(id) {

            }
        },
        mounted() {
            this.$store.dispatch('fetchContacts');
        }
    }
</script>

<style scoped>

</style>
