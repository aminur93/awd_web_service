<template>
    <div id="top_bar">
        <nav>
            <i class='bx bx-menu toggle-sidebar' @click="$emit('Toggle')"></i>
            <form action="#">
                <div class="form-group">
                    <input type="text" placeholder="Search...">
                    <i class='bx bx-search icon'></i>
                </div>
            </form>
            <a href="#" class="nav-link">
                <div class="notification">
                    <i class='bx bxs-bell icon' @click="notificationDropdown()"></i>
                    <span class="badge">5</span>
                    <ul class="profile-link" v-bind:class="{show: isnotify}">
                        <li><a href="#"><i class='bx bxs-cog'></i><h5>Bred Hut <br> call me </h5></a></li>
                        <li><a href="#"><i class='bx bxs-bell'></i><h5>Bred Hut <br> do you want to </h5></a></li>
                        <li><a href="#"><i class='bx bxs-cog'></i><h5>Bred Hut <br> when you free </h5></a></li>
                    </ul>
                </div>
            </a>
            <a href="#" class="nav-link">
                <div class="message">
                    <i class='bx bxs-message-square-dots icon' @click="messageDropdown()"></i>
                    <span class="badge">8</span>
                    <ul class="profile-link" v-bind:class="{show: isdisplay}">
                        <li><a href="#"><img src="../../assets/My project.png"><h5>Bred Hut <br> call me.. &emsp; &emsp;
                            &emsp;&emsp;3h </h5></a></li>
                        <li><a href="#"><img src="../../assets/My project.png"><h5>Bred Hut <br> do you want to.. &emsp;&emsp;3h
                        </h5></a></li>
                        <li><a href="#"><img src="../../assets/My project.png"><h5>Bred Hut <br> when you free.. &emsp;
                            &emsp;&emsp;3h </h5></a></li>
                    </ul>
                </div>
            </a>
            <span class="divider"></span>
            <div class="profile" style="cursor:pointer;">
                <img src="../../assets/My project.png" alt="" @click="profileDropdown()">
                <ul class="profile-link" v-bind:class="{show: isshow}">
                    <li><a href="#"><i class='bx bxs-user-circle icon'></i> Profile</a></li>
                    <li><a href="#"><i class='bx bxs-cog'></i> Settings</a></li>
                    <li><a v-on:click="logout"><i class='bx bxs-log-out-circle'></i> Logout</a></li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>

    export default {
        name: 'MyTop',
        props: ['isShow'],


        data() {
            return {
                isshow: this.isShow,
                isdisplay: this.isDisplay,
                isnotify: this.isNotify,
            };
        },

        methods: {
            profileDropdown() {
                this.isshow = !this.isshow;
            },
            messageDropdown() {
                this.isdisplay = !this.isdisplay;
            },
            notificationDropdown() {
                this.isnotify = !this.isnotify;
            },

            logout: async function(){
                try {
                    await this.$store.dispatch('logout').then(() => {
                        this.$router.push({ path: '/' });
                    });
                }catch (e) {
                    console.log(e);
                }
            },
        },

    };
</script>
<style lang='' scoped>
</style>