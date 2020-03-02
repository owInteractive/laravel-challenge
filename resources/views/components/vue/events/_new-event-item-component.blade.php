<new-event-item-component v-show="isNewEvent"/>

@push('scripts')
    <script id="new-event-item-template" type="text/x-template">
        <v-col cols="12" xs="12" sm="6" md="6">
            <v-card>
                <v-card-title>
                    <v-text-field class="font-weight-medium headline" label="Title" :rules="rulesTitle"
                                  hide-details="auto"
                                  v-model="eventData.title"
                    />
                </v-card-title>
                <v-card-text class="text-left">
                    <v-textarea
                            label="Description"
                            hint=""
                            v-model="eventData.description"
                    ></v-textarea>
                </v-card-text>
                {{--date--}}
                <v-card-text class="d-flex justify-space-around grey lighten-3">
                    {{--start--}}
                    <div class="d-flex flex-column">
                        <div class="d-flex font-weight-medium">
                            <v-dialog
                                    ref="dialogStartDate"
                                    v-model="modalStartDate"
                                    :return-value.sync="eventData.startDate"
                                    persistent
                                    width="290px"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-text-field
                                            v-model="eventData.startDate"
                                            label="Start date"
                                            prepend-icon="mdi-calendar"
                                            readonly
                                            v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-date-picker v-model="eventData.startDate" scrollable>
                                    <v-spacer></v-spacer>
                                    <v-btn text color="primary" @click="modalStartDate = false">Cancel</v-btn>
                                    <v-btn text color="primary"
                                           @click="$refs.dialogStartDate.save(eventData.startDate)">
                                        OK
                                    </v-btn>
                                </v-date-picker>
                            </v-dialog>
                        </div>
                        <div class="d-flex mt-n5 p-0 justify-center">
                            <small class="pl-5 caption">@{{ this.getWeek(eventData.startDate) }}</small>
                        </div>
                    </div>
                    {{--end--}}
                    <div class="d-flex flex-column">
                        <div class="d-flex font-weight-medium">
                            <v-dialog
                                    ref="dialogStartTime"
                                    v-model="modalStartTime"
                                    :return-value.sync="eventData.startTime"
                                    persistent
                                    width="290px"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-text-field
                                            v-model="eventData.startTime"
                                            label="Start time"
                                            prepend-icon="mdi-clock-outline"
                                            readonly
                                            v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-time-picker
                                        v-if="modalStartTime"
                                        v-model="eventData.startTime"
                                        format="24hr"
                                        full-width
                                >
                                    <v-spacer></v-spacer>
                                    <v-btn text color="primary" @click="modalStartTime = false">Cancel</v-btn>
                                    <v-btn text color="primary"
                                           @click="$refs.dialogStartTime.save(eventData.startTime)">
                                        OK
                                    </v-btn>
                                </v-time-picker>
                            </v-dialog>
                        </div>
                    </div>
                </v-card-text>
                {{--date--}}
                <v-card-text class="d-flex justify-space-around grey lighten-3">
                    {{--end--}}
                    <div class="d-flex flex-column">
                        <div class="d-flex font-weight-medium">
                            <v-dialog
                                    ref="dialogEndDate"
                                    v-model="modalEndDate"
                                    :return-value.sync="eventData.endDate"
                                    persistent
                                    width="290px"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-text-field
                                            v-model="eventData.endDate"
                                            label="End date"
                                            prepend-icon="mdi-calendar"
                                            readonly
                                            v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-date-picker v-model="eventData.endDate" scrollable>
                                    <v-spacer></v-spacer>
                                    <v-btn text color="primary" @click="modalEndDate = false">Cancel</v-btn>
                                    <v-btn text color="primary" @click="$refs.dialogEndDate.save(eventData.endDate)">
                                        OK
                                    </v-btn>
                                </v-date-picker>
                            </v-dialog>
                        </div>
                        <div class="d-flex mt-n5 p-0 justify-center">
                            <small class="pl-5 caption">@{{ this.getWeek(eventData.endDate) }}</small>
                        </div>
                    </div>
                    {{--end--}}
                    <div class="d-flex flex-column">
                        <div class="d-flex font-weight-medium">
                            <v-dialog
                                    ref="dialogEndTime"
                                    v-model="modalEndTime"
                                    :return-value.sync="eventData.endTime"
                                    persistent
                                    width="290px"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-text-field
                                            v-model="eventData.endTime"
                                            label="End time"
                                            prepend-icon="mdi-clock-outline"
                                            readonly
                                            v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-time-picker
                                        v-if="modalEndTime"
                                        v-model="eventData.endTime"
                                        format="24hr"
                                        full-width
                                >
                                    <v-spacer></v-spacer>
                                    <v-btn text color="primary" @click="modalEndTime = false">Cancel</v-btn>
                                    <v-btn text color="primary" @click="$refs.dialogEndTime.save(eventData.endTime)">
                                        OK
                                    </v-btn>
                                </v-time-picker>
                            </v-dialog>
                        </div>
                    </div>
                </v-card-text>
            </v-card>
        </v-col>
    </script>
@endpush
