<template>
    <div id="edit_union">
        <form action="" class="AddUnion-form" v-on:submit.prevent="editUnion">
            <h3>Edit Union</h3>

            <div class="form-group">
                <select  name="village_id" id="village_id" class="box" v-model="edit_union.village_id">
                    <option value="">Select Village</option>
                    <option v-for="(village, index) in villages" :key="index" :value="village.id">{{village.name_en}}</option>
                </select>
            </div>

            <div class="form-group">
                <input type="name" v-model="edit_union.name_en" name="name(en)" id="name_en" placeholder="Enter Union Name(EN)" class="box">
            </div>

            <div class="form-group">
                <input type="name" v-model="edit_union.name_bn" name="name(bn)" id="name_bn" placeholder="Enter Union Name(BN)" class="box">
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
        name: 'EditUnion',

        data(){
            return{
                errors: {}
            }
        },

        computed:{
            ...mapState({
                edit_union: state => state.union.union,
                villages: state => state.village.villages,
                message: state => state.union.success_message
            })
        },

        mounted(){
            this.getVillage();
            this.getEditUnion(this.$route.params.id);
        },

        methods: {
            ...mapActions({
                getVillage: 'village/get_all_village',
                getEditUnion: 'union/get_edit_union'
            }),

            editUnion: async function(){
                try {
                    let id = this.$route.params.id;
                    let formData = new FormData();

                    formData.append('village_id', this.edit_union.village_id);
                    formData.append('name_en', this.edit_union.name_en);
                    formData.append('name_bn', this.edit_union.name_bn);
                    formData.append('_method', 'PUT');

                    await this.$store.dispatch('union/update_union', {id:id, data:formData}).then(() => {
                        this.$swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: this.message,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        this.getEditUnion(this.$route.params.id);
                    })
                }catch (e) {
                    console.log(e);
                }
            }
        }
    }
</script>

<style scoped>
    #edit_union{
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