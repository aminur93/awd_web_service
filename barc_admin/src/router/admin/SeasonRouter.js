import Season from '../../views/admin/LandPreperation/Season/Season';
import AddSeason from '../../views/admin/LandPreperation/Season/AddSeason';
export default[
    {
        path:'season',
        name: 'Season',
        component: Season
    },
    {
        path:'addseason',
        name:'AddSeason',
        component: AddSeason
    },
    {
        path: 'edit_seasion/:id',
        name: 'EditSeason',
        component: () => import('../../views/admin/LandPreperation/Season/EditSeason.vue')
    }
]
