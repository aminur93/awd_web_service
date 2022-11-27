<template>
   <div id="Union">
       <div class="add-District">
           <router-link to="/dashboard/add_union">
               <button class="add_new"><i class="fa-solid fa-circle-plus"></i> Add New</button>
           </router-link>
       </div>

       <div class="field">
           <div for="entries">Show:
               <select  name="entries" id="entries" v-model="tableData.length" @change="getUnion()">
                   <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
               </select>
               Entries
           </div>

           <div class="search">
               <input type="text" v-model="tableData.search" placeholder="Search District" @input="getUnion()">
           </div>
       </div>
       <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
           <tbody>
           <tr v-show="unions.length" v-for="(union,index) in unions" :key="union.id">
               <td>{{ index + 1 }}</td>
               <td>{{ union.village_name_en }}</td>
               <td>{{ union.name_en }}</td>
               <td>{{ union.name_bn }}</td>
               <td colspan="2">
                   <router-link :to="`/dashboard/edit_union/${union.id}`">
                       <button class="Edit"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                   </router-link>

                   <button class="delete" v-on:click="deleteUnion(union)"><i class="fa-solid fa-trash"></i>  Delete</button>
               </td>
           </tr>
           </tbody>
       </datatable>


       <div class="field">
           <div><h5> Showing {{ paginations.from }} to {{ paginations.to }} of {{ paginations.total }} entries</h5> </div>
           <pagination :pagination.sync="paginations" :offset="5" @paginate="getUnion();"></pagination>
       </div>
   </div>
</template>
<script>
    import DataTable from '../../../components/datatable/DataTable';
    import Pagination from '../../../components/datatable/Pagination.vue';

    import {mapState} from 'vuex';
export default {
   name: 'MyUnion',

   components: {
     datatable: DataTable,
       pagination: Pagination
   },

   mixins: [],

   props: {
     
   },

   data() {
       let sortOrders = {};
       let columns = [
           {label: '#Sl', name: 'id' },
           {label: 'Village Name', name: 'village_name_en'},
           {label: 'Name En', name: 'name_en'},
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

           current_page: '',
           last_page : '',

           isActive: false,
           isShow: false,
       }
    },

    computed: {
        ...mapState({
            unions: state => state.union.unions,
            paginations: state => state.union.pagination,
            message: state => state.union.success_message
        })
    },

    mounted(){
        this.getUnion();
    },

    methods: {
        getUnion: async function(){
            try{
                this.tableData.draw++;
                let params = new URLSearchParams();
                params.append('page', this.pagination.current_page);
                params.append('draw', this.tableData.draw);
                params.append('length', this.tableData.length);
                params.append('search', this.tableData.search);
                params.append('column', this.tableData.column);
                params.append('dir', this.tableData.dir);

                await this.$store.dispatch('union/get_union', params);
            }catch(e) {
                console.log(e);
            }
        },

        deleteUnion: async function(union){
            try {
                let id = union.id;
                await this.$store.dispatch('union/delete_union', id).then(() => {
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
        },

        sortBy(key) {
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            this.tableData.column = this.getIndex(this.columns, 'name', key);
            this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
            this.getUnion();
        },

        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },
    },
};
</script>

<style>
.table {
    width: 100%;
    text-align: center;
    margin-bottom: 0.5%;
}
.add-Union{
   display:flex;
    justify-content: flex-end;
   margin-bottom: 3%;
}
.select{
   align-items:baseline;
}


button {
    outline: none;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    padding: 10px;
    color: #ffffff;
}
.Edit{
   padding: 5px 5px;
    color: #ffffff;
    background-color: #02cf4a;
    margin-right: 7px;
    font-size: 10px;
}
.delete{
   padding: 5px 5px;
    color: #ffffff;
    background-color: #f13535;
    font-size: 10px;
}
.add_new {
    padding: 10px 20px;
    color: #ffffff;
    background-color: #02cf4a;
    
}
.field{
   display: flex;
   align-items: center;
   justify-content: space-between;
   margin-bottom: 1%;
   
}

input {
    padding: 10px 20px;
    margin: 0 10px;
    outline: none;
    border: 1px solid #02cf4a;
    border-radius: 6px;
    color:black;
}
.select{
   margin-left: 0%;
   margin-bottom: 2%;
}
.select label input{
margin-left: 317%;
}

  table.dataTable th,
  table.dataTable td {
    white-space: nowrap;
    
  }
  table th{
     text-align: center;
  }
  .p {
    text-align: center;
    padding-top: 140px;
    font-size: 14px;
  }
  
.pagination {
  display: inline-block;
  /* margin-left: 70%;
  margin-top: 1%; */
}
.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  border: 1px solid #ddd;
}

.pagination a.active {
  background-color: #4CAF50;
  color: white;
  border: 1px solid #4CAF50;
}

.pagination a:hover:not(.active) {background-color: #ddd;}

.pagination a:first-child {
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}

.pagination a:last-child {
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
}
::placeholder {
    color: #0a0a0a;
}

::-webkit-scrollbar {
    height: 5px;
    width: 5px;
}

::-webkit-scrollbar-track {
    box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}

::-webkit-scrollbar-thumb {
    box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}
 


</style>