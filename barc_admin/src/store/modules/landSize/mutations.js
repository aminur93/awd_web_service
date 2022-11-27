

export const GET_ALL_SIZE = (state, data) => {
    state.sizes = data.sizes;
};

export const GET_SIZE = (state, data) => {
    state.sizes = data.data.data;
    state.pagination = data.data;
};
