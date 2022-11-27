<template>
    <div id="add_po">
        <form action="" class="AddPostOffice-form" v-on:submit.prevent="addPo">
            <h3>Add Poc</h3>

            <div class="form-group">
                <select  name="post_office_id" id="post_office_id" class="box" v-model="pocData.post_office_id">
                    <option value="">Select Post Office</option>
                    <option v-for="(post_office, index) in postOffices" :key="index" :value="post_office.id">{{post_office.post_code}}</option>
                </select>
                <span v-if="errors.post_office_id" class="danger_text">{{errors.post_office_id[0]}}</span>
            </div>
            <div class="form-group">
                <input type="text" name="poc_code" v-model="pocData.poc_code" id="" placeholder="Enter Poc Code(EN)" class="box">
                <span v-if="errors.poc_code" class="danger_text">{{errors.poc_code[0]}}</span>
            </div>

            <div class="button">
                <div>
                    <router-link to="/dashboard/po">
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
        name: "AddPo",

        data(){
            return{
                pocData:{
                    post_office_id: '',
                    poc_code: ''
                },

                errors: {}
            }
        },

        computed: {
            ...mapState({
                postOffices: state => state.BarcPostOffice.Barc_post_offices,
                message: state => state.po.success_message
            })
        },

        mounted(){
            this.getAllPostOffice();
        },

        methods: {
            ...mapActions({
                getAllPostOffice: 'BarcPostOffice/get_all_post_office'
            }),

            addPo: async function(){
                try {
                    let formData = new FormData();

                    formData.append('post_office_id', this.pocData.post_office_id);
                    formData.append('poc_code', this.pocData.poc_code);

                    await this.$store.dispatch('po/add_po', formData).then(() => {
                        this.$swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: this.message,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        this.pocData = {};
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
    #add_po{
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