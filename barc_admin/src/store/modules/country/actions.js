import {http} from "../../../service/http_service";

export const get_all_country = ({commit}) => {
    return http().get('v1/country').then(res => {
        commit('GET_ALL_COUNTRY', res.data);
    })
};

export const get_country = ({commit}, data) => {
    return http().get('v1/country/getData?'+data).then(res => {
        commit('GET_COUNTRY', res.data);
    })
};

export const add_country = ({commit}, data) => {
    return http().post('v1/country/store', data).then(res => {
        commit('COUNTRY_STORE', res.data);
    })
};

export const edit_country = ({commit}, id) => {
    return http().get(`v1/country/edit/${id}`).then(res => {
        commit('GET_EDIT_COUNTRY', res.data.country);
    })
};

export const update_country = ({commit}, {id, data}) => {
    return http().post(`v1/country/update/${id}`, data).then(res => {
        commit('COUNTRY_UPDATE', res.data);
    })
};

export const delete_country = ({commit}, id) => {
    return http().delete(`v1/country/destroy/${id}`).then(res => {
        commit('DELETE_COUNTRY',  {id:id,data:res.data});
    })
};