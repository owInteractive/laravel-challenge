<template>
    <div class="sidebar-component">

        <div class="panel panel-default">
            <div class="panel-heading">Welcome back, {{user.name}}</div>

            <div class="panel-body">

                <div class="list-group">
                    <a href="/" class="list-group-item">My Events</a>
                    <a href="/create" class="list-group-item">New Event</a>
                    <a href="/account" class="list-group-item">My Account</a>
                    <a href="javascript:;" class="list-group-item list-group-item-danger" @click="logout">Logout</a>
                </div>

            </div>
        </div>
    </div>

</template>

<script>

    export default {

        data() {
            return {

                user: {
                    id: localStorage.getItem('user.id'),
                    name: localStorage.getItem('user.name'),
                }


            }
        },

        methods: {

            logout() {
                window.localStorage.clear();
                this.$emit('logout');
            }
        },

    }

</script>

<style>


</style>