<template>

    <div class="login-component">
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body">

                <div v-if="this.error" class="alert alert-danger" role="alert">{{error}}</div>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="email" class="control-label">E-Mail Address</label>
                        <input id="email" type="email" class="form-control" name="email" v-model="form.username" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input id="password" type="password" class="form-control" name="password" v-model="form.password" required>
                    </div>

                    <div class="form-group">
                        <button @click="login" type="button" class="btn btn-primary pull-left">
                            Login
                        </button>

                        <a class="btn btn-link pull-right" href="/forgot">
                            Forgot My Password
                        </a>
                    </div>

                    <div id="div-or" class="form-group text-center">
                        OR
                    </div>

                    <div class="form-group">
                        <a href="/register" class="btn btn-success btn-block">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script>

    export default {

        data() {
            return {

                form: {
                    grant_type: "password",
                    client_id: "2",
                    client_secret: "Q6VIoJUx8FZqfwfsQEf6WLVGJsefSONtrkY9X5np",
                    username: "",
                    password: "",
                },

                error: "",

            }
        },

        methods: {

            login() {

                axios.post('/oauth/token', this.form).then(
                    response => {

                        let access_token = response.data.access_token;
                        let token_type = response.data.token_type;

                        localStorage.setItem('Authorization', token_type + " " + access_token);

                        this.$emit('login');
                    },
                    error => {
                        this.error = error.message
                    });
            }
        }

    }


</script>

<style>
    #div-or {
        margin: 20px;
    }


</style>