export const GET_UNION = (state, data) => {
    state.unions = data.data.data;
    state.pagination = data.data;
};

export const STORE_UNION = (state, data) => {
    if (state.unions.push(data))
    {
        state.success_message = data.message
    }else {
        state.success_message = '';
    }
};

export const GET_EDIT_UNION = (state, data) => {
    state.union = data;
};

export const UPDATE_UNION = (state, data) => {
    if (state.unions.push(data))
    {
        state.success_message = data.message
    }else {
        state.success_message = '';
    }
};

export const DELETE_UNION = (state, {id, data}) => {
    if (id){
        state.unions = state.unions.filter(item => {
            return id !== item.id;
        })

        state.success_message = data.message
    } else {
        state.success_message = '';
    }
};