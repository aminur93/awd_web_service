import {http} from "../../../service/http_service";



export const get_all_selection = ({commit}) => {
    return http().get('v1/crop_selection').then(res => {
        commit('GET_ALL_SELECTION', res.data);
    })
};

export const get_selection = ({commit}, data) => {
    return http().get('v1/crop_selection/getData?'+data).then(res => {
        commit('GET_SELECTION', res.data);
    })
};

