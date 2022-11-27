
export const GET_ALL_DIVISION = (state, data) => {
    state.divisions = data.divisions;
};

export const GET_DIVISION = (state, data) => {
    state.divisions = data.data.data;
    state.pagination = data.data;
};

export const DIVISION_STORE = (state, data) => {
    if(state.divisions.push(data)){
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

export const GET_EDIT_DIVISION = (state, data) => {
    state.division = data;
};

export const DIVISION_UPDATE = (state, data) => {
    if (state.divisions.push(data.division)){
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

export const DELETE_DIVISION = (state, {id,data}) => {
    if (id){
        state.divisions = state.divisions.filter(item => {
            return item.id !== id;
        });

        state.success_message = data.message
    }else {
        state.success_message = '';
    }
};