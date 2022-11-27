<template>
    <div id="edit_department">
        <form class="AddCountry-form" v-on:submit.prevent="editDepartment">
            <h2>Add Department</h2>
            <div class="form-group">
                <input type="name" v-model="edit_department.name_en" name="name_en" id="name_en" placeholder="Enter Country Name(EN)" class="box">

            </div>
            <div class="form-group">
                <input type="name" v-model="edit_department.name_bn" name="name_bn" id="name_bn" placeholder="Enter Country Name(BN)" class="box">
            </div>

            <div class="button">
                <div>
                    <router-link to="/dashboard/department">
                        <button type="button"> Back </button>
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
        name: "EditDepartment",

        data(){
            return{
                errors: {}
            }
        },

        computed: {
            ...mapState({
                edit_department: state => state.department.department,
                message: state => state.department.success_message
            })
        },

        mounted(){
            this.getEditDepartment(this.$route.params.id);
        },

        methods: {
            ...mapActions({
                getEditDepartment: 'department/edit_department'
            }),

            editDepartment: async function(){
                try {
                    let id = this.$route.params.id;
                    let formData = new FormData();

                    formData.append('name_en', this.edit_department.name_en);
                    formData.append('name_bn', this.edit_department.name_bn);
                    formData.append('_method', 'PUT');

                    await this.$store.dispatch('department/update_department', {id:id, data:formData}).then(() => {
                        this.$swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: this.message,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        this.getEditDepartment(this.$route.params.id);
                    })
                }catch (e) {
                    console.log(e);
                }
            }
        }
    }
</script>

<style scoped>
    #edit_department{
        display: flex;
        justify-content: center;
        margin-top: 100rem;
    }

    .AddCountry-form{
        width: 95%;
        position: absolute;
        text-align: center;
        top: 20%;
        padding: 2rem;
        border-radius: .5rem;
        background:#eee;
        box-shadow: var(--box-shadow);
    }
    .AddCountry-form h2{
        display: flex;
        justify-content: left;
    }
    .AddCountry-form .box{
        width: 100%;
        margin: .7rem 0;
        background: rgb(252, 250, 252);
        border-radius: .5rem;
        padding: 1rem;
        font-size: 1rem;
        color: var(--black);
        text-transform: none;
    }

    .AddCountry-form p{
        font-size: 1.4rem;
        padding: .5rem 0;
        color: var(--light-color);
    }

    .AddCountry-form p a{
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