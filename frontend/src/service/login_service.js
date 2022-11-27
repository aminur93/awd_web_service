import store from '../store';
import axios from 'axios';

export function httpAuth() {
    return axios.create({
        baseURL: store.state.loginUrl,
        headers: {
            'Accept': 'application/json',
            Authorization: 'Bearer '+ store.state.token
        }
    })
}