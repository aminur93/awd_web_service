<template>
  <div id="dashboard">

   <div class="body">
	
	<!-- SIDEBAR -->
	<Sidebar :isActive="isActive"/>
	<!-- SIDEBAR -->

	<!-- NAVBAR -->
	<section id="content">
		<!-- NAVBAR -->
		<Top :isShow="isShow"  @Toggle="myToggle"/>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<h1 class="title">Welcome Admin</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Dashboard</a></li>
			</ul>

			<router-view></router-view>
		</main>
		<!-- MAIN -->
	</section>
	<!-- NAVBAR -->

	
    </div>
</div>
</template>

<script>
import Sidebar from '@/components/admin/Sidebar.vue';
import Top from '@/components/admin/Top.vue';
export default{
    name: "MyDashboard",
	components: { Sidebar, Top },
    data() {
        return {
            isActive: false,
            isShow: false,
        };
    },
    methods: {
        myToggle() {
            this.isActive = !this.isActive;
        }
    },
    
}
</script>

<style>
	/* SIDEBAR */

	#sidebar {
		position: fixed;
		max-width: 260px;
		width: 100%;
		background: var(--light);
		top: 0;
		left: 0;
		height: 100%;
		overflow-y: auto;
		scrollbar-width: none;
		transition: all .3s ease;
		z-index: 200;
	}
	#sidebar.hide {
		max-width: 0px;
	}
	#sidebar.hide:hover {
		max-width: 260px;
	}
	#sidebar::-webkit-scrollbar {
		display: 20rem;
		/* overflow-x: hidden;
        overflow-y: hidden; */
	}
	#sidebar .brand {
		font-size: 24px;
		display: flex;
		align-items: center;
		height: 64px;
		font-weight: 700;
		color: var(--light-green);
		position: sticky;
		top: 0;
		left: 0;
		z-index: 100;
		background: var(--light);
		transition: all .3s ease;
		padding: 0 25px;
		text-decoration: none;
	}
	#sidebar .icon {
		min-width: 48px;
		display: flex;
		justify-content: center;
		align-items: center;
		margin-right: 6px;
	}
	#sidebar .icon-right {
		margin-left: auto;
		transition: all .3s ease;
	}
	.sidebar-avartar {
		display: grid ;
		grid-template-columns: 70px auto;
		align-items: center;
		border: 2px solid var(--main-accent);
		padding: .1rem 0.7rem;
		border-radius: 7px;
		margin: 2rem 0rem;
		/* align-items: baseline; */
	}
	.avartar-info{
		display: flex;
		justify-content: space-between;
		align-items:center;
	}
	#sidebar .side-menu {
		margin: 36px 0;
		padding: 0 20px;
		transition: all .3s ease;
	}
	#sidebar.hide .side-menu {
		padding: 0 6px;
	}
	#sidebar.hide:hover .side-menu {
		padding: 0 20px;
	}
	#sidebar .side-menu a {
		display: flex;
		align-items: center;
		font-size: 14px;
		color: var(--dark);
		padding: 12px 16px 12px 0;
		transition: all .3s ease;
		border-radius: 10px;
		margin: 4px 0;
		white-space: nowrap;
	}
	/*a:hover{*/
		/**/
	/*}*/
	#sidebar .side-menu > li > a:hover {
		background: var(--grey);
		text-decoration: none;
	}
	#sidebar .side-menu > li > ul> li> a:hover {
		background: var(--grey);
	}
	#sidebar .side-menu > li > a.active .icon-right {
		transform: rotateZ(90deg);
	}
	#sidebar .side-menu > li > a.active,
	#sidebar .side-menu > li > a.active:hover {
		background: var(--grey);
		color: var(--black);
	}
	#sidebar .side-menu a.active{
		background: var(--grey);
	}
	#sidebar .divider {
		margin-top: 24px;
		font-size: 16px;
		text-indent: 15px;
		text-transform: uppercase;
		font-weight: 700;
		color: var(--dark-grey);
		transition: all .3s ease;
		white-space: nowrap;
	}
	#sidebar.hide:hover .divider {
		text-align: left;
	}
	/* #sidebar.hide .divider {
        text-align: center;
    } */
	#sidebar .side-dropdown {
		padding-left: 30px;
		max-height: 0;
		overflow-y: hidden;
		transition: all .15s ease;
	}
	#sidebar .side-dropdown.show {
		max-height: 1000px;
	}
	#sidebar .side-dropdown a:hover {
		color: var(--blue);
	}
	/* SIDEBAR */





	/* CONTENT */
	#content {
		position: relative;
		width: calc(100% - 260px);
		left: 260px;
		transition: all .3s ease;
	}
	#sidebar.hide + #content {
		width: calc(100% - 0px);
		left: 0px;
	}
	/* NAVBAR */
	nav {
		background: var(--light);
		height: 64px;
		padding: 0 20px;
		display: flex;
		align-items: center;
		grid-gap: 28px;
		position: sticky;
		top: 0;
		left: 0;
		z-index: 100;
	}
	nav .toggle-sidebar {
		font-size: 18px;
		cursor: pointer;
	}
	nav form {
		max-width: 400px;
		width: 100%;
		margin-right: auto;
		margin-top: 10px;
	}
	nav .form-group {
		position: relative;
	}
	nav .form-group input {
		width: 100%;
		background: var(--grey);
		border-radius: 5px;
		border: none;
		outline: none;
		padding: 10px 36px 10px 16px;
		transition: all .3s ease;
	}
	nav .form-group input:focus {
		box-shadow: 0 0 0 1px var(--blue), 0 0 0 4px var(--light-blue);
	}
	nav .form-group .icon {
		position: absolute;
		top: 50%;
		transform: translateY(-50%);
		right: 16px;
		color: var(--dark-grey);
	}
	nav .nav-link {
		position: relative;
	}
	nav .nav-link .icon {
		font-size: 18px;
		color: var(--dark);
	}
	nav .nav-link .badge {
		position: absolute;
		top: -12px;
		right: -12px;
		width: 20px;
		height: 20px;
		border-radius: 50%;
		border: 2px solid var(--light);
		background: var(--red);
		display: flex;
		justify-content: center;
		align-items: center;
		color: var(--light);
		font-size: 10px;
		font-weight: 700;
	}
	nav .divider {
		width: 1px;
		background: var(--grey);
		height: 12px;
		display: block;
	}
	nav .profile {
		position: relative;
	}
	nav .profile img {
		width: 36px;
		height: 36px;
		border-radius: 50%;
		object-fit: cover;
		cursor: pointer;
	}
	nav .profile .profile-link {
		position: absolute;
		top: calc(100% + 10px);
		right: 0;
		background: var(--light);
		padding: 10px 0;
		box-shadow: 4px 4px 16px rgba(0, 0, 0, .1);
		border-radius: 10px;
		width: 160px;
		opacity: 0;
		pointer-events: none;
		transition: all .3s ease;
	}
	nav .profile .profile-link.show {
		opacity: 1;
		pointer-events: visible;
		top: 100%;
	}
	nav .profile .profile-link a {
		padding: 10px 16px;
		display: flex;
		grid-gap: 10px;
		font-size: 14px;
		color: var(--dark);
		align-items: center;
		transition: all .3s ease;
	}
	nav .profile .profile-link a:hover {
		background: var(--grey);
		border-radius: 6px;
		text-decoration: none;
	}

	nav .message .profile-link {
		position: absolute;
		top: calc(100% + 10px);
		right: 0;
		background: var(--light);
		padding: 10px 0;
		box-shadow: 4px 4px 16px rgba(0, 0, 0, .1);
		border-radius: 10px;
		width: 260px;
		opacity: 0;
		pointer-events: none;
		transition: all .3s ease;
	}
	nav .message .profile-link.show {
		opacity: 1;
		pointer-events: visible;
		top: 100%;
		z-index: auto;
	}
	nav .message .profile-link a {
		padding: 10px 16px;
		display: flex;
		grid-gap: 10px;
		font-size: 14px;
		color: var(--dark);
		align-items: center;
		transition: all .3s ease;
	}
	nav .message .profile-link a:hover {
		background: var(--grey);
		text-decoration: none;
		border-radius: 6px;
	}
	nav .message .profile-link img {
		width: 36px;
		height: 36px;
		border-radius: 50%;
		object-fit: cover;
		cursor: pointer;
	}

	nav .notification .profile-link {
		position: absolute;
		top: calc(100% + 10px);
		right: 0;
		background: var(--light);
		padding: 10px 0;
		box-shadow: 4px 4px 16px rgba(0, 0, 0, .1);
		border-radius: 10px;
		width: 260px;
		opacity: 0;
		pointer-events: none;
		transition: all .3s ease;
	}
	nav .notification .profile-link.show {
		opacity: 1;
		pointer-events: visible;
		top: 100%;
	}
	nav .notification .profile-link a {
		padding: 10px 16px;
		display: flex;
		grid-gap: 10px;
		font-size: 14px;
		color: var(--dark);
		align-items: center;
		transition: all .3s ease;
	}
	nav .notification .profile-link a:hover {
		background: var(--grey);
		text-decoration: none;
		text-decoration: none;
		border-radius: 6px;
	}
	nav .notification .profile-link img {
		width: 36px;
		height: 36px;
		border-radius: 50%;
		object-fit: cover;
		cursor: pointer;
	}
	/* NAVBAR */



	/* MAIN */
	main {
		width: 100%;
		padding: 24px 20px 20px 20px;
	}
	main .title {
		font-size: 28px;
		font-weight: 600;
		margin-bottom: 10px;
	}
	main .breadcrumbs {
		display: flex;
		grid-gap: 6px;
	}
	main .breadcrumbs li,
	main .breadcrumbs li a {
		font-size: 14px;
	}
	main .breadcrumbs li a {
		color: var(--blue);
	}
	main .breadcrumbs li a.active,
	main .breadcrumbs li.divider {
		color: var(--dark-grey);
		pointer-events: none;
	}
	main .info-data {
		margin-top: 36px;
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
		grid-gap: 20px;
	}
	main .info-data .card {
		padding: 20px;
		border-radius: 8px;
		background-color: lightcoral;
		box-shadow: 4px 4px 16px rgba(0, 0, 0, .05);
	}
	main .info-data .card1 {
		padding: 20px;
		border-radius: 8px;
		background-color: lightsalmon;
		box-shadow: 4px 4px 16px rgba(0, 0, 0, .05);
	}
	main .info-data .card2 {
		padding: 20px;
		border-radius: 8px;
		background-color: lightseagreen;
		box-shadow: 4px 4px 16px rgba(0, 0, 0, .05);
	}
	main .info-data .card3 {
		padding: 20px;
		border-radius: 8px;
		background-color: coral;
		box-shadow: 4px 4px 16px rgba(0, 0, 0, .05);
	}
	.small-box {
		border-radius: .25rem;
		box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
		display: block;
		margin-bottom: 20px;
		position: relative;
	}
	.bg-info{
		background-color: lightseagreen;
	}
	.bg-info1{
		background-color: green;
	}
	.bg-info2{
		background-color: #ff720a;
	}
	.bg-info3{
		background-color: red;
	}
	.small-box-footer {
		background-color: rgba(0,0,0,.1);
		color: rgba(255,255,255,.8);
		display: block;
		padding: 3px 0;
		position: relative;
		text-align: center;
		text-decoration: none;
		z-index: 10;
		margin-top: 44px;
	}
	main .card .head {
		display: flex;
		justify-content: space-between;
		align-items: flex-start;
	}
	main .small-box .head h2 {
		font-size: 24px;
		font-weight: 700;
		color:white;
		margin-left: 9px;
		margin-top: 28px;
	}
	main .small-box .head p {
		font-size: 16px;
		font-weight: 600;
		margin-left: 9px;
		margin-top: 13px;
	}
	main .card .head .icon {
		font-size: 50px;
		color: var(--blue);
	}
	main .card .head .icon.down {
		color: var(--red);
	}
	main .card .progress {
		display: block;
		margin-top: 24px;
		height: 10px;
		width: 100%;
		border-radius: 10px;
		background: var(--grey);
		overflow-y: hidden;
		position: relative;
		margin-bottom: 4px;
	}
	main .card .progress::before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		height: 100%;
		background: var(--blue);
		width: var(--value);
	}
	main .card .label {
		font-size: 14px;
		font-weight: 700;
	}
	main .data {
		display: flex;
		grid-gap: 20px;
		margin-top: 20px;
		flex-wrap: wrap;
	}
	main .data .content-data {
		flex-grow: 1;
		flex-basis: 400px;
		padding: 20px;
		background: var(--light-blue);
		border-radius: 10px;
		box-shadow: 4px 4px 16px rgba(0, 0, 0, .1);
	}
	main .content-data .head {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 24px;
	}
	main .content-data .head h3 {
		font-size: 20px;
		font-weight: 600;
	}
	main .content-data .head .menu {
		position: relative;
		display: flex;
		justify-content: center;
		align-items: center;
	}
	main .content-data .head .menu .icon {
		cursor: pointer;
	}
	main .content-data .head .menu-link {
		position: absolute;
		top: calc(100% + 10px);
		right: 0;
		width: 140px;
		background: var(--light-blue);
		border-radius: 10px;
		box-shadow: 4px 4px 16px rgba(0, 0, 0, .1);
		padding: 10px 0;
		z-index: 100;
		opacity: 0;
		pointer-events: none;
		transition: all .3s ease;
	}
	main .content-data .head .menu-link.show {
		top: 100%;
		opacity: 1;
		pointer-events: visible;
	}
	main .content-data .head .menu-link a {
		display: block;
		padding: 6px 16px;
		font-size: 14px;
		color: var(--dark);
		transition: all .3s ease;
	}
	main .content-data .head .menu-link a:hover {
		background: var(--grey);
	}
	main .content-data .chart {
		width: 100%;
		max-width: 100%;
		overflow-x: auto;
		scrollbar-width: none;
	}
	main .content-data .chart::-webkit-scrollbar {
		display: none;
	}

	main .chat-box {
		width: 100%;
		max-height: 360px;
		overflow-y: auto;
		scrollbar-width: none;
	}
	main .chat-box::-webkit-scrollbar {
		display: none;
	}
	main .chat-box .day {
		text-align: center;
		margin-bottom: 10px;
	}
	main .chat-box .day span {
		display: inline-block;
		padding: 6px 12px;
		border-radius: 20px;
		background: var(--light-blue);
		color: var(--blue);
		font-size: 12px;
		font-weight: 600;
	}
	main .chat-box .msg img {
		width: 28px;
		height: 28px;
		border-radius: 50%;
		object-fit: cover;
	}
	main .chat-box .msg {
		display: flex;
		grid-gap: 6px;
		align-items: flex-start;
	}
	main .chat-box .profile .username {
		font-size: 14px;
		font-weight: 600;
		display: inline-block;
		margin-right: 6px;
	}
	main .chat-box .profile .time {
		font-size: 12px;
		color: var(--dark-grey);
	}
	main .chat-box .chat p {
		font-size: 14px;
		padding: 6px 10px;
		display: inline-block;
		max-width: 400px;
		line-height: 150%;
	}
	main .chat-box .msg:not(.me) .chat p {
		border-radius: 0 5px 5px 5px;
		background: var(--blue);
		color: var(--light);
	}
	main .chat-box .msg.me {
		justify-content: flex-end;
	}
	main .chat-box .msg.me .profile {
		text-align: right;
	}
	main .chat-box .msg.me p {
		background: var(--grey);
		border-radius: 5px 0 5px 5px;
	}
	main form {
		margin-top: 6px;
	}
	main .form-group {
		width: 100%;
		display: block;
		grid-gap: 10px;
	}
	main .danger_text{
		float: left;
		color: red;
		font-weight: 600;
		margin-top: -.1rem;
	}
	main .form-group input {
		flex-grow: 1;
		padding: 10px 16px;
		border-radius: 5px;
		outline: none;
		background: var(--grey);
		border: none;
		transition: all .3s ease;
		width: 100%;
	}
	main .form-group input:focus {
		box-shadow: 0 0 0 1px var(--blue), 0 0 0 4px var(--light-blue);
	}
	main .btn-send {
		padding: 0 16px;
		background: var(--blue);
		border-radius: 5px;
		color: var(--light);
		cursor: pointer;
		border: none;
		transition: all .3s ease;
	}
	main .btn-send:hover {
		background: var(--dark-blue);
	}
	/* MAIN */
	/* CONTENT */
	@media screen and (max-width: 768px) {
		#content {
			position: relative;
			width: calc(100% - 60px);
			transition: all .3s ease;
		}
		nav .nav-link,
		nav .divider {
			display: none;
		}
	}

</style>
