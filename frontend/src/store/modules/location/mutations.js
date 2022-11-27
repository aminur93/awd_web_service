

export const GET_ALL_LOCATION = (state, data) => {
    state.location = data.location;
};

export const GET_LOCATION = (state, data) => {
    state.location = data.data.data;
    state.pagination = data.data;
};
