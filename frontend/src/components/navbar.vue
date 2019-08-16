<template>
    <b-navbar variant="primary" class="mb-5">
        <b-container>
            <b-navbar-brand href="/">RBLN</b-navbar-brand>

            <b-navbar-nav>
                <b-button variant="link" class="nohover" href="#/proses">Proses</b-button>
                <b-button variant="link" class="nohover" href="#/data-diri">Data Diri</b-button>
                <b-button variant="outline-light" href="/" onclick="window.localStorage.clear();">Logout</b-button>
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
    color: #fff !important
}
</style>
