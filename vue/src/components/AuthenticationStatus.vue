<template>
    <div class="AuthenticationStatus AuthenticationStatus__active" v-if="isLogged">
        <h1>Authenticated</h1>
    </div>
    <div class="AuthenticationStatus" v-else>
        <h1>Not authenticated 😢</h1>
    </div>
</template>

<script>
export default {
    name: "AuthenticationStatus",
    data: function () {
        return {
            isLogged: false,
        };
    }
}
</script>

<style scoped>
h1 {
    padding: 10px;
}

.AuthenticationStatus {
    width: 100%;
    background-color: #BA5343;
}

.AuthenticationStatus__active {
    background-color: #42B983;
}
</style>
