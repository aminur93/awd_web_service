<template>
    <div id="add_department">
        <form class="AddCountry-form" v-on:submit.prevent="addDepartment">
            <h2>Add Department</h2>
            <div class="form-group">
                <input type="name" v-model="departmentData.name_en" name="name_en" id="name_en" placeholder="Enter Country Name(EN)" class="box">
                <span v-if="errors.name_en" class="danger_text">{{errors.name_en[0]}}</span>
            </div>
            <div class="form-group">
                <input type="name" v-model="departmentData.name_bn" name="name_bn" id="name_bn" placeholder="Enter Country Name(BN)" class="box">
                <span v-if="errors.name_bn" class="danger_text">{{errors.name_bn[0]}}</span>
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
    import {mapState} from 'vuex';

    export default {
        name: "AddDepartment",

        data(){
            return{
                departmentData: {
                    name_en: '',
                    name_bn: ''
                },
                errors:{}
            }
        },

        computed: {
            ...mapState({
                message: state => state.department.success_message
            })
        },

        methods: {
            addDepartment: async function(){
                try {
                    let formData = new FormData();

                    formData.append('name_en', this.departmentData.name_en);
                    formData.append('name_bn', this.departmentData.name_bn);

                    await this.$store.dispatch('department/add_department', formData).then(() => {
                        this.$swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: this.message,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        this.departmentData = {};
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
        }
    }
</script>

<style scoped>
    #add_department{
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