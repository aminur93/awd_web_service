<template>
    <div id="edit_post_office">
        <form action="" class="AddPostOffice-form" v-on:submit.prevent="editPostOffice">
            <h3>Edit Post Office</h3>

            <div class="form-group">
                <select  name="village_id" id="village_id" class="box" v-model="GetEditPostOffice.village_id">
                    <option value="">Select Thana</option>
                    <option v-for="(village, index) in villages" :key="index" :value="village.id">{{village.name_en}}</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="post_code" v-model="GetEditPostOffice.post_code" id="" placeholder="Enter PostOffice Name(EN)" class="box">
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
        name: 'EditPostOffice',

        data(){
            return{
                errors: {}
            }
        },

        computed:{
            ...mapState({
                GetEditPostOffice: state => state.BarcPostOffice.Barc_post_office,
                villages: state => state.village.villages,
                message: state => state.BarcPostOffice.success_message
            })
        },

        mounted(){
            this.getVillage();
            this.getEditPostOffice(this.$route.params.id);
        },

        methods:{
            ...mapActions({
                getVillage: 'village/get_all_village',
                getEditPostOffice: 'BarcPostOffice/get_edit_post_office'
            }),

            editPostOffice: async function(){
                try {
                    let id = this.$route.params.id;
                    let formData = new FormData();

                    formData.append('village_id', this.GetEditPostOffice.village_id);
                    formData.append('post_code', this.GetEditPostOffice.post_code);
                    formData.append('_method', 'PUT');

                    await this.$store.dispatch('BarcPostOffice/update_post_office', {id:id, data:formData}).then(() => {
                        this.$swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: this.message,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        this.getEditPostOffice(this.$route.params.id);
                    })
                }catch (e) {
                    console.log(e);
                }
            }
        }
    }
</script>

<style scoped>
    #edit_post_office{
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