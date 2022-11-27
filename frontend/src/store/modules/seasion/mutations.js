
export const GET_ALL_SEASIONS = (state, data) => {
    state.seasions = data.seasions;
};

export const GET_SEASIONS = (state, data) => {
    state.seasions = data.data.data;
    state.pagination = data.data;
};

export const SEASIONS_STORE = (state, data) => {
    if(state.seasions.push(data)){
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

export const GET_EDIT_SEASION = (state, data) => {
    state.seasion = data.land_seasion;
};

export const SEASION_UPDATE = (state, data) => {
    if (state.seasions.push(data.seasion)){
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

export const DELETE_SEASION = (state, {id,data}) => {
    if (id){
        state.seasions = state.seasions.filter(item => {
            return item.id !== id;
        });

        state.success_message = data.message
    }else {
        state.success_message = '';
    }
};