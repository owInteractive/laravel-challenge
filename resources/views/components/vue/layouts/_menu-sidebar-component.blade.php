<menu-sidebar-component :items="{{json_encode($items)}}"/>

@push('scripts')
    <script id="menu-sidebar-template" type="text/x-template">
        <v-list dense>
            <v-list-item link v-for="(item,key) in items" :key="key">
                <v-list-item-action>
                    <v-icon>@{{ item.icon }}</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>@{{ item.text }}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </script>
@endpush
