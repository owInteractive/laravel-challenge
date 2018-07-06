<template>

    <div class="col-md-3">
        <menu-component v-if="user.logged" @logout="logout"></menu-component>
        <login-component v-else @login="checkStorage"></login-component>
    </div>

</template>


<script>

    import LoginComponent from "./Login.vue"
    import MenuComponent from "./Menu.vue"

    export default {

        data() {
            return {

                user: {
                    logged: localStorage.getItem('logged'),
                    name: "",
                    email: ""
                },

                events: [],

                error: ""

            }
        },

        methods: {

            checkStorage() {
                if (localStorage.getItem('Authorization') != null) {
                    axios.defaults.headers.common['Authorization'] = localStorage.getItem('Authorization');
                    this.getUser();
                }

            },

            getUser() {
                axios.get('/api/user').then(
                    response => {
                        this.user.logged = true;
                        this.user.id = response.data.id;
                        this.user.name = response.data.name;
                        this.user.email = response.data.email;
                        localStorage.setItem('logged', true);
                        localStorage.setItem('user.id', this.user.id);
                        localStorage.setItem('user.name', this.user.name);
                    },
                    response => {
                        this.error = response.message;
                    })
            },

            logout() {
                this.user.logged = false;
                this.user.name = "";
                this.user.email = "";
            }

        },

        created() {
            this.checkStorage();
        },

        components: {
            MenuComponent,
            LoginComponent,
        }
    }


</script>

<style>

</style>