<template>
	<router-view />
</template>


<script>
import { onBeforeMount} from 'vue';
import { useRouter, useRoute} from 'vue-router';

export default {
  script() {
    const router = useRouter();
    const route = useRoute();

    onBeforeMount(() => {

    })
  }
}
</script>
<style>
* {
	margin: 0;
	padding: 0;
}
body {
	background: #2c3e50;
	color: #fff;
}
#app {
	font-family: Avenir, Helvetica, Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	text-align: center;
}
a {
	color: inherit;
}

nav a.router-link-exact-active {
	color: #42b983;
}
</style>
