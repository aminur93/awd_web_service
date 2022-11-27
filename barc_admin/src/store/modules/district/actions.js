import {http} from "../../../service/http_service";
export const get_all_district = ({commit}) => {
    return http().get('v1/district').then(res => {
        commit('GET_ALL_DISTRICT', res.data);
    })
};
export const get_district = ({commit}, data) => {
    return http().get('v1/district/getData?'+data).then(res => {
        commit('GET_DISTRICT', res.data);
    })
};

export const add_district = ({commit}, data) => {
    return http().post('v1/district/store', data).then(res => {
        commit('DISTRICT_STORE', res.data);
    })
};

export const edit_district = ({commit}, id) => {
    return http().get(`v1/district/edit/${id}`).then(res => {
        commit('GET_EDIT_DISTRICT', res.data.district);
    })
};

export const update_district = ({commit}, {id, data}) => {
    return http().post(`v1/district/update/${id}`, data).then(res => {
        commit('DISTRICT_UPDATE', res.data);
    })
};

export const delete_district = ({commit}, id) => {
    return http().delete(`v1/district/destroy/${id}`).then(res => {
        commit('DELETE_DISTRICT',  {id:id,data:res.data});
    })
};