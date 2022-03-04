<template>
	<div class="background">
		<form @submit.prevent="login()">
			<h3>Login</h3>
			<input
				type="text"
				placeholder="Email"
				id="email"
				v-model="user.email"
			/>
			<input
				type="password"
				placeholder="Password"
				id="password"
				v-model="user.password"
			/>
			<button type="submit">Log In</button>
		</form>
	</div>
</template>

<script>
export default {
	name: "LoginView",
	data: () => ({
		user: {
			email: "",
			password: "",
		},
	}),
	methods: {
		login: function () {
			this.$store.dispatch("currentUser/loginUser", this.user);
		},
	},
};
</script>

<style media="screen" scoped>
.background {
	width: 430px;
	height: 520px;
	position: absolute;
	transform: translate(-50%, -50%);
	left: 50%;
	top: 50%;
}
form {
	height: fit-content;
	width: 400px;
	background-color: rgba(255, 255, 255, 0.13);
	position: absolute;
	transform: translate(-50%, -50%);
	top: 50%;
	left: 50%;
	border-radius: 10px;
	backdrop-filter: blur(10px);
	border: 2px solid rgba(255, 255, 255, 0.1);
	box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
	padding: 50px 35px;
}
form * {
	font-family: "Poppins", sans-serif;
	color: #ffffff;
	letter-spacing: 0.5px;
	outline: none;
	border: none;
}
form h3 {
	font-size: 32px;
	font-weight: 500;
	line-height: 42px;
	text-align: center;
}

label {
	display: block;
	margin-top: 30px;
	font-size: 16px;
	font-weight: 500;
}
input {
	display: block;
	height: 50px;
	width: 100%;
	background-color: rgba(255, 255, 255, 0.09);
	border-radius: 3px;
	padding: 0 10px;
	margin-top: 2rem;
	font-size: 14px;
	font-weight: 300;
}
::placeholder {
	color: #ffffff;
}
button {
	margin-top: 50px;
	width: 100%;
	background-color: #ffffff;
	color: #080710;
	padding: 15px 0;
	font-size: 18px;
	font-weight: 600;
	border-radius: 5px;
	cursor: pointer;
}
</style>
