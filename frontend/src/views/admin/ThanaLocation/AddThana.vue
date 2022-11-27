<template>
    <div id="AddThana">
        <form  class="AddThana-form" v-on:submit.prevent="addThana">
                 <h3>Add Thana</h3>
            <div class="form-group">
                <select  name="District_id" id="district" class="box" v-model="thanaData.district_id">
                       <option value="">Select District</option>
                       <option v-for="(district, index) in Districts" :key="index" :value="district.id">{{district.name_en}}</option>
                </select>
                <span v-if="errors.District_id" class="danger_text">{{errors.District_id[0]}}</span>
            </div>
            <div class="form-group">
                <input type="name" v-model="thanaData.name_en" name="name_en" id="" placeholder="Enter Thana Name(EN)" class="box">
                <span v-if="errors.name_en" class="danger_text">{{errors.name_en[0]}}</span>
            </div>
            <div class="form-group">
                <input type="name" v-model="thanaData.name_bn" name="name_bn" id="" placeholder="Enter Thana Name(BN)" class="box">
                <span v-if="errors.name_bn" class="danger_text">{{errors.name_bn[0]}}</span>
            </div>
            <div class="form-group">
                <input type="text" v-model="thanaData.code_en" name="code_en" id="" placeholder="Enter Thana Code(EN)" class="box">
                <span v-if="errors.code_en" class="danger_text">{{errors.code_en[0]}}</span>
            </div>
            <div class="form-group">
                <input type="text" v-model="thanaData.code_bn" name="code_bn" id="" placeholder="Enter Thana Code(BN)" class="box">
                <span v-if="errors.code_bn" class="danger_text">{{errors.code_bn[0]}}</span>
            </div>
 
            <div class="button">
                <div>
                    <button type="submit"> Back </button>
                    <button type="submit"> Save </button>
                </div>
                <!--<level>-->
                    <!--<button type="submit"> Save </button>-->
                <!--</level>-->
            </div>
           
 
        </form>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    name: 'AddThana'
   ,
   components: {
     
   },
   data() {
     return {
         thanaData:{
             district_id:'',
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
         Districts: state => state.district.districts,
         message: state => state.thana.success_message
     })
   },
   watch: {
     
   },
   mounted() {
     this.get__all_district();
   },
   methods: {

       ...mapActions({
           get__all_district: 'district/get_all_district'
       }),
       
       addThana: async function(){
           try{
               let formData = new FormData();
               formData.append('district_id', this.thanaData.district_id);
               formData.append('name_en', this.thanaData.name_en);
               formData.append('name_bn', this.thanaData.name_bn);
               formData.append('code_en', this.thanaData.code_en);
               formData.append('code_bn', this.thanaData.code_bn);

               await this.$store.dispatch('thana/add_thana', formData).then(() => {
                   this.$swal.fire({
                       toast: true,
                       position: 'top-end',
                       icon: 'success',
                       title: this.message,
                       showConfirmButton: false,
                       timer: 1500
                   });

                   this.thanaData = {};
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
#AddThana{
    display: flex;
    justify-content: center;
    margin-top: 100rem;
}

.AddThana-form{
    width: 95%;
    position: absolute;
    text-align: center;
    top: 20%;
    padding: 2rem;
    border-radius: .5rem;
    background:#eee;
    box-shadow: var(--box-shadow);
}
.AddThana-form h3{
    display: flex;
    justify-content: left;
}
 .AddThana-form .box{
    width: 100%;
    margin: .7rem 0;
    background: rgb(252, 250, 252);
    border-radius: .5rem;
    padding: 1rem;
    font-size: 12px;
    color: var(--black);
    text-transform: none;
}

.AddThana-form p{
    font-size: 1.4rem;
    padding: .5rem 0;
    color: var(--light-color);
}

.AddThana-form p a{
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