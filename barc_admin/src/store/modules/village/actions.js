import {http} from "../../../service/http_service";

export const get_all_village = ({commit}) => {
    return http().get('v1/village').then(res => {
        commit('GET_ALL_VILLAGE', res.data)
    })
};

export const get_village = ({commit}, data) => {
    return http().get('v1/village/getData?'+data).then(res => {
        commit('GET_VILLAGE', res.data)
    })
};

export const add_village = ({commit}, data) => {
    return http().post('v1/village/store', data).then(res => {
        commit('STORE_VILLAGE', res.data);
    })
};

export const get_edit_village = ({commit}, id) => {
    return http().get(`v1/village/edit/${id}`).then(res => {
        commit('GET_EDIT_VILLAGE', res.data.village);
    })
};

export const update_village = ({commit}, {id, data}) => {
    return http().post(`v1/village/update/${id}`, data).then(res => {
        commit('UPDATE_VILLAGE', res.data);
    })
};

export const delete_village = ({commit}, id) => {
    return http().delete(`v1/village/destroy/${id}`).then(res => {
        commit('DELETE_VILLAGE', {id:id, data:res.data});
    })
};