import {http} from "../../../service/http_service";

export const get_all_crop = ({commit}) => {
    return http().get('v1/crop').then(res => {
        commit('GET_ALL_CROP', res.data);
    })
};

export const get_crop = ({commit}, data) => {
    return http().get('v1/crop/getData?'+data).then(res => {
        commit('GET_CROP', res.data);
    })
};

export const add_crop = ({commit}, data) => {
    return http().post('v1/crop/store', data).then(res => {
        commit('CROP_STORE', res.data);
    })
};

export const edit_crop = ({commit}, id) => {
    return http().get(`v1/crop/edit/${id}`).then(res => {
        commit('GET_EDIT_CROP', res.data.crop);
    })
};

export const update_crop = ({commit}, {id, data}) => {
    return http().post(`v1/crop/update/${id}`, data).then(res => {
        commit('CROP_UPDATE', res.data);
    })
};

export const delete_crop = ({commit}, id) => {
    return http().delete(`v1/crop/destroy/${id}`).then(res => {
        commit('DELETE_CROP',  {id:id,data:res.data});
    })
};