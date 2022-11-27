import {http} from "../../../service/http_service";


export const get_cultivation_section = async ({commit}, data) => {
    const res = await http().get('v1/cultivation/getData?' + data);
    commit('GET_CULTIVATION_SECTION', res.data);
};
