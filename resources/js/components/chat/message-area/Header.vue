<template>
    <div class="custom-header">
        <div id="responsive-header-menu">
            <h3 class="float-left margin-fix">Chats</h3>
            <h3 class="float-right">
                <div class="hamburger" @click="menuToggle()">
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                </div>
            </h3>
            <div class="clearfix"></div>
        </div>
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
        data() {
            return {
                toggle: false
            }
        },
        methods: {
            menuToggle() {
                this.toggle = !this.toggle;
                this.$emit('menuToggled', this.toggle);
            }
        }
    }
</script>

<style scoped>

</style>
