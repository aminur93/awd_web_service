export const GET_ALL_POST_OFFICE = (state, data) => {
    state.Barc_post_offices = data.post_office;
};

export const GET_POST_OFFICE = (state, data) => {
    state.Barc_post_offices = data.data.data;
    state.pagination = data.data;
};

export const STORE_POST_OFFICE = (state, data) => {
    if (state.Barc_post_offices.push(data))
    {
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

export const EDIT_POST_OFFICE = (state, data) => {
    state.Barc_post_office = data.post_office;
};

export const UPDATE_POST_OFFICE = (state, data) => {
    if (state.Barc_post_offices.push(data.post_office))
    {
        state.success_message = data.message
    }else {
        state.success_message = '';
    }
};

export const DELETE_POST_OFFICE = (state, {id, data}) => {
    if (id)
    {
        state.Barc_post_offices = state.Barc_post_offices.filter(item => {
            return id !== item.id;
        })

        state.success_message = data.message
    }else {
        state.success_message = '';
    }
};