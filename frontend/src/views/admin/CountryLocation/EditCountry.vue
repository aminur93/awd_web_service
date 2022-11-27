<template>
    <div id="EditCountry">
        <form class="EditCountry-form" v-on:submit.prevent="editCountry">
            <h2>Edit Country</h2>
            <div class="form-group">
                <input type="name" v-model="editCountryList.name_en" name="name_en" id="name_en" placeholder="Enter Country Name(EN)" class="box">

            </div>
            <div class="form-group">
                <input type="name" v-model="editCountryList.name_bn" name="name_bn" id="name_bn" placeholder="Enter Country Name(BN)" class="box">
            </div>

            <div class="form-group">
                <input type="name" v-model="editCountryList.code_en" name="code_en" id="code_en" placeholder="Enter Country Name(EN)" class="box">

            </div>
            <div class="form-group">
                <input type="name" v-model="editCountryList.code_bn" name="code_bn" id="code_bn" placeholder="Enter Country Name(BN)" class="box">
            </div>

            <div class="button">
                <level>
                    <router-link to="/dashboard/country">
                        <button type="button"> Back </button>
                    </router-link>
                </level>

                <level>
                    <button type="submit"> Edit </button>
                </level>
            </div>

        </form>
    </div>
</template>

<script>
    import {mapState, mapActions} from 'vuex';

    export default {
        name: 'MyEditCountry',

        data(){
            return{
                errors: {}
            }
        },

        computed: {
            ...mapState({
                editCountryList: state => state.country.country,
                message: state => state.country.success_message
            })
        },

        mounted(){
            this.getEditCountry(this.$route.params.id);
        },

        methods: {
            ...mapActions({
                getEditCountry: 'country/edit_country'
            }),

            editCountry: async function(){
                try {
                    let id = this.$route.params.id;
                    let formData = new FormData();

                    formData.append('name_en', this.editCountryList.name_en);
                    formData.append('name_bn', this.editCountryList.name_bn);
                    formData.append('code_en', this.editCountryList.code_en);
                    formData.append('code_bn', this.editCountryList.code_bn);
                    formData.append('_method', 'PUT');

                    await this.$store.dispatch('country/update_country', {id:id, data:formData}).then(() => {
                        this.$swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: this.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.getEditCountry(this.$route.params.id);
                    })

                }catch (e) {
                    console.log(e);
                }
            }
        }
    }
</script>

<style scoped>
    .AddCountry-form{
        width: 96rem;
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

#EditCountry{
    display: flex;
    justify-content: center;
    margin-top: 100rem;
}

.EditCountry-form{
    width: 95%;
    position: absolute;
    text-align: center;
    top: 20%;
    padding: 2rem;
    border-radius: .5rem;
    background:#eee;
    box-shadow: var(--box-shadow);
}
.EditCountry-form h2{
    display: flex;
    justify-content: left;
}
 .EditCountry-form .box{
    width: 100%;
    margin: .7rem 0;
    background: rgb(252, 250, 252);
    border-radius: .5rem;
    padding: 1rem;
    font-size: 1rem;
    color: var(--black);
    text-transform: none;
}

.EditCountry-form p{
    font-size: 1.4rem;
    padding: .5rem 0;
    color: var(--light-color);
}

.EditCountry-form p a{
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