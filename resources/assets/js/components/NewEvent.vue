<template>

    <div class="row new-event-component">

        <div class="col-md-3">
            <profile-menu></profile-menu>
        </div>

        <div class="col-md-6 col-md-push-2">
            <h4 class="text-center">Create a new event here!</h4>

            <div v-if="message" class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ message }}
            </div>

            <form>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" v-model="event.title" autofocus>

                    <span v-if="errors['title']" class="help-block">
                    <strong>{{ errors['title'] }}</strong>
                </span>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" v-model="event.description">

                    <span v-if="errors['description']" class="help-block">
                    <strong>{{ errors['description'] }}</strong>
                </span>
                </div>
                <div class="form-group">
                    <label for="start_datetime">Start Datetime</label>
                    <input type="datetime-local" class="form-control" id="start_datetime" v-model="event.start_datetime">

                    <span v-if="errors['start_datetime']" class="help-block">
                    <strong>{{ errors['start_datetime'] }}</strong>
                </span>
                </div>
                <div class="form-group">
                    <label for="end_datetime">End Datetime</label>
                    <input type="datetime-local" class="form-control" id="end_datetime" v-model="event.end_datetime">

                    <span v-if="errors['end_datetime']" class="help-block">
                    <strong>{{ errors['end_datetime'] }}</strong>
                </span>
                </div>
                <div class="col-xs-6 col-xs-push-3">
                    <button type="button" class="btn btn-primary btn-block" @click="save">Create Event</button>
                </div>
            </form>
        </div>

    </div>

</template>

<script>

    import ProfileMenu from "./Menu.vue"

    export default {

        data() {
            return {
                event: {
                    title: "",
                    description: "",
                    start_datetime: "",
                    end_datetime: "",
                },

                message: "",
                errors: [],
            }
        },

        methods: {

            save() {
                axios.post('/api/users/'+localStorage.getItem('user.id')+'/events', this.event).then(
                    response => {
                        this.message = "Event has been created!";
                        this.event.title = "";
                        this.event.description = "";
                        this.event.start_datetime = "";
                        this.event.end_datetime = "";
                    })
                    .catch(error => {
                        this.errors = error.response.data.error;
                    });
            }

        },
        components: {
            ProfileMenu
        }
    }

</script>


<style>

</style>