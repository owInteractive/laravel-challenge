/*
@
 This file contains the requests ( services )
@
*/

import axiosInstance from "../../config/axios-instance";


function fetchEventsRequest(page = 1, type) {
  let url = `auth/events?page=${page}`;
  if (type == 'today') url = `auth/today_events?page=${page}`;
  if (type == 'nextFiveDays') url = `auth/eventfilter?page=${page}`;
  console.log(url, page, type)
  return axiosInstance({
    method: "get",
    url: url,
    data: null
  });
}

function exportEvent() {
  return axiosInstance({
    method: "get",
    url: `auth/exportEvents`,
    data: null
  });
}
function createEvent(data) {
  return axiosInstance({
    method: "post",
    url: "auth/newevent",
    data: data
  });
}
function deleteEvent(id) {
  return axiosInstance({
    method: "delete",
    url: `auth/events/${id}`,
    data: null
  });
}
function editEvent(data, id) {
  return axiosInstance({
    method: "post",
    url: `auth/events/${id}`,
    data: data
  });
}

const EventsServices = {
  fetchEventsRequest, createEvent, deleteEvent, editEvent, exportEvent
};

export default EventsServices;
