<template>
    <div id="EditThana">
        <form class="EditThana-form" v-on:submit.prevent="editThana">
            <h2>Edit Thana</h2>
            <div class="form-group">
                <select  name="District_id" id="district" class="box" v-model="editThanaList.district_id">
                       <option value="">Select District</option>
                       <option v-for="(district, index) in Districts" :key="index" :value="district.id">{{district.name_en}}</option>
                      
                </select>
            </div>
            <div class="form-group">
                <input type="name" v-model="editThanaList.name_en" name="name_en" id="name_en" placeholder="Enter Thana Name(EN)" class="box">

            </div>
            <div class="form-group">
                <input type="name" v-model="editThanaList.name_bn" name="name_bn" id="name_bn" placeholder="Enter Thana Name(BN)" class="box">
            </div>

            <div class="form-group">
                <input type="name" v-model="editThanaList.code_en" name="code_en" id="code_en" placeholder="Enter Thana Code(EN)" class="box">

            </div>
            <div class="form-group">
                <input type="name" v-model="editThanaList.code_bn" name="code_bn" id="code_bn" placeholder="Enter Thana Code(BN)" class="box">
            </div>

            <div class="button">
                <div>
                    <button type="submit"> Back </button>
                    <button type="submit"> Edit </button>
                </div>
                
            </div>

        </form>
    </div>
</template>

<script>
    import {mapState, mapActions} from 'vuex';

    export default {
        name: 'MyEditThana',

        data(){
            return{
                errors: {}
            }
        },

        computed: {
            ...mapState({
                editThanaList: state => state.thana.thana,
                Districts: state => state.district.districts,
                message: state => state.thana.success_message
            })
        },

        mounted(){
            this.getEditThana(this.$route.params.id);
            this.get__all_district();
        },

        methods: {
            ...mapActions({
                getEditThana: 'thana/edit_thana',
                get__all_district: 'district/get_all_district'
            }),

            editThana: async function(){
                try {
                    let id = this.$route.params.id;
                    let formData = new FormData();

                    formData.append('district_id', this.editThanaList.district_id);
                    formData.append('name_en', this.editThanaList.name_en);
                    formData.append('name_bn', this.editThanaList.name_bn);
                    formData.append('code_en', this.editThanaList.code_en);
                    formData.append('code_bn', this.editThanaList.code_bn);
                    formData.append('_method', 'PUT');

                    await this.$store.dispatch('thana/update_thana', {id:id, data:formData}).then(() => {
                        this.$swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: this.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.getEditThana(this.$route.params.id);
                    })

                }catch (e) {
                    console.log(e);
                }
            }
        }
    }
</script>

<style scoped>
    #EditThana{
        display: flex;
        justify-content: center;
        margin-top: 100rem;
    }

    .EditThana-form{
        width: 96%;
        position: absolute;
        text-align: center;
        top: 20%;
        padding: 2rem;
        border-radius: .5rem;
        background:#eee;
        box-shadow: var(--box-shadow);
    }
    .EditThana-form h2{
        display: flex;
        justify-content: left;
    }
    .EditThana-form .box{
        width: 100%;
        margin: .7rem 0;
        background: rgb(252, 250, 252);
        border-radius: .5rem;
        padding: 1rem;
        font-size: 1rem;
        color: var(--black);
        text-transform: none;
    }

    .EditThana-form p{
        font-size: 1.4rem;
        padding: .5rem 0;
        color: var(--light-color);
    }

    .EditThana-form p a{
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

</style>