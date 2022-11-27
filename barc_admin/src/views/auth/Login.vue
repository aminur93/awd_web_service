<template>
    <div id="login">
        <form action="" class="login-form" v-on:submit.prevent="login">
            <img src="../../assets/My project.png" alt="Logo" width="100" height="100"><br><br>
            <input type="email" v-model="loginData.email" name="email" id="email" placeholder="Enter email" class="box">
            <input type="password" v-model="loginData.password" name="password" id="password" placeholder="Enter password" class="box">
            <p>Forget password ? <a href="/forget-password">Click here</a></p>
            <input type="submit" value="login now" class="btn">
        </form>
    </div>
</template>

<script>
export default{
    name : 'BarcLogin',

    data(){
        return{
            loginData:{
                email: '',
                password: ''
            },

            errors: {}
        }
    },

    methods: {
        login: async function(){
            try {
                let formData = new FormData();
                formData.append('email', this.loginData.email);
                formData.append('password', this.loginData.password);

                await this.$store.dispatch('login', formData).then(() => {
                    this.$router.push({ path: '/dashboard' });
                    this.loginData = {};
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
                            title: e.response.data.result,
                        });
                        break;
                }
            }
        }
    }
}
</script>

<style scoped>
#login{
    display: flex;
    justify-content: center;
}
.login_heading{
    text-align: center;
    font-size: 2rem;
}
.login-form{
    width: 40rem;
    position: absolute;
    text-align: center;
    top: 20%;
    padding: 2rem;
    border-radius: .5rem;
    background: rgb(164, 232, 171);
    box-shadow: var(--box-shadow);
}

.login-form .box{
    width: 100%;
    margin: .7rem 0;
    background: #eee;
    border-radius: .5rem;
    padding: 1rem;
    font-size: 1rem;
    color: var(--black);
    text-transform: none;
}

.login-form p{
    font-size: 1.4rem;
    padding: .5rem 0;
    color: var(--light-color);
}

.login-form p a{
    color: var(--orange);
    text-decoration: underline;
}

.btn{
    margin-top: 1rem;
    display: inline-block;
    padding: .8rem 3rem;
    font-size: 1.4rem;
    border-radius: .5rem;
    border: .2rem solid var(--black);
    color: var(--black);
    cursor: pointer;
    background: none;
}

.btn:hover{
    background: var(--orange);
    color: #fff;
}
</style>