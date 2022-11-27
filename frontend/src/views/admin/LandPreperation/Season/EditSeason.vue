<template>
    <div id="EditSeason">
        <form class="EditSeason-form" v-on:submit.prevent="editSeasion">
            <h2>Edit Seasion</h2>
            <div class="form-group">
                <input type="name" v-model="editSeasionList.name_en" name="name_en" id="name_en" placeholder="Enter Season Name(EN)" class="box">
            </div>
            <div class="form-group">
                <input type="name" v-model="editSeasionList.name_bn" name="name_bn" id="name_bn" placeholder="Enter Season Name(BN)" class="box">
            </div>
            <div class="form-group">
                <input type="name" v-model="editSeasionList.cultural_operation" name="cultural_operation" id="" placeholder="Enter Cultural Operation Name(EN)" class="box">
            </div>

            <div class="form-group">
                <input type="date" v-model="editSeasionList.start_date" name="start_date" id="code_en" placeholder="Enter Start Date" class="box">

            </div>
            <div class="form-group">
                <input type="date" v-model="editSeasionList.end_date" name="end_date" id="code_bn" placeholder="Enter End Date" class="box">
            </div>

            <div class="button">
                <div>
                     <router-link to="/dashboard/season">
                        <button type="button"> Back </button>
                    </router-link>
                    <button type="submit"> Edit </button>
                </div>
            </div>
           

        </form>
    </div>
</template>

<script>
    import {mapState, mapActions} from 'vuex';

    export default {
        name: 'MyEditSeason',

        data(){
            return{
                errors: {}
            }
        },

        computed: {
            ...mapState({
                editSeasionList: state => state.seasion.seasion,
                message: state => state.seasion.success_message
            })
        },

        mounted(){
            this.getEditSeasion(this.$route.params.id);
        },

        methods: {
            ...mapActions({
                getEditSeasion: 'seasion/edit_seasion'
            }),

            editSeasion: async function(){
                try {
                    let id = this.$route.params.id;
                    let formData = new FormData();

                    formData.append('name_en', this.editSeasionList.name_en);
                    formData.append('name_bn', this.editSeasionList.name_bn);
                    formData.append('cultural_operation', this.editSeasionList.cultural_operation)
                    formData.append('start_date', this.editSeasionList.start_date);
                    formData.append('end_date', this.editSeasionList.end_date);
                    formData.append('_method', 'PUT');

                    await this.$store.dispatch('seasion/update_seasion', {id:id, data:formData}).then(() => {
                        this.$swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: this.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.getEditSeasion(this.$route.params.id);
                    })

                }catch (e) {
                    console.log(e);
                }
            }
        }
    }
</script>

<style scoped>

#EditSeason{
    display: flex;
    justify-content: center;
    margin-top: 100rem;
}

.EditSeason-form{
    width: 95%;
    position: absolute;
    text-align: center;
    top: 20%;
    padding: 2rem;
    border-radius: .5rem;
    background:#eee;
    box-shadow: var(--box-shadow);
}
.EditSeason-form h2{
    display: flex;
    justify-content: left;
}
 .EditSeason-form .box{
    width: 100%;
    margin: .7rem 0;
    background: rgb(252, 250, 252);
    border-radius: .5rem;
    padding: 1rem;
    font-size: 1rem;
    color: var(--black);
    text-transform: none;
}

.EditSeason-form p{
    font-size: 1.4rem;
    padding: .5rem 0;
    color: var(--light-color);
}

.EditSeason-form p a{
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