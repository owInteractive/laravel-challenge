<template>
    <div class="w-full">
        <div class="flex items-start w-full">
            <div class="bg-white w-9/12 rounded border-t-2 border-blue-600 shadow max-h-screen overflow-auto">

                <div class="spinner w-full mx-auto" v-if="loading === true">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>

                <h3 v-if="(date_initial && date_finish) && loading === false"
                    class="text-lg pl-5 pt-5 font-semibold text-gray-800 mb-2">
                    {{moment(date_initial).format('MMMM DD')}} to {{moment(date_finish).format('MMMM DD, of YYYY')}}
                </h3>

                <h3 v-if="(date) && loading === false"
                    class="text-lg pl-5 pt-5 font-semibold text-gray-800 mb-2">
                    {{moment(date).format('MMMM DD, YYYY')}}
                </h3>

                <div class="inline-block w-full hover:bg-gray-200 border-b-2 p-5 flex justify-between cursor-pointer"
                     v-for="(event, index) in events.data"
                     @click="toggleModal(event)"
                     v-if="loading === false">
                    <div class="pt-2">
                        <p class="text-base text-gray-700 font-medium" v-if="date === null">
                            {{moment(event.starts_at).format('dddd, MMMM DD')}}
                        </p>
                        <span class="text-gray-700">{{moment(event.starts_at).format('HH:mm A')}}</span>
                        <span class="text-gray-700">to</span>
                        <span class="text-gray-700">{{moment(event.ends_in).format('HH:mm A')}}</span>
                        <span class="text-base ml-10 text-blue-600">{{event.title}}</span>
                        <span class="block text-sm text-gray-700 pt-2">Description: {{event.description}}</span>
                    </div>
                </div>

                <div v-if="events.data < 1 && loading === false" class="text-blue-600 p-5">
                    <span>No events registered for the indicated period.</span>
                </div>

                <div class="w-full my-3 flex justify-center" v-if="last_page > 1">
                    <a href="javascript.void(0)" v-for="n in last_page" class="p-2 mx-1 rounded text-white bg-blue-600"
                       v-bind:class="n === page ? ' cursor-not-allowed bg-gray-800' : ''"
                       v-on:click.prevent="toPage(n)">{{n}}</a>
                </div>
            </div>


            <div class="flex justify-center mx-5 w-3/12">
                <v-date-picker :is-inline="true" @dayclick="clickDay" @update:fromPage="pageChange" locale="en"
                               v-model="date"/>
            </div>

            <v-modal :open="showModal" @close="toggleModal" class="text-gray-700">
                <p class="mb-2"><span class="font-bold">Title: </span>{{event.title}}</p>
                <p class="mb-2"><span class="font-bold">Description: </span>{{event.description}}</p>
                <p class="mb-2"><span class="font-bold">Start At: </span>{{event.starts_at}}</p>
                <p class="mb-4"><span class="font-bold">Ends In: </span>{{event.ends_in}}</p>
                <div class="mb-4"><span class="font-bold">Invites: </span><p class="block" v-for="invite in event.invitations"><span class="font-bold text-gray-600">{{invite.email}}</span>: {{invite.confirm ? 'Confirmed' : 'Did not confirm'}}</p></div>
                <a class="py-2 px-3 bg-gray-600 text-white rounded cursor-pointer"
                   @click="toggleInvitationModal(event)"><i class="fas fa-share pr-2"></i>Invite Friends</a>
                <a class="py-2 px-3 bg-gray-600 text-white rounded cursor-pointer"
                   :href="`/app/events/${event.id}/edit`">Edit</a>
                <a class="py-2 px-3 bg-red-600 text-white rounded cursor-pointer"
                   @click="deleteEvent(event.id)">Delete</a>
            </v-modal>

            <v-modal :open="showInvitationModal" @close="toggleInvitationModal" class="text-gray-700">
                <h3 class="text-lg font-bold mb-2">Invite Friends</h3>
                <p class="mb-2"><span class="font-bold">Event: </span>{{event.title}}</p>

                <div>
                    <form :action="`/app/events/${event.id}/invite`" method="post">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="hidden" name="emails" :value="friends">
                        <input pattern="/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               :class="hasFriend() || invalidEmail ? 'border-red-600' : ''"
                               v-model="friend">
                        <p class="text-sm text-red-600" v-if="hasFriend()">The informed email is already in the current
                            mailing list.</p>
                        <p class="text-sm text-red-600" v-if="invalidEmail">The informed email is invalid.</p>
                        <p class="text-sm mt-1">Friends: <span v-for="friend in friends">{{friend}} </span></p>
                        <button class="py-2 px-3 bg-gray-600 text-white rounded cursor-pointer mt-2"
                                @click.prevent="addFriend(friend)" :disabled="hasFriend()"
                                :class="hasFriend() ? 'cursor-not-allowed' : ''">Add
                        </button>

                        <button class="py-2 px-3 bg-gray-600 text-white rounded cursor-pointer mt-2">Invite</button>
                    </form>
                </div>
            </v-modal>
        </div>
    </div>
</template>

<script>
    import {RepositoryFactory} from './../../repositories/RepositoryFactory';
    import {DatePicker} from "v-calendar";
    import moment from 'moment';

    const EventsRepository = RepositoryFactory.get('events');

    export default {
        name: "Events",
        components: {DatePicker},
        data: () => {
            return {
                date: null,
                month: null,
                year: null,
                events: [],
                event: {},
                loading: false,
                last_page: 1,
                current_page: 1,
                page: 1,
                date_initial: null,
                date_finish: null,
                showModal: false,
                showInvitationModal: false,
                friend: null,
                friends: [],
                invalidEmail: false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },

        methods: {
            async fetch() {
                this.loading = true;

                const {data} = await EventsRepository.get({
                    params: {
                        page: this.page,
                        month: this.month,
                        year: this.year,
                        date: this.date,
                    }
                });

                if (typeof data.data.data === 'undefined') {
                    this.events = data;
                } else {
                    this.events = data.data;
                    this.from = this.events.from;
                    this.current_page = this.events.current_page;
                    this.last_page = this.events.last_page;
                    this.date_initial = data.dateInitial;
                    this.date_finish = data.dateFinish;
                }

                this.loading = false;

            },

            toggleModal(event = {}) {
                this.event = event;
                this.showModal = !this.showModal;
            },

            toggleInvitationModal(event = {}) {
                this.event = event;
                this.showInvitationModal = !this.showInvitationModal;
                this.showModal = false;
                this.friend = null;
                this.friends = [];
                this.invalidEmail = false;
            },

            async deleteEvent(eventId) {
                const {data} = await EventsRepository.deleteEvent(eventId);
                this.toggleModal();
                alertify.success(`${data.success}`);

                await this.fetch();
            },

            moment: moment,

            pageChange(obj) {
                this.clearDataFilter();

                this.month = obj.month;
                this.year = obj.year;

                this.fetch();
            },

            clearDataFilter() {
                this.date = null;
                this.month = null;
                this.year = null;
                this.last_page = 1;
                this.current_page = 1;
                this.page = 1;
                this.date_initial = null;
                this.date_finish = null;
            },

            clickDay(obj) {
                this.clearDataFilter();

                this.date = moment(obj.date).format('YYYY-MM-DD');

                this.fetch();
            },

            addFriend(email) {
                if (this.validateEmail(email)) {
                    if (this.hasFriend() === false) {
                        this.friends.push(email.toLowerCase());
                        this.friend = null;
                        this.invalidEmail = false;
                    }
                } else {
                    this.invalidEmail = true;
                }
            },

            hasFriend() {
                return this.friends.indexOf(String(this.friend).toLowerCase()) > -1;
            },

            validateEmail(email) {
                let re = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
                return re.test(email.toLowerCase())
            },

            toPage(p) {
                if (this.page !== p) {
                    this.page = p;
                    this.fetch();
                }
            },
        }
    }
</script>

<style scoped>

</style>