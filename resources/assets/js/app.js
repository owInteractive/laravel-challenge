AppStore = {
    state: {
        drawer: null,
        showAlert: false,
        messageAlert: '',
        statusAlert: ''
    }
}


Vue.component('toolbar-header-component', {
    template: '#toolbar-header-template',
    data() {
        return this.$store.state.AppStore
    }
})

Vue.component('sidebar-component', {
    template: '#sidebar-template',
    data() {
        return this.$store.state.AppStore
    }
})

Vue.component('menu-sidebar-component', {
    template: '#menu-sidebar-template',
    props:['items']
})


store = new Vuex.Store({
    modules: {
        AppStore,
        EventStore
    }
})


new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    store,
})


URI_EVENTS = '/api/events'