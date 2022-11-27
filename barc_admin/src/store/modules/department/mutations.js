export const GET_DEPARTMENT = (state, data) => {
    state.departments = data.data.data;
    state.pagination = data.data;
};

export const ADD_DEPARTMENT = (state, data) => {
    if (state.departments.push(data))
    {
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

export const EDIT_DEPARTMENT = (state, data) => {
    state.department = data;
};

export const UPDATE_DEPARTMENT = (state, data) => {
    if (state.departments.push(data))
    {
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

export const DELETE_DEPARTMENT = (state, {id, data}) => {
    if (id)
    {
        state.departments = state.departments.filter(item => {
            return id !== item.id;
        })

        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};