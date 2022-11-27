import {http} from "../../../service/http_service";


export const get_cultivation = async ({commit}, data) => {
    return http().get('v1/cultivation/getData?' + data).then(res => {
        commit('GET_CULTIVATION', res.data);
    });

};

export const add_cultivation = async ({commit}, data) => {
    return http().post('v1/cultivation/store', data).then(res => {
        commit('CULTIVATION_STORE', res.data);
    });

};

export const edit_cultivation = async ({commit}, id) => {
    return http().get(`v1/cultivation/edit/${id}`).then(res => {
        commit('GET_EDIT_CULTIVATION', res.data.cultivationCategory);
    });

};

export const update_cultivation = async ({commit}, {id, data}) => {
    return http().post(`v1/cultivation/update/${id}`, data).then(res => {
        commit('CULTIVATION_UPDATE', res.data);
    });

};

export const delete_cultivation = async ({commit}, id) => {
    return http().delete(`v1/cultivation/destroy/${id}`).then(res => {
        commit('DELETE_CULTIVATION', { id: id, data: res.data });
    });

};