import Country from '../../views/admin/CountryLocation/Country';
import AddCountry from '../../views/admin/CountryLocation/AddCountry';
export default[
    {
        path:'country',
        name: 'Country',
        component: Country
    },
    {
        path:'addcountry',
        name:'AddCountry',
        component: AddCountry
    },
    {
        path: 'edit_country/:id',
        name: 'EditCountry',
        component: () => import('../../views/admin/CountryLocation/EditCountry.vue')
    }
]