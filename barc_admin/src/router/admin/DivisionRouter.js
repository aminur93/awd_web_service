import Division from '../../views/admin/DivisionLocation/Division';
import AddDivision from '../../views/admin/DivisionLocation/AddDivision';
export default[
    {
        path:'division',
        name: 'Division',
        component: Division
    },
    {
        path:'adddivision',
        name:'AddDivision',
        component: AddDivision
    },
    {
        path: 'edit_division/:id',
        name: 'EditDivision',
        component: () => import('../../views/admin/DivisionLocation/EditDivision.vue')
    }
]