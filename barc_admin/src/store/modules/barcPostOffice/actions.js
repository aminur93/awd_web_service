import {http} from "../../../service/http_service";

export const get_all_post_office = ({commit}) => {
    return http().get('v1/post_office').then(res => {
        commit('GET_ALL_POST_OFFICE', res.data);
    })
};

export const get_post_office  = ({commit}, data) => {
    return http().get('v1/post_office/getData?'+data).then(res => {
        commit('GET_POST_OFFICE', res.data);
    })
};

export const add_post_office = ({commit}, data) => {
    return http().post('v1/post_office/store', data).then(res => {
        commit('STORE_POST_OFFICE', res.data);
    })
};

export const get_edit_post_office = ({commit}, id) => {
    return http().get(`v1/post_office/edit/${id}`).then(res => {
        commit('EDIT_POST_OFFICE', res.data);
    })
};

export const update_post_office = ({commit}, {id, data}) => {
    return http().post(`v1/post_office/update/${id}`, data).then(res => {
        commit('UPDATE_POST_OFFICE', res.data);
    })
};

export const delete_post_office = ({commit}, id) => {
    return http().delete(`v1/post_office/destroy/${id}`).then(res => {
        commit('DELETE_POST_OFFICE', {id:id, data:res.data});
    })
};