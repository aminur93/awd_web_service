import District from '../../views/admin/DistrictLocation/District';

export default[
    {
        path:'district',
        name: 'District',
        component: District
    },
    {
        path:'add_district',
        name:'AddDistrict',
        component: () => import('../../views/admin/DistrictLocation/AddDistrict')
    },
    {
        path: 'edit_district/:id',
        name: 'EditDistrict',
        component: () => import('../../views/admin/DistrictLocation/EditDistrict.vue')
    }
]