import Crop from '../../views/admin/Crop/Crop/Crop';
import AddCrop from '../../views/admin/Crop/Crop/AddCrop';
export default[
    {
        path:'crop',
        name: 'Crop',
        component: Crop
    },
    {
        path:'addcrop',
        name:'AddCrop',
        component: AddCrop
    },
    {
        path: 'edit_crop/:id',
        name: 'EditCrop',
        component: () => import('../../views/admin/Crop/Crop/EditCrop')
    }
]