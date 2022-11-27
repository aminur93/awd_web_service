import {http} from "../../../service/http_service";
export const get_all_seasion = ({commit}) => {
    return http().get('v1/land_prepration_seasion').then(res => {
        commit('GET_ALL_SEASION', res.data);
    })
};
export const get_seasion = ({commit}, data) => {
    return http().get('v1/land_prepration_seasion/getData?'+data).then(res => {
        commit('GET_SEASION', res.data);
    })
};

export const add_seasion = ({commit}, data) => {
    return http().post('v1/land_prepration_seasion/store', data).then(res => {
        commit('SEASION_STORE', res.data);
    })
};

export const edit_seasion = ({commit}, id) => {
    return http().get(`v1/land_prepration_seasion/edit/${id}`).then(res => {
         console.log(res.data);
        commit('GET_EDIT_SEASION', res.data);
    })
};

export const update_seasion = ({commit}, {id, data}) => {
    return http().post(`v1/land_prepration_seasion/update/${id}`, data).then(res => {
        commit('SEASION_UPDATE', res.data);
    })
};

export const delete_seasion = ({commit}, id) => {
    return http().delete(`v1/land_prepration_seasion/destroy/${id}`).then(res => {
        commit('DELETE_SEASION',  {id:id,data:res.data});
    })
};