
<?php

use App\Funcionario;

include('../includes/cabecalho.php');
include('../includes/menu.php');

$id = $_GET['id'];

$funcionario = Funcionario::buscarPorId($id);

?>

<main class="container">

    <h1>Editar Funcionario</h1>

    <form method="POST" action="/consultorio/action/action_funcionario.php?action=alterar&id=<?= $id ?>">

        Nome * :
        <input name="nome" type="text" value="<?= htmlspecialchars($funcionario->nome ?? '') ?>" class="form-control" required>

        CPF * :
        <input name="cpf" type="text" value="<?= htmlspecialchars($funcionario->cpf ?? '') ?>" class="form-control" required>

        Data de Nascimento *:
        <input name="data_nascimento" type="date" value="<?= htmlspecialchars($funcionario->data_nascimento ?? '') ?>" class="form-control" required>

        Telefone *:
        <input name="telefone" type="text" class="form-control" value="<?= htmlspecialchars($funcionario->telefone ?? '') ?>" required>

        Email * :
        <input name="email" type="email" class="form-control" value="<?= htmlspecialchars($funcionario->email ?? '') ?>" required>

        Endereço * :
        <input name="endereco" type="text" class="form-control" value="<?= htmlspecialchars($funcionario->endereco ?? '') ?>" required>

        CRO :
        <input name="cro" type="text" class="form-control" value="<?= htmlspecialchars($funcionario->cro ?? '') ?>">

        Especialidade :
        <input name="especialidade" type="text" class="form-control" value="<?= htmlspecialchars($funcionario->especialidade ?? '') ?>">

        Senha :
        <input name="senha" type="password" class="form-control" placeholder="Digite somente se quiser alterar">

        Perfil *:
        <select name="perfil" class="form-select" required>

            <option value="dentista" <?= ($funcionario->perfil == 'dentista') ? 'selected' : '' ?>>
                Dentista
            </option>

            <option value="secretaria" <?= ($funcionario->perfil == 'secretaria') ? 'selected' : '' ?>>
                Secretaria
            </option>

        </select>

        <br>

        <input type="submit" value="Editar" class="btn btn-primary">

    </form>

    <div class="pb-5"></div>

</main>

<?php
include('../includes/rodape.php');
?>
