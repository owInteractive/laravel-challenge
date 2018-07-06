<template>

    <tr>
        <td>{{ event.id }}</td>
        <td>{{ event.title }}</td>
        <td>{{ event.description }}</td>
        <td>{{ event.start_datetime }}</td>
        <td>{{ event.end_datetime }}</td>
    </tr>

</template>


<script>

    export default {

        data() {
            return {

            }
        },
        props: ['event']
    }


</script>


<style>



</style>