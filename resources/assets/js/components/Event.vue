<template>

    <tr>
        <td>{{ event.title }}</td>
        <td>{{ event.description }}</td>
        <td>{{ event.start_datetime }}</td>
        <td>{{ event.end_datetime }}</td>
        <td v-if="event.user_id == user.id">
            <!--<button type="button" class="btn btn-sm btn-default" @click="edit">Edit</button>-->
            <button type="button" class="btn btn-sm btn-danger" @click="remove">Delete</button>
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
                errors: []
            }
        },

        methods: {
            remove() {
                this.$emit('delete', this.event.id)
            },
            update() {
                this.$emit('update', this.event)
            }
        },

        props: ['event']
    }


</script>


<style>



</style>