<template>
    <div class="row reset-row">
        <input class="form-control" id="search-field" type="text" placeholder="Type to search.">
        <div class="switch-buttons">
            <button class="btn btn-sm" id="contacts-switch-button" @click="switchComponent()">Contacts</button>
            <button class="btn btn-sm" id="conversation-switch-button" @click="switchComponent()">Conversations</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['showConversation'],
        methods: {
            switchComponent() {
                let conversation = !this.showConversation;
                this.$emit('newConversation', conversation);
            }
        }
    }
</script>

<style scoped>

</style>
