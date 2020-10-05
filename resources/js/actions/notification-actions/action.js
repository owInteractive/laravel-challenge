import {
    FETCH_NOTIFICATIONS_SUCCESS,
    FETCH_NOTIFICATIONS_FAILURE,
    CREATE_NOTIFICATIONS_SUCCESS,
    CREATE_NOTIFICATIONS_FAILURE,
    DELETE_NOTIFICATIONS_FAILURE,
    DELETE_NOTIFICATIONS_SUCCESS
} from "./types";

import NotificationsServices from "./service";

export function fetchNotifications() {
    return async dispatch => {
        try {
            const response = await NotificationsServices.fetchNotificationsdata();
            console.log(response.error);
            await dispatch({
                type: FETCH_NOTIFICATIONS_SUCCESS,
                payload: response.data
            });
        } catch (e) {
            dispatch({
                type: FETCH_NOTIFICATIONS_FAILURE
            });
        }
    };
}

export function addNotifications(data) {
    return async dispatch => {
        try {
            console.log(data);
            const response = await NotificationsServices.addNotificationsdata(data);
            console.log('errrrrrrr', response);
            await dispatch({
                type: CREATE_NOTIFICATIONS_SUCCESS,
                payload: null
            });
        } catch (e) {
            console.log('lerreu :', e['error']);
            dispatch({
                type: CREATE_NOTIFICATIONS_FAILURE,
                payload: e
            });
        }
    };
}
export function deleteNotifications(id) {
    return async dispatch => {
        try {
            await NotificationsServices.deleteNotificationsdata(id);
            await dispatch({
                type: DELETE_NOTIFICATIONS_SUCCESS,
                payload: id
            });
        } catch (e) {
            dispatch({
                type: DELETE_NOTIFICATIONS_FAILURE
            });
        }
    };
}