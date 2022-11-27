import Village from '../../views/admin/village/Village';


export default[
    {
        path:'village',
        name: 'Village',
        component: Village
    },

    {
        path:'add_village',
        name:'AddVillage',
        component: () => import('../../views/admin/village/AddVillage')
    },

    {
        path: 'edit_village/:id',
        name: 'EditVillage',
        component: () => import('../../views/admin/village/EditVillage')
    }
]