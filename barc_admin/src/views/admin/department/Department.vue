<template>
    <div id="department">
        <div class="add-country">
            <router-link to="/dashboard/add_department">
                <button class="add_new"><i class="fa-solid fa-circle-plus"></i> Add New</button>
            </router-link>
        </div>

        <div class="field">
            <div for="entries">Show:
                <select  name="entries" id="entries" v-model="tableData.length" @change="getDepartment()">
                    <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                </select>
                Entries
            </div>

            <div class="search">
                <input type="text" v-model="tableData.search" placeholder="Search Country" @input="getDepartment()">
            </div>
        </div>

        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
            <tbody>
            <tr v-show="departments.length" v-for="(department) in departments" :key="department.id">
                <td>{{ department.id }}</td>
                <td>{{ department.name_en }}</td>
                <td>{{ department.name_bn }}</td>
                <td colspan="2">
                    <router-link :to="`/dashboard/edit_department/${department.id}`">
                        <button class="Edit"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                    </router-link>

                    <button class="delete" v-on:click="deleteDepartment(department)"><i class="fa-solid fa-trash"></i>  Delete</button>
                </td>
            </tr>
            </tbody>
        </datatable>

        <div class="field">
            <div><h5> Showing {{ paginations.from }} to {{ paginations.to }} of {{ paginations.total }} entries</h5> </div>

            <pagination :pagination.sync="paginations" :offset="5" @paginate="getDepartment();"></pagination>
        </div>
    </div>
</template>

<script>
    import DataTable from '../../../components/datatable/DataTable';
    import Pagination from '../../../components/datatable/Pagination.vue';

    import {mapState} from 'vuex';

    export default {
        name: "MyDepartment",

        components: {
            datatable: DataTable,
            pagination: Pagination
        },

        data(){
            let sortOrders = {};
            let columns = [
                {label: '#Sl', name: 'id' },
                {label: 'Name EN', name: 'name_en'},
                {label: 'Name BN', name: 'name_bn'},
                {label: 'Action', name: 'action'},
            ];
            columns.forEach((column) => {
                sortOrders[column.name] = -1;
            });

            return {
                columns: columns,
                sortKey: 'id',
                sortOrders: sortOrders,
                perPage: ['10', '20', '30','25','50','100'],
                tableData: {
                    draw: 0,
                    length: 10,
                    search: '',
                    column: 0,
                    dir: 'desc',
                },
                pagination: {
                    last_page: '',
                    current_page: 1,
                    total: '',
                    last_page_url: '',
                    next_page_url: '',
                    prev_page_url: '',
                    from: '',
                    to: ''
                },

                isActive: false,
                isShow: false,
            }
        },

        computed: {
            ...mapState({
                departments: state => state.department.departments,
                paginations: state => state.department.pagination,
                message: state => state.department.success_message
            })
        },

        mounted(){
            this.getDepartment();
        },

        methods: {
            getDepartment: async function(){
                try {
                    this.tableData.draw++;
                    let params = new URLSearchParams();
                    params.append('page', this.pagination.current_page);
                    params.append('draw', this.tableData.draw);
                    params.append('length', this.tableData.length);
                    params.append('search', this.tableData.search);
                    params.append('column', this.tableData.column);
                    params.append('dir', this.tableData.dir);

                    await this.$store.dispatch('department/get_department', params);
                }catch (e) {
                    console.log(e);
                }
            },

            sortBy(key) {
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1;
                this.tableData.column = this.getIndex(this.columns, 'name', key);
                this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
                this.getDepartment();
            },

            getIndex(array, key, value) {
                return array.findIndex(i => i[key] == value)
            },

            deleteDepartment: async function(department){
                let id = department.id;

                try {
                    await this.$store.dispatch('department/delete_department', id).then(() => {
                        this.$swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: this.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    })
                }catch (e) {
                    console.log(e);
                }
            }
        }
    }
</script>

<style scoped>

</style>