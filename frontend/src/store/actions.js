import {httpAuth} from "../service/login_service";

export const login = ({dispatch}, data) => {
    return httpAuth().post('/auth/v1/login', data).then((response) => {
        dispatch('attempt', response.data.access_token);
        dispatch('setToken', response.data.access_token);
        dispatch('setAdmin', response.data.user);
    });
};

export const attempt = ({commit, state}, token) => {
    if (token){
        commit('SET_TOKEN', token);
    }

    if (!state.token) {
        return
    }

    try {
        return httpAuth().post('/auth/v1/me')
            .then(response => {
                commit('SET_USER', response.data);
            });
    }catch (e) {
        commit('SET_TOKEN', null);
        commit('SET_USER', null);
    }
};

export const setToken = (_, token) => {
    localStorage.setItem('token', token);
};

export const setAdmin = (_, user) => {
    localStorage.setItem('user', JSON.stringify(user));
};

export const logout = ({commit}) => {

    return httpAuth().post('/auth/v1/logout')
        .then(() => {

            commit('SET_TOKEN', null);
            commit('SET_USER', null);

            localStorage.removeItem('token');
            localStorage.removeItem('user');
        });
};