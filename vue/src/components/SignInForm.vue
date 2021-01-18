<template>
    <form action="">
        <div>
            <label>Email Address</label>
            <input type="text">
        </div>
        <div>
            <label>Password</label>
            <input type="password">
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
</template>

<script>
export default {
    name: "SignInForm"
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
