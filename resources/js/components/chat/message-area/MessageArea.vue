<template>

    <div class="row reset-row">
        <messages-header :user="user">

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
        updated() {
        }
    }
</script>

<style scoped>

</style>
