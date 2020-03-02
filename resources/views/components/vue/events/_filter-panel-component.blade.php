<filter-panel-component/>

@push('scripts')
    <script id="filter-panel-template" type="text/x-template">
        <v-card flat :style="`position: fixed; z-index: 2; ${$vuetify.breakpoint.xsOnly ? 'bottom: 0;' : ''}`" class="p-0 pt-5" width="100%">

            <div class="d-flex flex-row">
                <div class="d-flex flex-grow-1 flex-sm-grow-0 justify-center" :style="$vuetify.breakpoint.smAndUp ? 'position: absolute' : ''">
                    <v-btn class="mx-2 ml-5" color="green" dark rounded
                           @click="isNewEvent = !isNewEvent"
                           v-show="!isNewEvent"
                    >
                        <v-icon class="pr-2">mdi-calendar</v-icon>
                        NEW
                    </v-btn>
                    <span v-if="isNewEvent">
                        {{-- BTN CANCEL --}}
                        <v-btn class="mx-2 ml-5" color="secondary" dark rounded
                               @click="onCancel()">
                            <v-icon class="pr-2">mdi-cancel</v-icon>
                            CANCEL
                        </v-btn>
                        {{-- BTN SAVE --}}
                        <v-btn class="mx-2 ml-5" color="blue" width="130" dark rounded
                               @click="onSave()">
                            <v-icon class="pr-2">mdi-content-save</v-icon>
                            SAVE
                        </v-btn>
                    </span>
                </div>

                <div v-if="$vuetify.breakpoint.smAndUp" class="d-flex mx-auto">
                    <v-btn class="mx-2 ml-5" width="120" rounded>ALL</v-btn>

                    <v-btn class="mx-2" width="120" rounded>TODAY</v-btn>

                    <v-btn class="mx-2" rounded>NEXT 5 DAYS</v-btn>
                </div>
            </div>


            <v-divider class="m-0 mt-5"></v-divider>
        </v-card>
    </script>
@endpush
