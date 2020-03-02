<!DOCTYPE html>
<html xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>
<body>
<div id="app">
    <v-app id="inspire">
        @include('components.vue.layouts.toolbar-component')
        @include('components.vue.layouts.sidebar-component',[
            'user' => $metadata->user,
            'app_name' => $metadata->app_name
        ])
        <v-content>
            <v-expand-transition>
                <v-card
                        v-show="$store.state.AppStore.showAlert"
                        class="mx-auto"
                >
                    <v-alert dismissible
                             :type="$store.state.AppStore.statusAlert ? $store.state.AppStore.statusAlert : 'info'">
                        @{{ $store.state.AppStore.messageAlert }}
                    </v-alert>
                </v-card>
            </v-expand-transition>
            @yield('content')
        </v-content>
    </v-app>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
<script src="https://unpkg.com/vuex@2.0.0"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
@stack('scripts')
<script src="/js/app.js"></script>
@stack('post-scripts')
</body>
</html>