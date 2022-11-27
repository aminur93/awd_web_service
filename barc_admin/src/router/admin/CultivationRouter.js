import Cultivation from '../../views/admin/Cultivation/CultivationCategory/Cultivation';
import AddCultivation from '../../views/admin/Cultivation/CultivationCategory/AddCultivation';
export default[
    {
        path:'cultivation_category',
        name: 'Cultivation',
        component: Cultivation
    },
    {
        path:'addcultivation',
        name:'AddCultivation',
        component: AddCultivation
    },
    {
        path: 'edit_cultivation/:id',
        name: 'EditCultivation',
        component: () => import('../../views/admin/Cultivation/CultivationCategory/EditCultivation.vue')
    }
]