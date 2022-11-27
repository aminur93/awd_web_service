import {http} from "../../../service/http_service";

export const get_all_division = ({commit}) => {
    return http().get('v1/division').then(res => {
        commit('GET_ALL_DIVISION', res.data);
    })
};
export const get_division = ({commit}, data) => {
    return http().get('v1/division/getData?'+data).then(res => {
        commit('GET_DIVISION', res.data);
    })
};

export const add_division = ({commit}, data) => {
    return http().post('v1/division/store', data).then(res => {
        commit('DIVISION_STORE', res.data);
    })
};

export const edit_division = ({commit}, id) => {
    return http().get(`v1/division/edit/${id}`).then(res => {
        //console.log(res.data);
        commit('GET_EDIT_DIVISION', res.data);
    })
};

export const update_division = ({commit}, {id, data}) => {
    return http().post(`v1/division/update/${id}`, data).then(res => {
        commit('DIVISION_UPDATE', res.data);
    })
};

export const delete_division = ({commit}, id) => {
    return http().delete(`v1/division/destroy/${id}`).then(res => {
        commit('DELETE_DIVISION',  {id:id,data:res.data});
    })
};