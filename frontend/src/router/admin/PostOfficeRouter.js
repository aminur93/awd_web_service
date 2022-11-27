import PostOffice from '../../views/admin/PostOfficeLocation/PostOffice';


export default[
    {
        path:'post_office',
        name: 'PostOffice',
        component: PostOffice
    },

    {
        path:'add_post_office',
        name:'AddPostOffice',
        component: () => import('../../views/admin/PostOfficeLocation/AddPostOffice')
    },

    {
        path: 'edit_post_office/:id',
        name: 'EditPostOffice',
        component: () => import('../../views/admin/PostOfficeLocation/EditPostOffice')
    }
]