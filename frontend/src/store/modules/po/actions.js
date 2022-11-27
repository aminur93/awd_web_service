import {http} from "../../../service/http_service";

export const get_po = ({commit}, data) => {
    return http().get('v1/poc/getData?'+data).then(res => {
        commit('GET_PO', res.data);
    })
};

export const add_po = ({commit}, data) => {
    return http().post('v1/poc/store', data).then(res => {
        commit('ADD_PO', res.data);
    })
};

export const get_edit_poc = ({commit}, id) => {
    return http().get(`v1/poc/edit/${id}`).then(res => {
        commit('GET_EDIT_POC', res.data);
    })
};

export const update_po = ({commit}, {id, data}) => {
    return http().post(`v1/poc/update/${id}`, data).then(res => {
        commit('UPDATE_POC', res.data);
    })
};

export const delete_po = ({commit}, id) => {
    return http().delete(`v1/poc/destroy/${id}`).then(res => {
        commit('DELETE_PO', {id:id, data:res.data});
    })
};