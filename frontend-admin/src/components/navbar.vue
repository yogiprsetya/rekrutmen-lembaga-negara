<template>
    <b-navbar variant="info" class="mb-5">
        <b-container>
            <b-navbar-brand href="/">RBLN</b-navbar-brand>

            <b-navbar-nav>
                <b-button variant="link" class="nohover" href="#/">Data Lamaran</b-button>
                <b-button variant="outline-light" href="https://yogiprsetya.github.io/lembaga-negara/admin/" onclick="window.localStorage.clear();">Logout</b-button>
            </b-navbar-nav>
        </b-container>
    </b-navbar>
</template>

<script>
export default {
}
</script>

<style>
.nohover, .nohover:hover {
    color: #fff;
    text-decoration: none !important
}
</style>
