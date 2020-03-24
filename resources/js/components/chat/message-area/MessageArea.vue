<template>

    <div class="row reset-row">
        <messages-header :user="user" @menuToggled="menuToggled($event)">

        </messages-header>
        <messages :user="user">

        </messages>
        <messages-footer :user="user">

        </messages-footer>
    </div>
</template>

<script>
    export default {
        props: ['user', 'chats'],
        data: function () {
            return {}
        },
        methods: {
            menuToggled: function (toggle) {
                this.$emit('menuToggled', toggle)
            }
        },
        updated() {
        }
    }
</script>

<style scoped>

</style>
