<toolbar-header-component></toolbar-header-component>

@push('scripts')
    <script id="toolbar-header-template" type="text/x-template">
        <v-app-bar
                app
                color="deep-purple darken-4"
                dark
        >
            <div>
                <v-app-bar-nav-icon @click.stop="drawer = !drawer"/>
            </div>
            <v-toolbar-title>Events</v-toolbar-title>
        </v-app-bar>
    </script>
@endpush
