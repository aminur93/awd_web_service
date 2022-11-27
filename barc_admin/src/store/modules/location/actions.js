import {http} from "../../../service/http_service";



export const get_all_location = ({commit}) => {
    return http().get('v1/location').then(res => {
        commit('GET_ALL_LOCATION', res.data);
    })
};

export const get_location = ({commit}, data) => {
    return http().get('v1/location/getData?'+data).then(res => {
        commit('GET_LOCATION', res.data);
    })
};

