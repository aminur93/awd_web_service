<template>
    <div id="AddCultivation">
        <form class="AddCultivation-form" v-on:submit.prevent="addCultivation">
             <h2>Add Cultivation</h2>  
            <div class="form-group">
                <input type="name" v-model="cultivationData.name" name="name" id="name" placeholder="Enter cultivation Name" class="box">
                <span v-if="errors.name" class="danger_text">{{errors.name[0]}}</span>
            </div>
            <div class="button">
                <div>
                    <router-link to="/dashboard/cultivation_category">
                        <button type="button"> Back </button>
                    </router-link>
                    <button type="submit"> Save </button>
                </div>

            </div>
           
            

        </form>
    </div>
</template>

<script>

import {mapState} from 'vuex';

export default {
    name: 'AddCultivation',

   components: {
     
   },

   data() {
     return {
       cultivationData:{
           image:'',
           name_en: '',
           name_bn: '',
           
       },

        errors: {}
     }
   },

   computed: {
       ...mapState({
           message: state => state.cultivation.success_message
       })
   },

   watch: {
     
   },

   mounted() {
     
   },

   methods: {
      
       addCultivation: async function(){
           try {
               let formData = new FormData();
               formData.append('name', this.cultivationData.name);
               

               await this.$store.dispatch('cultivation/add_cultivation', formData).then(() => {
                   this.$swal.fire({
                       toast: true,
                       position: 'top-end',
                       icon: 'success',
                       title: this.message,
                       showConfirmButton: false,
                       timer: 1500
                   });

                   this.cultivationData = {};
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

#AddCultivation{
    display: flex;
    justify-content: center;
    margin-top: 100rem;
}

.AddCultivation-form{
    width: 95%;
    position: absolute;
    text-align: center;
    top: 20%;
    padding: 2rem;
    border-radius: .5rem;
    background:#eee;
    box-shadow: var(--box-shadow);
}
.AddCultivation-form h2{
    display: flex;
    justify-content: left;
}
 .AddCultivation-form .box{
    width: 100%;
    margin: .7rem 0;
    background: rgb(252, 250, 252);
    border-radius: .5rem;
    padding: 1rem;
    font-size: 1rem;
    color: var(--black);
    text-transform: none;
}

.AddCultivation-form p{
    font-size: 1.4rem;
    padding: .5rem 0;
    color: var(--light-color);
}

.AddCultivation-form p a{
    color: var(--orange);
    text-decoration: underline;
}

button {
  padding: 7px 7px;
  background-color: rgb(59, 155, 59);
  margin-right: 2%;
  
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

</style>