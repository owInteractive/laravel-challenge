/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */,
/* 1 */,
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(3);


/***/ }),
/* 3 */
/***/ (function(module, exports) {

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
            endTime: ''
        },
        isNewEvent: false,
        rulesTitle: [function (value) {
            return !!value || 'Required.';
        }, function (value) {
            return value && value.length >= 3 || 'Min 3 characters';
        }],
        events: []
    },
    getters: {},
    mutations: {
        mutateEvents: function mutateEvents(state, data) {
            state.events = data;
        }
    },
    actions: {
        updateEvents: function updateEvents(_ref, data) {
            var state = _ref.state,
                commit = _ref.commit;

            if (data) {
                return commit('mutateEvents', data);
            }
        }
    }
};

EventComponent = Vue.extend({
    data: function data() {
        return this.$store.state.EventStore;
    },

    methods: {
        getDay: function getDay(data) {
            return data ? new Date(data).toDateString().split(' ')[2] : null;
        },
        getMonth: function getMonth(data) {
            return data ? new Date(data).toDateString().split(' ')[1] : null;
        },
        getYear: function getYear(data) {
            return data ? new Date(data).toDateString().split(' ')[3] : null;
        },
        getTime: function getTime(data) {
            return data ? new Date(data).toTimeString().split(' ')[0].substring(5, 0) : null;
        },
        getWeek: function getWeek(data) {
            var weeks = {
                Sun: 'sunday',
                Mon: 'monday',
                Tue: 'tuesday',
                Wed: 'wednesday',
                Thu: 'thursday',
                Fri: 'friday',
                Sat: 'saturday'
            };
            return data ? weeks[new Date(data).toGMTString().replace(',', '').split(' ')[0]] : null;
        },
        notify: function notify(type, message, callback) {
            var _this = this;

            var duration = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 8000;

            this.$store.state.AppStore.messageAlert = message;
            this.$store.state.AppStore.statusAlert = type;
            this.$store.state.AppStore.showAlert = true;
            if (callback instanceof Function) callback();
            setTimeout(function () {
                _this.$store.state.AppStore.showAlert = false;
            }, duration);
        },
        resetContext: function resetContext() {
            Object.assign(this.eventData, {
                title: '',
                description: '',
                start_datetime: '',
                end_datetime: '',
                startDate: '',
                endDate: '',
                startTime: '',
                endTime: ''
            });
        }
    }
});

Vue.component('filter-panel-component', {
    template: '#filter-panel-template',
    extends: EventComponent,
    methods: {
        onSave: function onSave() {
            var _this2 = this;

            this.$http.post(URI_EVENTS, this.prepareEventData()).then(function (res) {
                _this2.notify('success', 'Save success', function () {
                    _this2.isNewEvent = false;
                    _this2.resetContext();
                });
            }, function (err) {
                _this2.notify('error', 'Something error occurred, try again');
                console.error(err);
            });
        },
        onCancel: function onCancel() {
            this.isNewEvent = false;
        },
        prepareEventData: function prepareEventData() {
            this.eventData.start_datetime = this.eventData.startDate + ' ' + this.eventData.startTime;
            this.eventData.end_datetime = this.eventData.endDate + ' ' + this.eventData.endTime;
            return this.eventData;
        }
    }
});

Vue.component('event-component', {
    template: '#event-template',
    extends: EventComponent
});

Vue.component('event-item-component', {
    template: '#event-item-template',
    extends: EventComponent,
    props: ['event']
});

Vue.component('new-event-item-component', {
    template: '#new-event-item-template',
    extends: EventComponent,
    data: function data() {
        return {
            modalStartDate: false,
            modalEndDate: false,
            modalStartTime: false,
            modalEndTime: false
        };
    }
});

/***/ })
/******/ ]);