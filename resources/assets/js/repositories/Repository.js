import axios from 'axios/index';

const baseDomain = 'http://events.test';
const baseURL = `${baseDomain}/api`;

export default axios.create({
    baseURL
});