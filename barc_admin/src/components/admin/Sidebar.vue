<template>
	<section id="sidebar" v-bind:class="{hide: this.isActive}">

		<router-link to="/dashboard" class="brand"> BARC </router-link>
		<div class="sidebar-avartar">
			<div>
				<img src="../../assets/My project.png" width="70px" height="70px" alt=""  >
			</div>
			<div class="avartar-info">
				<div class="avartar-text">
					<h4>{{ user_Info.name }}</h4>
					<small>{{ user_Info.email }}</small>
				</div>
				<span class="bx bx-chevron-down icon"></span>
			</div>
		</div>
		<ul class="side-menu">
			<li>
				<router-link active-class="active" to="/dashboard" exact><i class='bx bxs-chart icon' ></i> Dashboard </router-link>
			</li>

			<li class="divider" data-text="location">Location</li>
			<li>
				<a ><i class='bx bxs-location-plus icon'></i> Location <i class='bx bx-chevron-right icon-right'  @click="menuDropdown()"></i></a>
				<ul class="side-dropdown" v-bind:class="{show: isshow}">
					<li>
						<router-link active-class="active" to="/dashboard/country" ><i class='bx bx-plus icon'></i> Country</router-link>
					</li>

					<li>
						<router-link active-class="active" to="/dashboard/division"><i class='bx bx-plus icon' ></i> Division</router-link></li>
					<li>
						<router-link active-class="active" to="/dashboard/district"><i class='bx bx-plus icon' ></i> District</router-link>
					</li>

					<li>
						<router-link active-class="active" to="/dashboard/thana"><i class='bx bx-plus icon' ></i> Thana</router-link>
					</li>

					<li>
						<router-link active-class="active" to="/dashboard/village"><i class='bx bx-plus icon' ></i> Village</router-link>
					</li>

					<li>
						<router-link active-class="active" to="/dashboard/post_office"><i class='bx bx-plus icon' ></i> Post-Office</router-link>
					</li>

					<li>
						<router-link active-class="active" to="/dashboard/po"><i class='bx bx-plus icon' ></i> Poc</router-link>
					</li>

					<li>
						<router-link active-class="active" to="/dashboard/union"><i class='bx bx-plus icon' ></i> Union</router-link>
					</li>

					<li>
						<router-link active-class="active" to="/dashboard/location"><i class='bx bx-plus icon' ></i>All Location</router-link>
					</li>


				</ul>
			</li>

			<li class="divider" data-text="location">Land-Size </li>

			<li>
				<router-link active-class="active" to="/dashboard/land_size"><i class='bx bxs-landmark icon' ></i> Land Size</router-link>
			</li>
			<li class="divider" data-text="location">Land Preperation </li>
			<li>
				<a><i class='bx bx-building-house icon'></i> Land Preperation <i class='bx bx-chevron-right icon-right'  @click="menuDropdown1()"></i></a>
				<ul class="side-dropdown" v-bind:class="{show: isdisplay}">
					<li>
						<router-link active-class="active" to="/dashboard/season"><i class='bx bx-plus icon' ></i> Season </router-link>
					</li>
					<li>
						<router-link active-class="active" to="/dashboard/land_preperation"><i class='bx bx-plus icon' ></i> Land Preperation </router-link>
					</li>
				</ul>
			</li>
			<li class="divider" data-text="location">Crop </li>
			<li>
				<a><i class='bx bx-crop icon'></i> Crop <i class='bx bx-chevron-right icon-right'  @click="menuDropdown2()"></i></a>
				<ul class="side-dropdown" v-bind:class="{show: isdisplay1}">
					<li>
						<router-link active-class="active" to="/dashboard/crop"><i class='bx bx-plus icon' ></i> Crop </router-link>
					</li>
					<li>
						<router-link active-class="active" to="/dashboard/crop_selection"><i class='bx bx-plus icon' ></i> Crop Selection</router-link>
					</li>
				</ul>
			</li>
			<li class="divider" data-text="location">Cultivation </li>
			<li>
				<a><i class='bx bx-cube icon'></i> Cultivation <i class='bx bx-chevron-right icon-right'  @click="menuDropdown3()"></i></a>
				<ul class="side-dropdown" v-bind:class="{show: isdisplay2}">
					<li>
						<router-link active-class="active" to="/dashboard/cultivation_category"><i class='bx bx-plus icon' ></i>Category</router-link>
					</li>
					<li>
						<router-link active-class="active" to="/dashboard/cultivation_section"><i class='bx bx-plus icon' ></i> Cultivation </router-link>
					</li>
				</ul>
			</li>
			<li class="divider" data-text="location">Setting </li>
			<li>
				<ul>
					<li>
						<router-link active-class="active" to="/dashboard/department"><i class='bx bx-cog icon'></i> Department</router-link>
					</li>
				</ul>
			</li>
			<li class="divider" data-text="location">User Management </li>
			<li>
				<a><i class='bx bx-user-circle icon'></i> User Management <i class='bx bx-chevron-right icon-right'  @click="menuDropdown4()"></i></a>
				<ul class="side-dropdown" v-bind:class="{show: isdisplay3}">
					<li><a href="#"><i class='bx bx-plus icon' ></i> User List</a></li>
					<li><a href="#"><i class='bx bx-plus icon' ></i> Role</a></li>
					<li><a href="#"><i class='bx bx-plus icon' ></i> Permissions</a></li>
				</ul>
			</li>

		</ul>
	</section>

</template>

<script>
	export default {
		name: 'MySidebar',
		props: ['isActive'],

		data() {
			return {
                user_Info: JSON.parse(localStorage.getItem('user')),
				isshow: false,
				isdisplay: false,
				isdisplay1: false,
				isdisplay2: false,
				isdisplay3: false
			};
		},

		methods: {
			menuDropdown() {
				this.isshow = !this.isshow;
			},
			menuDropdown1() {
				this.isdisplay = !this.isdisplay;
			},
			menuDropdown2() {
				this.isdisplay1 = !this.isdisplay1;
			},
			menuDropdown3() {
				this.isdisplay2 = !this.isdisplay2;
			},
			menuDropdown4() {
				this.isdisplay3 = !this.isdisplay3;
			}
		},
	};
</script>
<style lang='' scoped>
</style>