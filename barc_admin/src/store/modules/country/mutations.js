export const GET_ALL_COUNTRY = (state, data) => {
    state.countries = data.countries;
};

export const GET_COUNTRY = (state, data) => {
    state.countries = data.data.data;
    state.pagination = data.data;
};

export const COUNTRY_STORE = (state, data) => {
    if(state.countries.push(data)){
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

export const GET_EDIT_COUNTRY = (state, data) => {
    state.country = data;
};

export const COUNTRY_UPDATE = (state, data) => {
    if (state.countries.push(data.country)){
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

export const DELETE_COUNTRY = (state, {id,data}) => {
    if (id){
        state.countries = state.countries.filter(item => {
            return item.id !== id;
        });

        state.success_message = data.message
    }else {
        state.success_message = '';
    }
};