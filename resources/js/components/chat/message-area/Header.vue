<template>
    <div class="custom-header">
        <div id="header-name-container">
            <p class="margin-fix" id="header-name">
                {{user.name}}
            </p>
        </div>
        <div id="header-email-container">

            <p class="margin-fix" id="header-email">
                {{user.email}}
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
    }
</script>

<style scoped>

</style>
