import Repository from './Repository';

const resource = '/events';

export default {
    get(payload) {
        return Repository.get(`${resource}`, payload);
    },

    deleteEvent(eventId){
        return Repository.post(`${resource}/${eventId}`, {
            '_method': 'DELETE'
        })
    }
}