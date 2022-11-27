

export const GET_CULTIVATION = (state, data) => {
    state.cultivations = data.data.data;
    state.pagination = data.data;
};

export const CULTIVATION_STORE = (state, data) => {
    if(state.cultivations.push(data)){
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

export const GET_EDIT_CULTIVATION = (state, data) => {
    state.cultivation = data;
};

export const CULTIVATION_UPDATE = (state, data) => {
    if (state.cultivations.push(data.cultivation)){
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

export const DELETE_CULTIVATION = (state, {id,data}) => {
    if (id){
        state.cultivations = state.cultivations.filter(item => {
            return item.id !== id;
        });

        state.success_message = data.message
    }else {
        state.success_message = '';
    }
};