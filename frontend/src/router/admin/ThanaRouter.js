import Thana from '../../views/admin/ThanaLocation/Thana';
import AddThana from '../../views/admin/ThanaLocation/AddThana';
export default[
    {
        path:'thana',
        name: 'Thana',
        component: Thana
    },
    {
        path:'addthana',
        name:'AddThana',
        component: AddThana
    },
    {
        path: 'edit_thana/:id',
        name: 'EditThana',
        component: () => import('../../views/admin/ThanaLocation/EditThana.vue')
    }
]