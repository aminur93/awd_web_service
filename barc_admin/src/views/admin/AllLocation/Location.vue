<template>
   <div id="location">

        <div class="field">
          <div for="entries">Show:
             <select  name="entries" id="entries" v-model="tableData.length" @change="getAllLocation()">
                 <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
             </select>
             Entries
          </div>

          <div class="search">
              <input type="text" v-model="tableData.search" placeholder="Search Location" @input="getAllLocation()">
          </div>
        </div>

       <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
           <tbody>
            <tr v-show="locations.length" v-for="(location) in locations" :key="location.id">
                <td>{{ location.id }}</td>
                <td>{{ location.user_id }}</td>
                <td>{{ location.country_name_en }}</td>
                <td>{{ location.division_name_en }}</td>
                <td>{{ location.district_name_en }}</td>
                <td>{{ location.thana_name_en }}</td>
                <td>{{ location.village_name_en }}</td>
                <td>{{ location.post_code }}</td>
                <td>{{ location.poc_code }}</td>
                <td>{{ location.union_name_en }}</td>
            </tr>
           </tbody>
       </datatable>

        <div class="field">
            <div><h5> Showing {{ pagination.from }} to {{ pagination.to }} of {{ pagination.total }} entries</h5> </div>

            <pagination :pagination.sync="pagination" :offset="5" @paginate="getAllLocation();"></pagination>
        </div>
   </div>	
</template>

<script>
import DataTable from '../../../components/datatable/DataTable';
import Pagination from '../../../components/datatable/Pagination.vue';

import {mapState} from 'vuex';

import { http } from '../../../service/http_service';

export default {
   name: 'AllLocation',

   components: {
       datatable: DataTable,
       pagination: Pagination
   },

   data() {
       let sortOrders = {};
       let columns = [
           {label: '#Sl', name: 'id' },
           {label: 'User ID', name: 'user_id'},
           {label: 'Country', name: 'country_name_en'},
           {label: 'Division', name: 'division_name_en'},
           {label: 'District', name: 'district_name_en'},
           {label: 'Thana', name: 'thana_name_enaction'},
           {label: 'Village', name: 'village_name_en'},
           {label: 'Post Code', name: 'post_code'},
           {label: 'POC Code', name: 'poc_code'},
           {label: 'Union', name: 'union_name_en'},
       ];
       columns.forEach((column) => {
           sortOrders[column.name] = -1;
       });

       return {
           locations: [],
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
            
            message: state => state.location.success_message
        })
    },

    mounted(){
       this.getAllLocation();
    },

    methods: {

       getAllLocation(){

           this.tableData.draw++;
           let params = new URLSearchParams();
           params.append('page', this.pagination.current_page);
           params.append('draw', this.tableData.draw);
           params.append('length', this.tableData.length);
           params.append('search', this.tableData.search);
           params.append('column', this.tableData.column);
           params.append('dir', this.tableData.dir);

           return http().get('v1/location/getData?'+params)
               .then(response => {
                   this.locations = response.data.data.data;
                   this.pagination = response.data.data;
               })
               .catch(error => {
                   console.log(error);
               })
       },

        sortBy(key) {
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            this.tableData.column = this.getIndex(this.columns, 'name', key);
            this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
            this.getAllLocation();
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