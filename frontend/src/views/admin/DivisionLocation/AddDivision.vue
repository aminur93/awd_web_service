<template>
    <div id="AddDivision">
        <form  class="AddDivision-form" v-on:submit.prevent="addDivision">
                 <h3>Add Division</h3>
            <div class="form-group">
                <select  name="Country_id" id="country" class="box" v-model="divisionData.country_id">
                       <option value="">Select Country</option>
                       <option v-for="(country, index) in Countries" :key="index" :value="country.id">{{country.name_en}}</option>
                      
                </select>
            </div>
            <div class="form-group">
                <input type="name" v-model="divisionData.name_en" name="name_en" id="" placeholder="Enter Division Name(EN)" class="box">
                <span v-if="errors.name_en" class="danger_text">{{errors.name_en[0]}}</span>
            </div>
            <div class="form-group">
                <input type="name" v-model="divisionData.name_bn" name="name_bn" id="" placeholder="Enter Division Name(BN)" class="box">
                <span v-if="errors.name_bn" class="danger_text">{{errors.name_bn[0]}}</span>
            </div>
            <div class="form-group">
                <input type="text" v-model="divisionData.code_en" name="code_en" id="" placeholder="Enter Division Code(EN)" class="box">
                <span v-if="errors.code_en" class="danger_text">{{errors.code_en[0]}}</span>
            </div>
            <div class="form-group">
                <input type="text" v-model="divisionData.code_bn" name="code_bn" id="" placeholder="Enter Division Code(BN)" class="box">
                <span v-if="errors.code_bn" class="danger_text">{{errors.code_bn[0]}}</span>
            </div>
 
            <div class="button">
                <router-link to="/dashboard/division">
                        <button type="button"> Back </button>
                    </router-link>
                    <button type="submit"> Save </button>
            </div>
           
 
        </form>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    name: 'AddDivision'
   ,
   components: {
     
   },
   data() {
     return {
         divisionData:{
             country_id:'',
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
         Countries: state => state.country.countries,
         message: state => state.division.success_message
     })
   },
   watch: {
     
   },
   mounted() {
     this.get__all_country();
   },
   methods: {

       ...mapActions({
           'get__all_country': 'country/get_all_country'
       }),
       
       addDivision: async function(){
           try{
               let formData = new FormData();
               formData.append('country_id', this.divisionData.country_id);
               formData.append('name_en', this.divisionData.name_en);
               formData.append('name_bn', this.divisionData.name_bn);
               formData.append('code_en', this.divisionData.code_en);
               formData.append('code_bn', this.divisionData.code_bn);

               await this.$store.dispatch('division/add_division', formData).then(() => {
                   this.$swal.fire({
                       toast: true,
                       position: 'top-end',
                       icon: 'success',
                       title: this.message,
                       showConfirmButton: false,
                       timer: 1500
                   });

                   this.divisionData = {};
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
#AddDivision{
    display: flex;
    justify-content: center;
    margin-top: 100rem;
}

.AddDivision-form{
    width: 95%;
    position: absolute;
    text-align: center;
    top: 20%;
    padding: 2rem;
    border-radius: .5rem;
    background:#eee;
    box-shadow: var(--box-shadow);
}
.AddDivision-form h3{
    display: flex;
    justify-content: left;
}
 .AddDivision-form .box{
    width: 100%;
    margin: .7rem 0;
    background: rgb(252, 250, 252);
    border-radius: .5rem;
    padding: 1rem;
    font-size: 12px;
    color: var(--black);
    text-transform: none;
}

.AddDivision-form p{
    font-size: 1.4rem;
    padding: .5rem 0;
    color: var(--light-color);
}

.AddDivision-form p a{
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