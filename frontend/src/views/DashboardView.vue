<template>
	<div class="grid-container">
		<div class="sidebar">
			<p></p>
			<ul>
				<li>Loout</li>
			</ul>
		</div>
		<div class="main-content">
			<div class="topbar">
				<button @click="collapse()">M</button>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	name: "DashboardView",
	components: {},
	
	methods: {
		collapse: function () {
			const sidebar = this.$el.querySelector(".sidebar");
			const topbar = this.$el.querySelector(".topbar");
			const mainContent = this.$el.querySelector(".main-content");
			sidebar.classList.toggle("sidebar_small");
			topbar.classList.toggle("topbar_large");
			mainContent.classList.toggle("main-content_large");
		},
	},
	onBeforeMount: () => {},
};
</script>

<style scoped>
.grid-container {
	width: 100vw;
	height: 100vh;
	margin: 0;
	padding: 0;
	display: flex;
	transition: 0.7s ease;
	overflow: hidden;
}

.sidebar {
	width: 20vw;
	height: 100vh;
	background-color: rgba(255, 255, 255, 0.13);
	backdrop-filter: blur(10px);
	box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
	transition: 1s ease;
	position: relative;
}

.topbar {
	width: 80vw;
	height: 4rem;
	background-color: rgba(255, 255, 255, 0.5);
	backdrop-filter: blur(10px);
	box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
	transition: 1s ease;
	position: relative;
}

.main-content {
	width: 80vw;
	height: 100vh;
	background-color: rgba(255, 255, 255, 0.8);
	backdrop-filter: blur(10px);
	transition: 1s ease;
}

.main-content_large {
	width: 90vw;
}

.topbar_large {
	width: 90vw;
}

.sidebar_small {
	width: 10vw;
}

button {
	position: absolute;
	border: none;
	height: 40px;
	width: 40px;
	border-radius: 50%;
	box-shadow: 0px 1px 4px 1px rgba(0, 0, 0, 0.3);
	left: 2.5rem;
	top: 0.8rem;
	transform: translateX(-50%);
	cursor: pointer;
}
</style>
