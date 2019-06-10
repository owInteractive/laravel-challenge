import axios from 'axios/index';

const baseDomain = '//localhost:8000';
const baseURL = `${baseDomain}/api`;

export default axios.create({
    baseURL
});