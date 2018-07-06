<template>

    <div class="new-event-component">
        <div v-if="message" class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ message }}
        </div>
        <div v-if="error" class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ error }}
        </div>

        <form>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" v-model="event.title" autofocus>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" v-model="event.description">
            </div>
            <div class="form-group">
                <label for="start_datetime">Start Datetime</label>
                <input type="datetime-local" class="form-control" id="start_datetime" v-model="event.start_datetime">
            </div>
            <div class="form-group">
                <label for="end_datetime">End Datetime</label>
                <input type="datetime-local" class="form-control" id="end_datetime" v-model="event.end_datetime">
            </div>
            <div class="col-xs-6 col-xs-push-3">
                <button type="button" class="btn btn-primary btn-block" @click="save">Create Event</button>
            </div>
        </form>
    </div>

</template>

<script>

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
                error: "",
            }
        },

        methods: {

            save() {
                axios.post('/api/users/'+localStorage.getItem('user.id')+'/events', this.event).then(
                    response => {
                        this.message = "Event has been created!";
                    },
                    response => {
                        this.error = response.message;
                    }
                )
            }

        }
    }

</script>


<style>

</style>