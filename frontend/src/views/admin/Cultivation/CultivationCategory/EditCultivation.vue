<template>
    <div id="EditCultivation">
        <form class="EditCultivation-form" v-on:submit.prevent="editCultivation">
            <h2>Edit Cultivation</h2>
            <div class="form-group">
                <input type="name" v-model="editCultivationList.name" name="name" id="name_en" placeholder="Enter Cultivation Name" class="box">

            </div>

            <div class="button">
                <div>
                    <router-link to="/dashboard/cultivation_category">
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
        name: 'MyEditCultivation',

        data(){
            return{
                errors: {}
            }
        },

        computed: {
            ...mapState({
                editCultivationList: state => state.cultivation.cultivation,
                message: state => state.cultivation.success_message
            })
        },

        mounted(){
            this.getEditCultivation(this.$route.params.id);
        },

        methods: {
            ...mapActions({
                getEditCultivation: 'cultivation/edit_cultivation'
            }),

            editCultivation: async function(){
                try {
                    let id = this.$route.params.id;
                    let formData = new FormData();

                    formData.append('name', this.editCultivationList.name);
                    formData.append('_method', 'PUT');

                    await this.$store.dispatch('cultivation/update_cultivation', {id:id, data:formData}).then(() => {
                        this.$swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: this.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.getEditCultivation(this.$route.params.id);
                    })

                }catch (e) {
                    console.log(e);
                }
            }
        }
    }
</script>

<style scoped>
    .AddCultivation-form{
        width: 96rem;
        position: absolute;
        text-align: center;
        top: 20%;
        padding: 2rem;
        border-radius: .5rem;
        background:#eee;
        box-shadow: var(--box-shadow);
    }
    .AddCultivation-form h2{
        display: flex;
        justify-content: left;
    }
    .AddCultivation-form .box{
        width: 100%;
        margin: .7rem 0;
        background: rgb(252, 250, 252);
        border-radius: .5rem;
        padding: 1rem;
        font-size: 1rem;
        color: var(--black);
        text-transform: none;
    }

    .AddCultivation-form p{
        font-size: 1.4rem;
        padding: .5rem 0;
        color: var(--light-color);
    }

    .AddCultivation-form p a{
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

#EditCultivation{
    display: flex;
    justify-content: center;
    margin-top: 100rem;
}

.EditCultivation-form{
    width: 95%;
    position: absolute;
    text-align: center;
    top: 20%;
    padding: 2rem;
    border-radius: .5rem;
    background:#eee;
    box-shadow: var(--box-shadow);
}
.EditCultivation-form h2{
    display: flex;
    justify-content: left;
}
 .EditCultivation-form .box{
    width: 100%;
    margin: .7rem 0;
    background: rgb(252, 250, 252);
    border-radius: .5rem;
    padding: 1rem;
    font-size: 1rem;
    color: var(--black);
    text-transform: none;
}

.EditCultivation-form p{
    font-size: 1.4rem;
    padding: .5rem 0;
    color: var(--light-color);
}

.EditCultivation-form p a{
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