import axiosInstance from "../../config/axios-instance";


function fetchNotificationsdata() {
    return axiosInstance({
        method: "get",
        url: `auth/notifications`,
        data: null
    });
}

function addNotificationsdata(data) {
    return axiosInstance({
        method: "post",
        url: `auth/notifications`,
        data: data
    });
}
function deleteNotificationsdata(id) {
    return axiosInstance({
        method: "delete",
        url: `auth/notification/${id}`,
        data: null
    });
}


const NotificationsServices = {
    fetchNotificationsdata, addNotificationsdata, deleteNotificationsdata
};

export default NotificationsServices;