import Union from '../../views/admin/UnionLocation/Union';
import AddUnion from '../../views/admin/UnionLocation/AddUnion';

export default[
    {
        path:'union',
        name: 'Union',
        component: Union
    },
    {
        path:'add_union',
        name:'AddUnion',
        component: AddUnion
    },
    {
        path: 'edit_union/:id',
        name: 'EditUnion',
        component: () => import('../../views/admin/UnionLocation/EditUnion')
    }
]