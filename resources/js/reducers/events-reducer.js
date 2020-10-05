import {
  FETCH_EVENTS_FAILURE,
  FETCH_EVENTS_REQUEST,
  FETCH_EVENTS_SUCCESS,
  CREATE_EVENTS_FAILURE,
  CREATE_EVENTS_REQUEST,
  CREATE_EVENTS_SUCCESS,
  DELETE_EVENTS,
  DELETE_EVENTS_FAILURE,
  EDIT_EVENTS,
  EDIT_EVENTS_FAILURE,
  FETCH_EVENTS_AFTER_ADDORDELETE_SUCCESS
} from "../actions/events-actions/types";
import moment from 'moment';

const intialState = {
  events: [],
  current_page: null,
  per_page: null,
  total: null,
};

const dateFormat = 'YYYY-MM-DD';
const eventsReducer = (state = intialState, action) => {
  switch (action.type) {
    case FETCH_EVENTS_REQUEST:
      return state;
    case FETCH_EVENTS_SUCCESS:
      return {
        ...state,
        events: action.payload.data,
        total: action.payload.total,
        current_page: action.payload.current_page,
        per_page: action.payload.per_page,
        last_page: action.payload.last_page
      };
    case FETCH_EVENTS_AFTER_ADDORDELETE_SUCCESS:
      return {
        ...state,
        total: action.payload.total,
      };
    case FETCH_EVENTS_FAILURE, CREATE_EVENTS_FAILURE, DELETE_EVENTS_FAILURE, EDIT_EVENTS_FAILURE:
      return state;
    case CREATE_EVENTS_SUCCESS:
      {
        let obj1 = [...state.events];
        console.log('paylod', action.payload);
        if (obj1.length < 5) {
          if (action.payload.type == "nextFiveDays") {
            if (moment(Date.now()).add(5, 'days').format('YYYY-MM-DD') <= action.payload.start_datetime) {
              obj1 = [...obj1, action.payload]
            }
          } else if (action.payload.type == "today") {
            if (moment(Date.now()).format('YYYY-MM-DD') == action.payload.start_datetime) {
              obj1 = [...obj1, action.payload]
            }
          } else obj1 = [...obj1, action.payload]
        }
        return { ...state, events: [...obj1] };
      }
    case DELETE_EVENTS:
      return { ...state, events: [...state.events.filter(event => event.id != action.payload)] }
    case EDIT_EVENTS:
      const obj = [...state.events];
      const element = obj.findIndex(event => {
        return event.id == action.payload.id;
      });
      obj[element] = action.payload;
      console.log(element, obj, action.payload.id);
      return {
        ...state, events: [...obj]
      }
    default:
      return state;
  }
};

export default eventsReducer;
