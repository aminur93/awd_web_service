import Po from '../../views/admin/po/Po';

export default [
    {
        path: 'po',
        name: 'Po',
        component: Po
    },

    {
        path: 'add_po',
        name: 'AddPo',
        component: () => import('../../views/admin/po/AddPo')
    },

    {
        path: 'edit_po/:id',
        name: 'edit_po',
        component: () => import('../../views/admin/po/EditPo')
    }
]