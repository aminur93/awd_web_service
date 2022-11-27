<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>

export default {
  name: 'App',
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600&display=swap');

:root{
    --blue: #1775F1;
    --light-blue: #D0E4FF;
    --dark-blue: #0C5FCD;
    --red: #FC3B56;
    --grey: #fbfefb;
    --light: #e9eefd;
    --main-text: #4b5876;
    --green: #81D43A;
    --orange:#ff7800;
    --black:#130f40;
    --dark-grey:#666;
    --dark: rgba(17, 17, 26, 0.1) 2px 2px 16px;
    --box-shadow:0 .5rem 1.5rem rgba(0,0,0,.1);
    --border:.2rem solid rgba(0,0,0,.1);
    --outline:.1rem solid rgba(0,0,0,.1);
    --outline-hover:.2rem solid var(--black);
}

*{
    font-family: 'Poppins', sans-serif;
    margin:0; padding:0;
    box-sizing: border-box;
    outline: none; border:none;
    text-decoration: none;
    text-transform: capitalize;
    transition: all .2s linear;
    list-style-type: none;
}
html{
    font-size: 62.5%;
    overflow-x: hidden;
    scroll-behavior: smooth;
    scroll-padding-top: 15rem;
}

body{
    background: var(--grey);
    overflow-x: hidden;
}


a {
	text-decoration: none;
}

li {
	list-style: none;
}
</style>
