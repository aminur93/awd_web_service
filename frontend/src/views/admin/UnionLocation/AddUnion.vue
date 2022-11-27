<template>
    <div id="AddUnion">
        <form action="" class="AddUnion-form" v-on:submit.prevent="addUnion">
                 <h3>Add Union</h3>

            <div class="form-group">
                <select  name="village_id" id="village_id" class="box" v-model="unionData.village_id">
                    <option value="">Select Village</option>
                    <option v-for="(village, index) in villages" :key="index" :value="village.id">{{village.name_en}}</option>
                </select>
                <span v-if="errors.village_id" class="danger_text">{{errors.village_id[0]}}</span>
            </div>

            <div class="form-group">
                <input type="name" v-model="unionData.name_en" name="name(en)" id="name_en" placeholder="Enter Union Name(EN)" class="box">
                <span v-if="errors.name_en" class="danger_text">{{errors.name_en[0]}}</span>
            </div>

            <div class="form-group">
                <input type="name" v-model="unionData.name_bn" name="name(bn)" id="name_bn" placeholder="Enter Union Name(BN)" class="box">
                <span v-if="errors.name_bn" class="danger_text">{{errors.name_bn[0]}}</span>
            </div>
 
            <div class="button">
                <div>
                    <router-link to="/dashboard/union">
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
    name: 'AddUnion',

   components: {
     
   },

   data() {
     return {
       unionData: {
           village_id: '',
           name_en: '',
           name_bn: ''
       },
       errors:{}
     }
   },

   computed: {
       ...mapState({
           villages: state => state.village.villages,
           message: state => state.union.success_message
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

       addUnion: async function(){
           try {
               let formData = new FormData();

               formData.append('village_id', this.unionData.village_id);
               formData.append('name_en', this.unionData.name_en);
               formData.append('name_bn', this.unionData.name_bn);

               await this.$store.dispatch('union/add_union', formData).then(() => {
                   this.$swal.fire({
                       toast: true,
                       position: 'top-end',
                       icon: 'success',
                       title: this.message,
                       showConfirmButton: false,
                       timer: 1500
                   });

                   this.unionData = {};
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
#AddUnion{
    display: flex;
    justify-content: center;
    margin-top: 100rem;
}

.AddUnion-form{
    width: 95%;
    position: absolute;
    text-align: center;
    top: 20%;
    padding: 2rem;
    border-radius: .5rem;
    background:#eee;
    box-shadow: var(--box-shadow);
}
.AddUnion-form h3{
    display: flex;
    justify-content: left;
}
 .AddUnion-form .box{
    width: 100%;
    margin: .7rem 0;
    background: rgb(252, 250, 252);
    border-radius: .5rem;
    padding: 1rem;
    font-size: 12px;
    color: var(--black);
    text-transform: none;
}

.AddUnion-form p{
    font-size: 1.4rem;
    padding: .5rem 0;
    color: var(--light-color);
}

.AddUnion-form p a{
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