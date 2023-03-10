<script>
</script>

<template>
    <div class="buttons">
        <div><router-link to="/cad-produtos">Cadastrar Produto</router-link></div>
        <div><router-link to="/cad-tipos">Cadastrar Tipo</router-link></div>
    </div>
    <div class="container">
        <router-view />
    </div>
</template>

<style scoped>
    .buttons {
        display: flex;
        flex-direction: row;
    }
    .buttons div {
        margin: auto;
    }
</style>