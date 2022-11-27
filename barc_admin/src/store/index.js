import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

//import root-vuex
import state from './state'
import * as getters from './getters'
import * as mutations from './mutations'
import * as actions from './actions'

//import modules
import country from './modules/country';
import district from "./modules/district";
import division from "./modules/division";
import thana from "./modules/thana";
import village from "./modules/village";
import BarcPostOffice from "./modules/barcPostOffice";
import seasion from "./modules/seasion";
import landSize from "./modules/landSize";
import crop from "./modules/crop";
import po from "./modules/po";
import union from "./modules/union";
import department from "./modules/department";
import location from "./modules/location";
import selection from "./modules/selection";
import cultivation from "./modules/cultivation";
import section from "./modules/section";

export default new Vuex.Store({
    state,
    getters,
    mutations,
    actions,

    modules:{
        country,
        division,
        district,
        thana,
        village,
        BarcPostOffice,
        seasion,
        landSize,
        crop,
        po,
        union,
        department,
        location,
        selection,
        cultivation,
        section,
    }
})