<template>
    <div class="profile">
        <div class="logout">
            <a href="/logout" @click.prevent="logout">
                <span class="fa fa-bell-o">Logout</span>
            </a>

            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                <input type="hidden" name="_token" :value="csrf">
            </form>
        </div>
        <img class="user-avatar" src="/images/users/avatar.png" alt="">
        <p class="profile-info margin-fix" id="profile-name">
            {{user.name}}
        </p>
        <p class="profile-info margin-fix" id="profile-email">
            {{user.email}}
        </p>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        methods: {
            logout() {
                document.getElementById('logout-form').submit();
            }
        }
    }
</script>

<style scoped>

</style>
