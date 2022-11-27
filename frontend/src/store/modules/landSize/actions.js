import {http} from "../../../service/http_service";



export const get_all_country = ({commit}) => {
    return http().get('v1/land_size').then(res => {
        commit('GET_ALL_SIZE', res.data);
    })
};

export const get_country = ({commit}, data) => {
    return http().get('v1/land_size/getData?'+data).then(res => {
        commit('GET_SIZE', res.data);
    })
};

