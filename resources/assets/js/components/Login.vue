<template>

    <div class="row register-component">
        <div class="col-md-6 col-md-offset-3">
            <div class="login-component">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">

                        <div v-if="this.error" class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{error}}
                        </div>

                        <form>
                            <div class="form-group">
                                <label for="email" class="control-label">E-Mail Address</label>
                                <input id="email" type="email" class="form-control" name="email" v-model="form.username" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password" v-model="form.password" required>
                            </div>

                            <div class="form-group">
                                <button @click="login" type="button" class="btn btn-primary">
                                    Login
                                </button>

                                <!--<a class="btn btn-link pull-right" href="/forgot">-->
                                    <!--Forgot My Password-->
                                <!--</a>-->
                            </div>

                            <div id="div-or" class="form-group text-center">
                                <hr>
                                OR
                            </div>

                            <div class="form-group">
                                <div class="col-xs-6 col-xs-push-3">
                                    <a href="/register" class="btn btn-success btn-block">Sign Up</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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

                        if (localStorage.getItem('Authorization') != null) {
                            axios.defaults.headers.common['Authorization'] = localStorage.getItem('Authorization');
                            axios.get('/api/user').then(
                                response => {
                                    localStorage.setItem('logged', true);
                                    localStorage.setItem('user.id', response.data.id);
                                    localStorage.setItem('user.name', response.data.name);
                                    localStorage.setItem('user.email', response.data.email);
                                    window.location.href = "/"
                                });
                        }
                    })
                    .catch(error => {
                        this.error = error.response.data.message;
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