<template>

    <div class="today-component">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>
                        <a v-bind:href="linkDownloadCsv" class="btn btn-sm btn-primary pull-left">Export</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <event-component v-for="event in events" :key="event.id" :event="event" @delete="remove"></event-component>
            </tbody>
        </table>
    </div>

</template>


<script>

    import EventComponent from "./Event.vue";

    export default {

        data() {
            return {
                events: [],
                linkDownloadCsv: "/api/users/"+localStorage.getItem('user.id')+"/export?when=today",
            }
        },

        methods: {

            getEvents() {
                axios.get('/api/users/'+localStorage.getItem('user.id')+'/events?when=today').then(
                    response => {
                        response.data.data.forEach(event =>{
                            this.events.push(event)
                        })
                    }
                )
            },
            remove(id) {
                if (confirm('Are you sure you want to delete this event?')) {
                    axios.delete('/api/users/'+localStorage.getItem('user.id')+'/events/'+id).then(
                        response => {
                            let index = this.events.findIndex(task => task.id === id);
                            this.events.splice(index, 1);
                        }
                    )
                    .catch(error => {
                        console.log(error);
                    })
                }
            }
        },

        props: [
            'event',
        ],

        created() {
            this.getEvents();
        },

        components: {
            EventComponent
        }
    }


</script>


<style>



</style>