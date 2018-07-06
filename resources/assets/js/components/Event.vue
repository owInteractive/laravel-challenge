<template>

    <tr>
        <td>{{ event.title }}</td>
        <td>{{ event.description }}</td>
        <td>{{ event.start_datetime }}</td>
        <td>{{ event.end_datetime }}</td>
        <td v-if="event.user_id == user.id">
            <button class="btn btn-default">Edit</button>
            <button type="button" class="btn btn-danger" @click="remove">Delete</button>
        </td>
    </tr>

</template>


<script>

    export default {

        data() {
            return {
                user: {
                    id: localStorage.getItem('user.id'),
                },
            }
        },

        methods: {
            remove() {
                this.$emit('delete', this.event.id)
            }
        },

        props: ['event']
    }


</script>


<style>



</style>