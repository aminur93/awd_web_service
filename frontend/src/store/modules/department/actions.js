import {http} from "../../../service/http_service";

export const get_department = ({commit}, data) => {
    return http().get('v1/department/getData?'+data).then(res => {
        commit('GET_DEPARTMENT', res.data);
    })
};

export const add_department = ({commit}, data) => {
    return http().post('v1/department/store', data).then(res => {
        commit('ADD_DEPARTMENT', res.data);
    })
};

export const edit_department = ({commit}, id) => {
    return http().get(`v1/department/edit/${id}`).then(res => {
        commit('EDIT_DEPARTMENT', res.data.department);
    })
};

export const update_department = ({commit}, {id, data}) => {
    return http().post(`v1/department/update/${id}`, data).then(res => {
        commit('UPDATE_DEPARTMENT', res.data);
    })
};

export const delete_department = ({commit}, id) => {
    return http().delete(`v1/department/destroy/${id}`).then(res => {
        commit('DELETE_DEPARTMENT', {id:id, data:res.data});
    })
};