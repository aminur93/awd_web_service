<template>
    <div id="AddDistrict">
        <form  class="AddDistrict-form" v-on:submit.prevent="addDistrict">
                 <h3>Add District</h3>
            <div class="form-group">
                <select  name="division_id" id="division_id" class="box" v-model="districtData.division_id">
                    <option value="">Select Division</option>
                    <option v-for="(division, index) in divisions" :key="index" :value="division.id">{{division.name_en}}</option>
                </select>
                <span v-if="errors.division_id" class="danger_text">{{errors.division_id[0]}}</span>
            </div>
            <div class="form-group">
                <input type="name" v-model="districtData.name_en" name="name_en" id="name_en" placeholder="Enter District Name(EN)" class="box">
                <span v-if="errors.name_en" class="danger_text">{{errors.name_en[0]}}</span>
            </div>
            <div class="form-group">
                <input type="name" v-model="districtData.name_bn" name="name_bn" id="name_bn" placeholder="Enter District Name(BN)" class="box">
                <span v-if="errors.name_bn" class="danger_text">{{errors.name_bn[0]}}</span>
            </div>
            <div class="form-group">
                <input type="text" v-model="districtData.code_en" name="code_en" id="code_en" placeholder="Enter District Code(EN)" class="box">
                <span v-if="errors.code_en" class="danger_text">{{errors.code_en[0]}}</span>
            </div>
            <div class="form-group">
                <input type="text" v-model="districtData.code_bn" name="code_bn" id="code_bn" placeholder="Enter District Code(BN)" class="box">
                <span v-if="errors.code_bn" class="danger_text">{{errors.code_bn[0]}}</span>
            </div>
 
            <div class="button">
                <div>
                    <router-link to="/dashboard/district">
                        <button type="button"> Back </button>
                    </router-link>

                    <button type="submit"> Save </button>
                </div>
            </div>
           
 
        </form>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    name: 'AddDistrict',

   components: {
     
   },

   data() {
     return {
         districtData:{
             division_id:'',
             name_en:'',
             name_bn:'',
             code_en:'',
             code_bn:''
         },
         errors: {}
       
     }
   },

   computed: {
     ...mapState({
         divisions: state => state.division.divisions,
         message: state => state.district.success_message
     })
   },

   watch: {
     
   },

   mounted() {
     this.getAllDivision();
   },

   methods: {
       ...mapActions({
           getAllDivision: 'division/get_all_division'
       }),

       addDistrict: async function(){
           try{
               let formData = new FormData();
               formData.append('division_id', this.districtData.division_id);
               formData.append('name_en', this.districtData.name_en);
               formData.append('name_bn', this.districtData.name_bn);
               formData.append('code_en', this.districtData.code_en);
               formData.append('code_bn', this.districtData.code_bn);

               await this.$store.dispatch('district/add_district', formData).then(() => {
                   this.$swal.fire({
                       toast: true,
                       position: 'top-end',
                       icon: 'success',
                       title: this.message,
                       showConfirmButton: false,
                       timer: 1500
                   });

                   this.districtData = {};
               })
               
           }catch (e) {
               switch (e.response.status)
               {
                   case 422:
                       this.errors = e.response.data.errors;
                       break;
                   default:
                       this.$swal.fire({
                           icon: 'error',
                           text: 'Oops',
                           title: e.response.data.error,
                       });
                       break;
               }
           }
       }
     
   }
};
</script>

<style scoped>
#AddDistrict{
    display: flex;
    justify-content: center;
    margin-top: 100rem;
}

.AddDistrict-form{
    width: 95%;
    position: absolute;
    text-align: center;
    top: 20%;
    padding: 2rem;
    border-radius: .5rem;
    background:#eee;
    box-shadow: var(--box-shadow);
}
.AddDistrict-form h3{
    display: flex;
    justify-content: left;
}
 .AddDistrict-form .box{
    width: 100%;
    margin: .7rem 0;
    background: rgb(252, 250, 252);
    border-radius: .5rem;
    padding: 1rem;
    font-size: 12px;
    color: var(--black);
    text-transform: none;
}

.AddDistrict-form p{
    font-size: 1.4rem;
    padding: .5rem 0;
    color: var(--light-color);
}

.AddDistrict-form p a{
    color: var(--orange);
    text-decoration: underline;
}
button {
  padding: 7px 7px;
  background-color: rgb(59, 155, 59);
  margin-left: 2%;
}

button:hover{
    background: var(--orange);
    color: #fff;
}
.button{
    margin-left: 89%;
}
::placeholder{
    font-size: 12px;
}
.selection option.text{
    font-size: 12px;
}
</style>