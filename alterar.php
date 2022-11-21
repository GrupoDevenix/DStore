<form method="$_POST">
    <h4>INSIRA A SUA NOVA SENHA</h4>
    <hr>
    <label>Digita</label>
    <input type="password" nome="senha" class="form-control"><br>
    <input type="submit" value="Efetuar Aterações" class="botao">
    <input type="hidden" name="env" value="upd">
</form>
<?php
verifica_hash($conn, $hash);
?>