

export const GET_CULTIVATION_SECTION = (state, data) => {
    state.sections = data.data.data;
    state.pagination = data.data;
};

export const CULTIVATION_SECTION_STORE = (state, data) => {
    if(state.sections.push(data)){
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

