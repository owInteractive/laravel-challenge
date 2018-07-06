<template>

    <div class="today-component">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Start date</th>
                    <th>End date</th>
                </tr>
            </thead>
            <tbody>
                <event-component v-for="event in events" :key="event.id" :event="event"></event-component>
            </tbody>
        </table>
    </div>

</template>


<script>

    import EventComponent from "./Event.vue";

    export default {

        data() {
            return {
                events: [
                    {id: 1, title: "Titulo 1 ", description: "Descricao 1", start_datetime: "2018-12-31 10:50:00", end_datetime: "2018-12-31 15:50:00"},
                    {id: 1, title: "Titulo 2", description: "Descricao 2", start_datetime: "2018-12-31 10:50:00", end_datetime: "2018-12-31 15:50:00"},
                    {id: 1, title: "Titulo 3", description: "Descricao 3", start_datetime: "2018-12-31 10:50:00", end_datetime: "2018-12-31 15:50:00"},
                    {id: 1, title: "Titulo 4", description: "Descricao 4", start_datetime: "2018-12-31 10:50:00", end_datetime: "2018-12-31 15:50:00"},
                ]
            }
        },

        components: {
            EventComponent
        }
    }


</script>


<style>



</style>