export const GET_ALL_DISTRICT = (state, data) => {
    state.districts = data.districts;
};

export const GET_DISTRICT = (state, data) => {
    state.districts = data.data.data;
    state.pagination = data.data;
};

export const DISTRICT_STORE = (state, data) => {
    if(state.districts.push(data)){
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

export const GET_EDIT_DISTRICT = (state, data) => {
    state.district = data;
};

export const DISTRICT_UPDATE = (state, data) => {
    if (state.districts.push(data.district)){
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

export const DELETE_DISTRICT = (state, {id,data}) => {
    if (id){
        state.districts = state.districts.filter(item => {
            return item.id !== id;
        });

        state.success_message = data.message
    }else {
        state.success_message = '';
    }
};