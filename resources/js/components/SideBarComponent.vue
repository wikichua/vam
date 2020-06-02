<template>
	<div>
		<div class="sb-sidenav-menu-heading">Core</div>
		
		<router-link to="/dashboard" class="nav-link">
            <div class="sb-nav-link-icon">
            	<i class="fas fa-tachometer-alt"></i>
            </div>
            Dashboard
		</router-link>

		<router-link :to="{ name: 'setting.index' }" class="nav-link" v-if="$can('Read Settings')">
			<div class="sb-nav-link-icon">
				<i class="fas fa-tools"></i>
			</div>
			Settings
		</router-link>

		<router-link :to="{ name: 'permission.index' }" class="nav-link" v-if="$can('Read Permissions')">
			<div class="sb-nav-link-icon">
				<i class="fas fa-user-lock"></i>
			</div>
			Permissions
		</router-link>

		<router-link :to="{ name: 'role.index' }" class="nav-link" v-if="$can('Read Roles')">
			<div class="sb-nav-link-icon">
				<i class="fas fa-id-card"></i>
			</div>
			Roles
		</router-link>

		<router-link :to="{ name: 'user.index' }" class="nav-link" v-if="$can('Read Users')">
			<div class="sb-nav-link-icon">
				<i class="fas fa-users"></i>
			</div>
			Users
		</router-link>

		<router-link :to="{ name: 'activitylog.index' }" class="nav-link" v-if="$can('Read Activity Logs')">
			<div class="sb-nav-link-icon">
				<i class="fas fa-address-book"></i>
			</div>
			Activity Logs
		</router-link>

		<div class="sb-sidenav-menu-heading">Testing</div>

		<router-link to="/profile" class="nav-link">
			<div class="sb-nav-link-icon">
				<i class="fas fa-user"></i>
			</div>
			{{ userName }}
		</router-link>
	</div>
</template>

<script>
export default {
	props: ['userName'],
	data () {
		return {
		}
	},
	methods: {
		
	},
	mounted() {
		console.log(this.userName);
	}
}
</script>