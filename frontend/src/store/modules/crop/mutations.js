export const GET_ALL_CROP = (state, data) => {
    state.crops = data.crop;
};

export const GET_CROP = (state, data) => {
    state.crops = data.data.data;
    state.pagination = data.data;
};

export const CROP_STORE = (state, data) => {
    if(state.crops.push(data)){
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

export const GET_EDIT_CROP = (state, data) => {
    state.crop = data;
};

export const CROP_UPDATE = (state, data) => {
    if (state.crops.push(data.crop)){
        state.success_message = data.message;
    }else {
        state.success_message = '';
    }
};

export const DELETE_CROP = (state, {id,data}) => {
    if (id){
        state.crops = state.crops.filter(item => {
            return item.id !== id;
        });

        state.success_message = data.message
    }else {
        state.success_message = '';
    }
};