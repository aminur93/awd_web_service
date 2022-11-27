<template>
    <div id="AddPostOffice">
        <form action="" class="AddPostOffice-form" v-on:submit.prevent="addPostOffice">
             <h3>Add PostOffice</h3>

            <div class="form-group">
                <select  name="village_id" id="village_id" class="box" v-model="postOfficeData.village_id">
                    <option value="">Select Village</option>
                    <option v-for="(village, index) in villages" :key="index" :value="village.id">{{village.name_en}}</option>
                </select>
                <span v-if="errors.village_id" class="danger_text">{{errors.village_id[0]}}</span>
            </div>
            <div class="form-group">
                <input type="text" name="post_code" v-model="postOfficeData.post_code" id="" placeholder="Enter PostOffice Name(EN)" class="box">
                <span v-if="errors.post_code" class="danger_text">{{errors.post_code[0]}}</span>
            </div>
 
            <div class="button">
                <div>
                    <router-link to="/dashboard/post_office">
                        <button type="submit"> Back </button>
                    </router-link>

                    <button type="submit"> Save </button>
                </div>
            </div>
           
 
        </form>
    </div>
</template>

<script>
    import {mapState, mapActions} from 'vuex';

export default {
    name: 'AddPostOffice'
   ,
   components: {
     
   },
   data() {
     return {
       postOfficeData:{
           village_id: '',
           post_code: '',
       },

        errors: {}
     }
   },
   computed: {
       ...mapState({
           villages: state => state.village.villages,
           message: state => state.BarcPostOffice.success_message
       })
   },
   watch: {
     
   },
   mounted() {
     this.getVillage();
   },
   methods: {
       ...mapActions({
           getVillage: 'village/get_all_village'
       }),

       addPostOffice: async function(){
          try {
              let formData = new FormData();

              formData.append('village_id', this.postOfficeData.village_id);
              formData.append('post_code', this.postOfficeData.post_code);

              await this.$store.dispatch('BarcPostOffice/add_post_office', formData).then(() => {
                  this.$swal.fire({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      title: this.message,
                      showConfirmButton: false,
                      timer: 1500
                  });

                  this.postOfficeData = {};
              })
          } catch (e) {
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
#AddPostOffice{
    display: flex;
    justify-content: center;
    margin-top: 100rem;
}

.AddPostOffice-form{
    width: 95%;
    position: absolute;
    text-align: center;
    top: 20%;
    padding: 2rem;
    border-radius: .5rem;
    background:#eee;
    box-shadow: var(--box-shadow);
}
.AddPostOffice-form h3{
    display: flex;
    justify-content: left;
}
 .AddPostOffice-form .box{
    width: 100%;
    margin: .7rem 0;
    background: rgb(252, 250, 252);
    border-radius: .5rem;
    padding: 1rem;
    font-size: 12px;
    color: var(--black);
    text-transform: none;
}

.AddPostOffice-form p{
    font-size: 1.4rem;
    padding: .5rem 0;
    color: var(--light-color);
}

.AddPostOffice-form p a{
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

</style>