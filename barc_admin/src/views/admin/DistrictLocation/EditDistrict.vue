<template>
    <div id="EditDistrict">
        <form class="EditDistrict-form" v-on:submit.prevent="editDistrict">
            <h2>Edit District</h2>
            <div class="form-group">
                <select  name="division_id" id="division_id" class="box" v-model="editDistrictList.division_id">
                    <option value="">Select Division</option>
                    <option v-for="(division, index) in divisions" :key="index" :value="division.id">{{division.name_en}}</option>
                </select>
            </div>
            <div class="form-group">
                <input type="name" v-model="editDistrictList.name_en" name="name_en" id="name_en" placeholder="Enter District Name(EN)" class="box">
            </div>
            <div class="form-group">
                <input type="name" v-model="editDistrictList.name_bn" name="name_bn" id="name_bn" placeholder="Enter District Name(BN)" class="box">
            </div>

            <div class="form-group">
                <input type="name" v-model="editDistrictList.code_en" name="code_en" id="code_en" placeholder="Enter District Name(EN)" class="box">

            </div>
            <div class="form-group">
                <input type="name" v-model="editDistrictList.code_bn" name="code_bn" id="code_bn" placeholder="Enter District Name(BN)" class="box">
            </div>

            <div class="button">
                <div>
                    <router-link to="/dashboard/district">
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
        name: 'MyEditDistrict',

        data(){
            return{
                errors: {}
            }
        },

        computed: {
            ...mapState({
                editDistrictList: state => state.district.district,
                divisions: state => state.division.divisions,
                message: state => state.district.success_message
            })
        },

        mounted(){
            this.getEditDistrict(this.$route.params.id);
            this.getAllDivision();
        },

        methods: {
            ...mapActions({
                getEditDistrict: 'district/edit_district',
                getAllDivision: 'division/get_all_division'
            }),

            editDistrict: async function(){
                try {
                    let id = this.$route.params.id;
                    let formData = new FormData();
                    formData.append('division_id', this.editDistrictList.division_id);
                    formData.append('name_en', this.editDistrictList.name_en);
                    formData.append('name_bn', this.editDistrictList.name_bn);
                    formData.append('code_en', this.editDistrictList.code_en);
                    formData.append('code_bn', this.editDistrictList.code_bn);
                    formData.append('_method', 'PUT');

                    await this.$store.dispatch('district/update_district', {id:id, data:formData}).then(() => {
                        this.$swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: this.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.getEditDistrict(this.$route.params.id);
                    })

                }catch (e) {
                    console.log(e);
                }
            }
        }
    }
</script>

<style scoped>

#EditDistrict{
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