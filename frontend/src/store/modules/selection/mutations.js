

export const GET_ALL_SELECTION = (state, data) => {
    state.selection = data.selection;
};

export const GET_SELECTION = (state, data) => {
    state.selection = data.data.data;
    state.pagination = data.data;
};
