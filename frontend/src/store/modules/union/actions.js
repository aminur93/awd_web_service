import {http} from "../../../service/http_service";

export const get_union = ({commit}, data) => {
    return http().get('v1/union/getData?'+data).then(res => {
        commit('GET_UNION', res.data);
    })
};

export const add_union = ({commit}, data) => {
    return http().post('v1/union/store', data).then(res => {
        commit('STORE_UNION', res.data);
    })
};

export const get_edit_union = ({commit}, id) => {
    return http().get(`v1/union/edit/${id}`).then(res => {
        commit('GET_EDIT_UNION', res.data.union);
    })
};

export const update_union = ({commit}, {id, data}) => {
    return http().post(`v1/union/update/${id}`, data).then(res => {
        commit('UPDATE_UNION', res.data);
    })
};

export const delete_union = ({commit}, id) => {
    return http().delete(`v1/union/destroy/${id}`).then(res => {
        commit('DELETE_UNION', {id:id, data:res.data})
    })
};