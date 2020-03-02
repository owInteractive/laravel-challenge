<sidebar-component></sidebar-component>

@push('scripts')
    <script id="sidebar-template" type="text/x-template">
        <v-navigation-drawer
                v-model="drawer"
                app
                width="360"
        >
            <v-card flat tile color="deep-purple darken-4">
                <v-card-title class="font-weight-regular white--text">{{$app_name}}</v-card-title>
                <v-card-text>
                    <v-row>
                        <v-col cols="3">
                            <v-avatar size="62" color="grey"></v-avatar>
                        </v-col>
                        <v-col cols="9">
                            <v-flex class="font-weight-medium white--text pt-2">{{$user->name}}</v-flex>
                            <v-flex class="font-italic white--text">{{$user->email}}</v-flex>
                        </v-col>
                    </v-row>
                </v-card-text>
                <v-divider></v-divider>
            </v-card>
            @include('components.vue.layouts._menu-sidebar-component',[
                'items' => $metadata->menus
            ])
            <v-footer fixed class="pa-0">
                <v-list width="100%" class="pa-0">
                    <v-list-item link class="py-3">
                        <v-list-item-action>
                            <v-icon>mdi-logout</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Logout</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </v-footer>
        </v-navigation-drawer>
    </script>
@endpush
