import store from '../../store';
import Dashboard from '../../views/admin/Mydashboard';

//child router in admin
import CountryRouter from './CountryRouter';
import DistrictRouter from './DistrictRouter';
import DivisionRouter from './DivisionRouter';
import PostOfficeRouter from './PostOfficeRouter';
import SeasonRouter from './SeasonRouter';
import ThanaRouter from './ThanaRouter';
import UnionRouter from './UnionRouter';
import VillageRouter from './VillageRouter';
import CropRouter from './CropRouter';
import LandPreperation from './LandPreperation';
import LandSize from './LandSize';
import PoRouter from './PoRouter';
import DepartmentRouter from './DepartmentRouter';
import LocationRouter from './LocationRouter';
import SelectionRouter from './SelectionRouter';
import CultivationRouter from './CultivationRouter';
import CultivationSectionRouter from './CultivationSectionRouter';

export default[
    {
        path: '/dashboard',
        component: Dashboard,
        children: [
            {
                path: '',
                name: 'MainDashboard',
                component: () => import('../../views/admin/MainDashboard.vue')
            },

            ...CountryRouter,
            ...DistrictRouter,
            ...DivisionRouter,
            ...ThanaRouter,
            ...UnionRouter,
            ...VillageRouter,
            ...PostOfficeRouter,
            ...SeasonRouter,
            ...CropRouter,
            ...PoRouter,
            ...DepartmentRouter,
            ...LandPreperation,
            ...LandSize,
            ...PoRouter,
            ...LocationRouter,
            ...SelectionRouter,
            ...CultivationRouter,
            ...CultivationSectionRouter,

        ],

        beforeEnter(to, from, next){
            if (!store.getters['AuthToken']){
                return next({
                    name: 'Login'
                });
            }else {
                next();
            }
        },
    }
]