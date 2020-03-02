<event-item-component v-for="(event,key) in events" :key="key" :event="event"/>

@push('scripts')
    <script id="event-item-template" type="text/x-template">
        <v-col cols="12" xs="12" sm="6" md="6">
            <v-card>
                <div class="d-flex flex-row justify-space-between m-0 px-2">
                    <h2 class="font-weight-medium text--primary pt-3 pl-3 text-truncate">
                        @{{ event.title }}
                    </h2>
                    {{--menu actions--}}
                    <v-menu bottom left offset-y>
                        <template v-slot:activator="{ on }">
                            <v-btn
                                    dark
                                    icon
                                    v-on="on"
                            >
                                <v-icon class="black--text">mdi-menu-down</v-icon>
                            </v-btn>
                        </template>
                        <v-list>
                            <v-list-item link>
                                <v-list-item-action>
                                    <v-icon>mdi-pencil</v-icon>
                                </v-list-item-action>
                                <v-list-item-content>
                                    <v-list-item-title>Edit</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item link>
                                <v-list-item-action>
                                    <v-icon>mdi-cancel</v-icon>
                                </v-list-item-action>
                                <v-list-item-content>
                                    <v-list-item-title>Cancel</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                </div>
                <v-card-text class="text-left">
                    @{{ event.description }}
                </v-card-text>
                {{--date/time--}}
                <div class="d-flex justify-space-around grey lighten-3 pb-5 pt-2">
                    {{--start--}}
                    <div class="d-flex flex-column">
                        <div class="d-flex">
                            <small class="caption">start</small>
                        </div>
                        <div class="d-flex font-weight-medium">
                            <v-icon class="pr-1" size="18">mdi-calendar</v-icon>
                            @{{ this.getDay(event.start_datetime) + ' / ' + this.getMonth(event.start_datetime) }}
                            <span class="px-2">-</span>
                            <v-icon class="pr-1" size="18">mdi-clock-outline</v-icon>
                            @{{ this.getTime(event.start_datetime) }}
                        </div>
                        <div class="d-flex mt-n1 p-0">
                            <small class="caption"> @{{this.getYear(event.start_datetime)}}</small>
                            <small class="px-1 caption">-</small>
                            <small class="caption">@{{  this.getWeek(event.start_datetime) }}</small>
                        </div>
                    </div>
                    {{--end--}}
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-start">
                            <small class="caption">end</small>
                        </div>
                        <div class="d-flex font-weight-medium">
                            <v-icon class="pr-1" size="18">mdi-calendar</v-icon>
                            @{{ this.getDay(event.end_datetime) + ' / ' + this.getMonth(event.end_datetime) }}
                            <span class="px-2">-</span>
                            <v-icon class="pr-1" size="18">mdi-clock-outline</v-icon>
                            @{{ this.getTime(event.end_datetime) }}
                        </div>
                        <div class="d-flex mt-n1 p-0">
                            <small class="caption"> @{{this.getYear(event.end_datetime)}}</small>
                            <small class="px-1 caption">-</small>
                            <small class="caption">@{{  this.getWeek(event.end_datetime) }}</small>
                        </div>
                    </div>
                </div>
{{--                <div class="grey lighten-3 text-left py-1">--}}
{{--                    <v-btn class="ma-2" rounded>--}}
{{--                        <v-icon left>mdi-account-group</v-icon>--}}
{{--                        <small>show inviteds</small>--}}
{{--                    </v-btn>--}}
{{--                    <v-avatar class="" v-show="event.inviteds.length  > 0"--}}
{{--                              style="border-radius: 50px; border: solid #fff .1rem;">--}}
{{--                        <v-img width="22"--}}
{{--                               src="https://static.independent.co.uk/s3fs-public/thumbnails/image/2018/03/18/15/billgates.jpg?width=668"/>--}}
{{--                    </v-avatar>--}}
{{--                    <v-avatar class="ml-n3" v-show="event.inviteds.length  > 1"--}}
{{--                              style="border-radius: 50px; border: solid #fff .1rem;">--}}
{{--                        <v-img width="22"--}}
{{--                               src="https://static.independent.co.uk/s3fs-public/thumbnails/image/2018/03/18/15/billgates.jpg?width=668"/>--}}
{{--                    </v-avatar>--}}
{{--                    <v-avatar class="ml-n3" v-show="event.inviteds.length  > 2"--}}
{{--                              style="border-radius: 50px; border: solid #fff .1rem;">--}}
{{--                        <v-img width="22"--}}
{{--                               src="https://static.independent.co.uk/s3fs-public/thumbnails/image/2018/03/18/15/billgates.jpg?width=668"/>--}}
{{--                    </v-avatar>--}}
{{--                    <v-avatar :class="event.inviteds.length > 0 ? 'ml-n3' : ''" color="white"--}}
{{--                              style="border-radius: 50px; border: solid #fff .1rem;">--}}
{{--                        <b>@{{ event.inviteds.length }}</b>--}}
{{--                    </v-avatar>--}}
{{--                </div>--}}
            </v-card>
        </v-col>
    </script>
@endpush
