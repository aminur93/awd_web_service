<template>
    <div id="edit_village">
        <form class="EditDistrict-form" v-on:submit.prevent="editThana">
            <h2>Edit Village</h2>
            <div class="form-group">
                <select  name="thana_id" id="thana_id" class="box" v-model="editVillageData.thana_id">
                    <option value="">Select Thana</option>
                    <option v-for="(thana, index) in thanas" :key="index" :value="thana.id">{{thana.name_en}}</option>
                </select>
            </div>
            <div class="form-group">
                <input type="name" v-model="editVillageData.name_en" name="name_en" id="name_en" placeholder="Enter District Name(EN)" class="box">
            </div>
            <div class="form-group">
                <input type="name" v-model="editVillageData.name_bn" name="name_bn" id="name_bn" placeholder="Enter District Name(BN)" class="box">
            </div>
            <div class="form-group">
                <input type="text" v-model="editVillageData.code_en" name="code_en" id="code_en" placeholder="Enter District Code(EN)" class="box">
            </div>
            <div class="form-group">
                <input type="text" v-model="editVillageData.code_bn" name="code_bn" id="code_bn" placeholder="Enter District Code(BN)" class="box">
            </div>

            <div class="button">
                <div>
                    <router-link to="/dashboard/village">
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
        name: "EditVillage",

        data(){
            return{
                errors: {}
            }
        },

        computed: {
            ...mapState({
                editVillageData: state => state.village.village,
                thanas: state => state.thana.thanas,
                message: state => state.village.success_message
            })
        },

        mounted(){
            this.getThana();
            this.getEditVillage(this.$route.params.id);
        },

        methods: {
            ...mapActions({
                getThana: 'thana/get_all_thana',
                getEditVillage: 'village/get_edit_village'
            }),

            editThana: async function(){
                try {
                    let id = this.$route.params.id;
                    let formData = new FormData();

                    formData.append('thana_id', this.editVillageData.thana_id);
                    formData.append('name_en', this.editVillageData.name_en);
                    formData.append('name_bn', this.editVillageData.name_bn);
                    formData.append('code_en', this.editVillageData.code_en);
                    formData.append('code_bn', this.editVillageData.code_bn);
                    formData.append('_method', 'PUT');

                    await this.$store.dispatch('village/update_village', {id:id, data:formData}).then(() => {
                        this.$swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: this.message,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        this.getEditVillage(id);
                    })
                }catch (e) {
                    console.log(e);
                }
            }
        }
    }
</script>

<style scoped>
    #edit_village{
        display: flex;
        justify-content: center;
        margin-top: 100rem;
    }

    .EditDistrict-form{
        width: 95%;
        position: absolute;
        text-align: center;
        top: 20%;
        padding: 2rem;
        border-radius: .5rem;
        background:#eee;
        box-shadow: var(--box-shadow);
    }
    .EditDistrict-form h2{
        display: flex;
        justify-content: left;
    }
    .EditDistrict-form .box{
        width: 100%;
        margin: .7rem 0;
        background: rgb(252, 250, 252);
        border-radius: .5rem;
        padding: 1rem;
        font-size: 1rem;
        color: var(--black);
        text-transform: none;
    }

    .EditDistrict-form p{
        font-size: 1.4rem;
        padding: .5rem 0;
        color: var(--light-color);
    }

    .EditDistrict-form p a{
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