import {
    FETCH_NOTIFICATIONS_SUCCESS,
    FETCH_NOTIFICATIONS_FAILURE,
    CREATE_NOTIFICATIONS_SUCCESS,
    CREATE_NOTIFICATIONS_FAILURE,
    DELETE_NOTIFICATIONS_FAILURE,
    DELETE_NOTIFICATIONS_SUCCESS
} from "../actions/notification-actions/types";

const intialState = {
    notifications: [],
    error: false
};


const notificationsReducer = (state = intialState, action) => {
    switch (action.type) {
        case FETCH_NOTIFICATIONS_SUCCESS:
            return {
                ...state,
                notifications: action.payload
            };
        case DELETE_NOTIFICATIONS_SUCCESS:
            return {
                ...state,
                notifications: [...state.notifications.filter(notif => notif.id != action.payload)]
            };
        case CREATE_NOTIFICATIONS_SUCCESS:
            return state
        case CREATE_NOTIFICATIONS_FAILURE, DELETE_NOTIFICATIONS_FAILURE:
            console.log(action.payload);
            return state
        case FETCH_NOTIFICATIONS_FAILURE:
            return { ...state, error: true };
        default:
            return state;
    }
};
export default notificationsReducer;
