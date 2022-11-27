import Department from '../../views/admin/department/Department';

export default [
    {
        path: 'department',
        name: 'Department',
        component: Department
    },

    {
        path: 'add_department',
        name: 'AddDepartment',
        component: () => import('../../views/admin/department/AddDepartment')
    },

    {
        path: 'edit_department/:id',
        name: 'EditDepartment',
        component: () => import('../../views/admin/department/EditDepartment')
    }
]