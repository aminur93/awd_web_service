<template>
    <div id="AddCrop">
        <form class="AddCrop-form" v-on:submit.prevent="addCrop">
             <h2>Add Crop</h2>

            <div class="form-group">
                <input type="name" v-model="cropData.name_en" name="name_en" id="name_en" placeholder="Enter crop Name(EN)" class="box">
                <span v-if="errors.name_en" class="danger_text">{{errors.name_en[0]}}</span>  
            </div>

            <div class="form-group">
                <input type="name" v-model="cropData.name_bn" name="name_bn" id="name_bn" placeholder="Enter crop Name(BN)" class="box">
                <span v-if="errors.name_bn" class="danger_text">{{errors.name_bn[0]}}</span>  
            </div>

            <div class="form-group">
                <input type="file" class="box" name="image" v-on:change="attachImage" ref="newCategoryImage">
                <span v-if="errors.image" class="danger_text">{{errors.image[0]}}</span>

                <br>

                <div class="image_show" v-if="cropData.image">
                    <img src="" ref="newCategoryImageDisplay" width="100px" height="100px">
                </div>

                <div v-else></div>
            </div>
            <div class="button">
                <div>
                    <router-link to="/dashboard/crop">
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
    name: 'AddCrop',

   components: {
     
   },

   data() {
     return {
       cropData:{
           image:'',
           name_en: '',
           name_bn: '',
           
       },

        errors: {}
     }
   },

   computed: {
       ...mapState({
           message: state => state.crop.success_message
       })
   },

   watch: {
     
   },

   mounted() {
     
   },

   methods: {

       addCrop: async function(){
           try {
               let formData = new FormData();
               formData.append('image', this.cropData.image);
               formData.append('name_en', this.cropData.name_en);
               formData.append('name_bn', this.cropData.name_bn);
               

               await this.$store.dispatch('crop/add_crop', formData).then(() => {
                   this.$swal.fire({
                       toast: true,
                       position: 'top-end',
                       icon: 'success',
                       title: this.message,
                       showConfirmButton: false,
                       timer: 1500
                   });

                   this.cropData = {};
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
       },

       attachImage: function(){
           //to use some file todo
           this.cropData.image = this.$refs.newCategoryImage.files[0];
           let reader = new FileReader();
           reader.addEventListener('load', function () {
               this.$refs.newCategoryImageDisplay.src = reader.result;
           }.bind(this),false);
           reader.readAsDataURL(this.cropData.image);
       },
   }
};
</script>

<style scoped>

#AddCrop{
    display: flex;
    justify-content: center;
    margin-top: 100rem;
}

.AddCrop-form{
    width: 95%;
    position: absolute;
    text-align: center;
    top: 20%;
    padding: 2rem;
    border-radius: .5rem;
    background:#eee;
    box-shadow: var(--box-shadow);
}
.AddCrop-form h2{
    display: flex;
    justify-content: left;
}
 .AddCrop-form .box{
    width: 100%;
    margin: .7rem 0;
    background: rgb(252, 250, 252);
    border-radius: .5rem;
    padding: 1rem;
    font-size: 1rem;
    color: var(--black);
    text-transform: none;
}

.AddCrop-form p{
    font-size: 1.4rem;
    padding: .5rem 0;
    color: var(--light-color);
}

.AddCrop-form p a{
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

    .image_show{
        float: left;
    }

</style>