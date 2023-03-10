<template>
    <h1>Cadastro de Produtos</h1>

    <div>
        <div>
            <p>Nome:</p>
            <input type="text" name="nome" id="nome">
        </div>
        <div>
            <p>Valor:</p>
            <input type="number" name="valor" id="valor" step=".01">
        </div>
        <div>
            <p>Tipo:</p>
            <select name="tipo" id="tipo">
                <option value="">exemplo</option>
                <option value="">exemplo</option>
                <option value="">exemplo</option>
            </select>
        </div>
        <div><button>Salvar</button></div>
    </div>
</template>