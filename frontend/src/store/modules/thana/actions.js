import {http} from "../../../service/http_service";

export const get_all_thana = ({commit}) => {
    return http().get('v1/thana').then(res => {
        commit('GET_ALL_THANA', res.data);
    })
};
export const get_thana = ({commit}, data) => {
    return http().get('v1/thana/getData?'+data).then(res => {
        commit('GET_THANA', res.data);
    })
};

export const add_thana = ({commit}, data) => {
    return http().post('v1/thana/store', data).then(res => {
        // console.log(res.data);
        commit('THANA_STORE', res.data);
    })
};

export const edit_thana = ({commit}, id) => {
    return http().get(`v1/thana/edit/${id}`).then(res => {
         //console.log(res.data);
        commit('GET_EDIT_THANA', res.data);
    })
};

export const update_thana = ({commit}, {id, data}) => {
    return http().post(`v1/thana/update/${id}`, data).then(res => {
        commit('THANA_UPDATE', res.data);
    })
};

export const delete_thana = ({commit}, id) => {
    return http().delete(`v1/thana/destroy/${id}`).then(res => {
        commit('DELETE_THANA',  {id:id,data:res.data});
    })
};