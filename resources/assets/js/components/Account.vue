<template>

    <div class="row new-event-component">

        <div class="col-md-3">
            <profile-menu></profile-menu>
        </div>

        <div class="col-md-9">
            <div v-if="message" class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ message }}
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Update your profile</div>
                <div class="panel-body">
                    <form>
                        <div class="form-group">
                            <label for="name" class="control-label">Name</label>
                            <input id="name" type="text" class="form-control" name="name" v-model="form.name" required autofocus>

                            <span v-if="errors['name']" class="help-block">
                                <strong>{{ errors['name'] }}</strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="email" class="control-label">Email</label>
                            <input id="email" type="email" class="form-control" name="email" v-model="form.email" required autofocus>

                            <span v-if="errors['email']" class="help-block">
                                <strong>{{ errors['email'] }}</strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="password" class="control-label">Password</label>
                            <input id="password" type="password" class="form-control" name="password" v-model="form.password" required>
                            <span v-if="errors['password']" class="help-block">
                                <strong>{{ errors['password'] }}</strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="control-label">Password Confirmation</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" v-model="form.password_confirmation" required>

                            <span v-if="errors['password_confirmation']" class="help-block">
                                <strong>{{ errors['password_confirmation'] }}</strong>
                            </span>
                        </div>



                        <div class="form-group">
                            <div class="col-xs-6 col-xs-push-3">
                                <button type="button" class="btn btn-primary btn-block" @click="update">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    import ProfileMenu from "./Menu.vue"

    export default {
        data() {
            return {
                form: {
                    name: localStorage.getItem('user.name'),
                    email: localStorage.getItem('user.email'),
                    password: "",
                    password_confirmation: "",
                },

                message: "",

                errors: [],

            }
        },
        methods: {
            update() {
                axios.put('/api/users/'+localStorage.getItem('user.id'), this.form).then(
                    response => {
                        this.message = "User has been successfully updated!";

                        localStorage.setItem('logged', true);
                        localStorage.setItem('user.name', this.form.name);
                        localStorage.setItem('user.email', this.form.email);

                        this.form.password = "";
                        this.form.password_confirmation = "";
                    })
                    .catch(error => {
                        this.errors =  error.response.data.error;
                    });

            },
        },
        components: {
            ProfileMenu
        }
    }
</script>

<style>

</style>