<template>
    <div id="EditCrop">
        <form class="EditCrop-form" v-on:submit.prevent="editCrop">
             <h2>edit Crop</h2>
            <div class="form-group">
                <input type="file" class="box" name="image" v-on:change="attachImage" ref="cropImage">            
            </div>  
            <div class="form-group">
                <input type="name" v-model="editCropList.name_en" name="name_en" id="name_en" placeholder="Enter crop Name(EN)" class="box">
            </div>
            <div class="form-group">
                <input type="name" v-model="editCropList.name_bn" name="name_bn" id="name_bn" placeholder="Enter crop Name(BN)" class="box">
            </div>
            <div class="button">
                <div>
                    <router-link to="/dashboard/crop">
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
        name: 'MyEditCrop',

        data(){
            return{
                errors: {},
                image: ''
            }
        },

        computed: {
            ...mapState({
                editCropList: state => state.crop.crop,
                message: state => state.crop.success_message
            })
        },

        mounted(){
            this.getEditCrop(this.$route.params.id);
            
        },

        methods: {
            ...mapActions({
                getEditCrop: 'crop/edit_crop'
            }),
            

            attachImage: function(){
                //to use some file todo
                this.image = this.$refs.cropImage.files[0];
                let reader = new FileReader();
                reader.addEventListener('load', function () {
                this.$refs.newCategoryImageDisplay.src = reader.result;
                }.bind(this),false);
                reader.readAsDataURL(this.file);
            },

            editCrop: async function(){
                try {
                    let id = this.$route.params.id;
                    let formData = new FormData();

                    formData.append('image', this.image);
                    formData.append('name_en', this.editCropList.name_en);
                    formData.append('name_bn', this.editCropList.name_bn);
                    formData.append('_method', 'PUT');

                    await this.$store.dispatch('crop/update_crop', {id:id, data:formData}).then(() => {
                        this.$swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: this.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.getEditCrop(this.$route.params.id);
                    })

                }catch (e) {
                    console.log(e);
                }
            }
        }
    }
</script>

<style scoped>
    .EditCrop-form{
        width: 96rem;
        position: absolute;
        text-align: center;
        top: 20%;
        padding: 2rem;
        border-radius: .5rem;
        background:#eee;
        box-shadow: var(--box-shadow);
    }
    .EditCrop-form h2{
        display: flex;
        justify-content: left;
    }
    .EditCrop-form .box{
        width: 100%;
        margin: .7rem 0;
        background: rgb(252, 250, 252);
        border-radius: .5rem;
        padding: 1rem;
        font-size: 1rem;
        color: var(--black);
        text-transform: none;
    }

    .EditCrop-form p{
        font-size: 1.4rem;
        padding: .5rem 0;
        color: var(--light-color);
    }

    .EditCrop-form p a{
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

#EditCrop{
    display: flex;
    justify-content: center;
    margin-top: 100rem;
}

.EditCrop-form{
    width: 95%;
    position: absolute;
    text-align: center;
    top: 20%;
    padding: 2rem;
    border-radius: .5rem;
    background:#eee;
    box-shadow: var(--box-shadow);
}
.EditCrop-form h2{
    display: flex;
    justify-content: left;
}
 .EditCrop-form .box{
    width: 100%;
    margin: .7rem 0;
    background: rgb(252, 250, 252);
    border-radius: .5rem;
    padding: 1rem;
    font-size: 1rem;
    color: var(--black);
    text-transform: none;
}

.EditCrop-form p{
    font-size: 1.4rem;
    padding: .5rem 0;
    color: var(--light-color);
}

.EditCrop-form p a{
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