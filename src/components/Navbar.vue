<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Mercado</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link"><router-link to="/">Home</router-link></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><router-link to="/produtos">Cadastro de Produtos</router-link></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><router-link to="/vendas">Vendas</router-link></a>
                </li>
            </ul>
        </div>
    </nav>
</template>