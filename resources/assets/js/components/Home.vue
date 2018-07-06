<template>

    <div class="row home-component">

        <div class="col-md-3">
            <profile-menu></profile-menu>
        </div>

        <div class="col-md-9">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#today" aria-controls="today" role="tab" data-toggle="tab">Today</a></li>
                <li role="presentation"><a href="#next5" aria-controls="next5" role="tab" data-toggle="tab">Next 5 days</a></li>
                <li role="presentation"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">All events</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="today">
                    <today></today>
                </div>
                <div role="tabpanel" class="tab-pane" id="next5">
                    <week></week>
                </div>
                <div role="tabpanel" class="tab-pane" id="all">
                    <month></month>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    import ProfileMenu from "./Menu.vue"
    import Today from "./Today.vue"
    import Week from "./Week.vue"
    import Month from "./Month.vue"

    export default {

        data() {
            return {

            }
        },

        methods: {
            checkUser() {
                if (localStorage.getItem('logged')) {
                    window.location.href = "/login"
                }
            },
        },

        components: {
            ProfileMenu,
            Today,
            Week,
            Month
        },

        beforeCreate() {
            if (!localStorage.getItem('logged')) {
                window.location.href = "/login"
            }
        }

    }

</script>