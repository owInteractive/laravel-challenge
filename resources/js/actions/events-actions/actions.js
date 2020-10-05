/*
@
 This file contains the actions creators
@
*/

import {
  FETCH_EVENTS_REQUEST,
  FETCH_EVENTS_FAILURE,
  FETCH_EVENTS_SUCCESS,
  CREATE_EVENTS_FAILURE,
  CREATE_EVENTS_SUCCESS,
  DELETE_EVENTS,
  DELETE_EVENTS_FAILURE,
  EDIT_EVENTS,
  EDIT_EVENTS_FAILURE,
  CREATE_EVENTS_REQUEST,
  FETCH_EVENTS_AFTER_ADDORDELETE_SUCCESS,
  TRACK_CURR
} from "./types";

import EventsServices from "./service";

export function fetchEvents(page, type = "all") {
  return async dispatch => {
    dispatch({
      type: FETCH_EVENTS_REQUEST
    });
    try {
      const response = await EventsServices.fetchEventsRequest(page, type);

      await dispatch({
        type: FETCH_EVENTS_SUCCESS,
        payload: response.data
      });
    } catch (e) {
      dispatch({
        type: FETCH_EVENTS_FAILURE
      });
    }
  };
}

export function fetchEventsAfterAddOrDelete(page, type = "all") {
  return async dispatch => {
    dispatch({
      type: FETCH_EVENTS_REQUEST
    });
    try {
      const response = await EventsServices.fetchEventsRequest(page, type);
      await dispatch({
        type: FETCH_EVENTS_AFTER_ADDORDELETE_SUCCESS,
        payload: response.data
      });
    } catch (e) {
      dispatch({
        type: FETCH_EVENTS_FAILURE
      });
    }
  };
}
export function addEvents(data, type = 'all') {
  return async dispatch => {
    try {
      const response = await EventsServices.createEvent(data);
      const obj = { ...response.data, type }
      await dispatch({
        type: CREATE_EVENTS_SUCCESS,
        payload: obj
      });
    } catch (e) {
      console.log(e);
      dispatch({
        type: CREATE_EVENTS_FAILURE
      });
    }
  };
}
export function trakingCurrentPage(page) {
  return async dispatch => {
    try {
      await dispatch({
        type: TRACK_CURR,
        payload: response.data
      });
    } catch (e) {
      console.log(e)
    }
  };
}
export function deleteEvents(id) {
  return async dispatch => {
    try {
      await EventsServices.deleteEvent(id);
      await dispatch({
        type: DELETE_EVENTS,
        payload: id
      });
    } catch (e) {
      dispatch({
        type: DELETE_EVENTS_FAILURE
      });
    }
  };
}
export function editEvents(data, id) {
  return async dispatch => {
    try {
      const res = await EventsServices.editEvent(data, id);
      await dispatch({
        type: EDIT_EVENTS,
        payload: res.data
      });
    } catch (e) {
      dispatch({
        type: EDIT_EVENTS_FAILURE
      });
    }
  };
}




export function exportEvent() {
  return async dispatch => {
    try {
      await EventsServices.exportEvent();
      // await dispatch({
      //   type: EDIT_EVENTS,
      //   payload: res.data
      // });
    } catch (e) {
      // dispatch({
      //   type: EDIT_EVENTS_FAILURE
      // });
    }
  };
}

