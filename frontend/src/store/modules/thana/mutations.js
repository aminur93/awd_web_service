
export const GET_ALL_THANA = (state, data) => {
    state.thanas = data.thana;
};

export const GET_THANA = (state, data) => {
    state.thanas = data.data.data;
    state.pagination = data.data;
};

export const THANA_STORE = (state, data) => {
    if(state.thanas.push(data)){
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

export const GET_EDIT_THANA = (state, data) => {
    state.thana = data.thana;
};

export const THANA_UPDATE = (state, data) => {
    if (state.thanas.push(data.thana)){
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

export const DELETE_THANA = (state, {id,data}) => {
    if (id){
        state.thanas = state.thanas.filter(item => {
            return item.id !== id;
        });

        state.success_message = data.message
    }else {
        state.success_message = '';
    }
};