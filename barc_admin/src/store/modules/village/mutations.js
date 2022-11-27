export const GET_ALL_VILLAGE = (state, data) => {
    state.villages = data.villages;
};

export const GET_VILLAGE = (state, data) => {
    state.villages = data.data.data;
    state.pagination = data.data;
};

export const STORE_VILLAGE = (state, data) => {
    if(state.villages.push(data)){
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

export const GET_EDIT_VILLAGE = (state, data) => {
    state.village = data;
};

export const UPDATE_VILLAGE = (state, data) => {
    if (state.villages.push(data.village)){
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

export const DELETE_VILLAGE = (state, {id, data}) => {
    if (id){
        state.villages = state.villages.filter(item => {
            return id !== item.id
        })

        state.success_message = data.message
    } else {
        state.success_message = '';
    }
};