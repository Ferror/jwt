<template>
    <div class="home">
        <img alt="Vue logo" src="@/assets/logo.png">
        <HelloWorld msg="Welcome to Your Vue.js App"/>
    </div>
</template>

<script>
import HelloWorld from '@/components/HelloWorld.vue'
import AuthenticationClient from "@/clients/AuthenticationClient";

export default {
    name: 'Home',
    components: {
        HelloWorld
    },
    data: function () {
        AuthenticationClient.getToken();
    }
}
</script>
