<event-component/>

@push('scripts')
    <script id="event-template" type="text/x-template">
        <div>
            {{-- FILTER PANEL COMPONENT --}}
            @include('components.vue.events._filter-panel-component')
            <v-container :style="`position: relative; top: ${$vuetify.breakpoint.xsOnly ? 'unset' : '3rem'};`"
                         fluid
            >
                <v-row justify="center">
                    <v-col cols="12" xs="12" sm="12" md="9" lg="9" class="text-center">
                        <v-row justify="center" align="start">
                            {{-- EVENT ITEM COMPONENT --}}
                            @include('components.vue.events._new-event-item-component')
                            @include('components.vue.events._event-item-component')
                        </v-row>
                    </v-col>
                </v-row>
            </v-container>
        </div>
    </script>
    <script src="/js/events/event-component.js"></script>
@endpush

@push('post-scripts')
    <script>
        store.dispatch('updateEvents',{!! json_encode($metadata->events) !!});
    </script>
@endpush
