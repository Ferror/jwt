<template>
    <form
        action=""
        method="post"
        @submit="createWebToken"
    >
        <div>
            <label>Email Address</label>
            <input
                type="email"
                required
                v-model="email"
            >
        </div>
        <div>
            <label>Password</label>
            <input
                type="password"
                required
                v-model="password"
            >
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
</template>

<script>
import AuthenticationClient from "@/clients/AuthenticationClient";

export default {
    name: "SignInForm",
    data: function () {
        return {
            email: '',
            password: '',
        }
    },
    methods: {
        createWebToken: function (event) {
            event.preventDefault();

            console.log(this.email);
            console.log(this.password);

            AuthenticationClient.createToken(this.email, this.password);
        }
    }
}
</script>

<style scoped>
form > div {
    padding: 10px;
    margin: 0 auto;
}

label, input {
    width: 350px;
    display: block;
    margin: 0 auto;
    padding: 7px;
}
</style>
