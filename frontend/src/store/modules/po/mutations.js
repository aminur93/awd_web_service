export const GET_PO = (state, data) => {
    state.pos = data.data.data;
    state.pagination = data.data;
};

export const ADD_PO = (state, data) => {
    if (state.pos.push(data))
    {
        state.success_message = data.message
    }else {
        state.success_message = '';
    }
};

export const GET_EDIT_POC = (state, data) => {
    state.po = data.poc;
};

export const UPDATE_POC = (state, data) => {
    if (state.pos.push(data))
    {
        state.success_message = data.message
    }else {
        state.success_message = '';
    }
};

export const DELETE_PO = (state, {id, data}) => {
    if (id){
        state.pos = state.pos.filter(item => {
            return id !== item.id;
        });

        state.success_message = data.message;
    } else {
        state.success_message = '';
    }
};