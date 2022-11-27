<template>
    <div id="ForgetPassword">
        <form action="" class="ForgetPassword-form">
            
            <img src="../../assets/My project.png" alt="Logo" width="100" height="100"><br><br>
            <!-- <h1>Forgot Password</h1> -->
 
            <div class="form-group">
                <input type="email" name="email" id="" placeholder="Enter email" class="box">
            </div>
 
            <button type="submit" class="btn btn-dark btn-lg btn-block" >Reset password</button>
 
        </form>
    </div>
</template>

<script>
export default {
    name: 'ForgetPassword'
   ,
   components: {
     
   },
   data() {
     return {
       
     }
   },
   computed: {
     
   },
   watch: {
     
   },
   mounted() {
     
   },
   methods: {
     
   }
};
</script>

<style scoped>
#ForgetPassword{
    display: flex;
    justify-content: center;
}
.login_heading{
    text-align: center;
    font-size: 2rem;
}
.ForgetPassword-form{
    width: 40rem;
    position: absolute;
    text-align: center;
    top: 20%;
    padding: 2rem;
    border-radius: .5rem;
    background: rgb(164, 232, 171);
    box-shadow: var(--box-shadow);
}

 .ForgetPassword-form .box{
    width: 100%;
    margin: .7rem 0;
    background: rgb(252, 250, 252);
    border-radius: .5rem;
    padding: 1rem;
    font-size: 1rem;
    color: var(--black);
    text-transform: none;
}

.ForgetPassword-form p{
    font-size: 1.4rem;
    padding: .5rem 0;
    color: var(--light-color);
}

.ForgetPassword-form p a{
    color: var(--orange);
    text-decoration: underline;
}

.btn{
    margin-top: 1rem;
    display: inline-block;
    padding: .5rem 2rem;
    font-size: 1rem;
    border-radius: .5rem;
    border: .2rem solid var(--black);
    color: var(--black);
    cursor: pointer;
    background: rgb(242, 242, 248);
}

.btn:hover{
    background: var(--orange);
    color: #fff;
}
</style>