EventStore = {
    state: {
        eventData: {
            title: '',
            description: '',
            start_datetime: '',
            end_datetime: '',
            startDate: '',
            endDate: '',
            startTime: '',
            endTime: '',
        },
        isNewEvent: false,
        rulesTitle: [
            value => !!value || 'Required.',
            value => (value && value.length >= 3) || 'Min 3 characters',
        ],
        events: []
    },
    getters: {},
    mutations: {
        mutateEvents(state, data) {
            state.events = data;
        }
    },
    actions: {
        updateEvents({state, commit}, data) {
            if (data) {
                return commit('mutateEvents', data)
            }
        }
    }
}


EventComponent = Vue.extend({
    data() {
        return this.$store.state.EventStore
    },
    methods: {
        getDay(data) {
            return data ? new Date(data).toDateString().split(' ')[2] : null
        },
        getMonth(data) {
            return data ? new Date(data).toDateString().split(' ')[1] : null
        },
        getYear(data) {
            return data ? new Date(data).toDateString().split(' ')[3] : null
        },
        getTime(data) {
            return data ? new Date(data).toTimeString().split(' ')[0].substring(5, 0) : null
        },
        getWeek(data) {
            const weeks = {
                Sun: 'sunday',
                Mon: 'monday',
                Tue: 'tuesday',
                Wed: 'wednesday',
                Thu: 'thursday',
                Fri: 'friday',
                Sat: 'saturday'
            }
            return data ? weeks[new Date(data).toGMTString().replace(',', '').split(' ')[0]] : null
        },
        notify(type, message, callback, duration = 8000) {
            this.$store.state.AppStore.messageAlert = message
            this.$store.state.AppStore.statusAlert = type;
            this.$store.state.AppStore.showAlert = true;
            if (callback instanceof Function) callback();
            setTimeout(() => {
                this.$store.state.AppStore.showAlert = false
            }, duration)
        },
        resetContext() {
            Object.assign(this.eventData, {
                title: '',
                description: '',
                start_datetime: '',
                end_datetime: '',
                startDate: '',
                endDate: '',
                startTime: '',
                endTime: '',
            })
        }
    }
})

Vue.component('filter-panel-component', {
    template: '#filter-panel-template',
    extends: EventComponent,
    methods: {
        onSave() {
            this.$http.post(URI_EVENTS, this.prepareEventData())
                .then(res => {
                    this.notify('success', 'Save success', () => {
                        this.isNewEvent = false;
                        this.resetContext();
                    });
                }, err => {
                    this.notify('error', 'Something error occurred, try again');
                    console.error(err)
                })
        },
        onCancel() {
            this.isNewEvent = false;
        },
        prepareEventData() {
            this.eventData.start_datetime = this.eventData.startDate + ' ' + this.eventData.startTime
            this.eventData.end_datetime = this.eventData.endDate + ' ' + this.eventData.endTime
            return this.eventData
        }
    }
})


Vue.component('event-component', {
    template: '#event-template',
    extends: EventComponent
})

Vue.component('event-item-component', {
    template: '#event-item-template',
    extends: EventComponent,
    props: ['event'],
})


Vue.component('new-event-item-component', {
    template: '#new-event-item-template',
    extends: EventComponent,
    data() {
        return {
            modalStartDate: false,
            modalEndDate: false,
            modalStartTime: false,
            modalEndTime: false,
        }
    }
})


