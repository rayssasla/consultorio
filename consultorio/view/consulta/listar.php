
<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

use App\Consulta;
use App\Paciente;
use App\Funcionario;

include('../includes/cabecalho.php');
include('../includes/menu.php');

try {
    $consultas = Consulta::listar(null, 'data_hora desc');
} catch (\Throwable $erro) {
    echo '<div class="container mt-4">';
    echo '<div class="alert alert-danger">';
    echo '<strong>Erro ao listar consultas:</strong><br>';
    echo htmlspecialchars($erro->getMessage());
    echo '</div>';
    echo '</div>';

    include('../includes/rodape.php');
    exit;
}

?>

<main class="container mt-4">

    <h1 class="text-center">Lista de Consultas</h1>

    <div class="text-end my-3">
        <a href="cadastrar.php" class="btn btn-success">
            Nova Consulta
        </a>
    </div>

    <table class="table table-hover">

        <thead class="table-primary">
            <tr>
                <th>Paciente</th>
                <th>Dentista</th>
                <th>Data/Hora</th>
                <th>Valor Total</th>
                <th>Valor Pago</th>
                <th>Pagamento</th>
                <th>Proc. Realizados</th>
                <th>Proc. a Realizar</th>
                <th>Descrição</th>
                <th>Medicação</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($consultas as $consulta): ?>

                <?php
                $paciente = Paciente::buscarPorId($consulta->paciente_id);
                $dentista = Funcionario::buscarPorId($consulta->dentista_id);
                ?>

                <tr>

                    <td>
                        <?= htmlspecialchars($paciente ? $paciente->nome : 'Não encontrado') ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($dentista ? $dentista->nome : 'Não encontrado') ?>
                    </td>

                    <td>
                        <?= date('d/m/Y H:i', strtotime($consulta->data_hora)) ?>
                    </td>

                    <td>
                        R$ <?= number_format($consulta->valor_total, 2, ',', '.') ?>
                    </td>

                    <td>
                        R$ <?= number_format($consulta->valor_pago, 2, ',', '.') ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($consulta->forma_pagamento) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($consulta->procedimentos_realizados) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($consulta->procedimentos_arealizar) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($consulta->descricao) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($consulta->medicacao) ?>
                    </td>

                    <td>
                        <a href="editar.php?id=<?= $consulta->id ?>" class="btn btn-primary">
                            Editar
                        </a>
                    </td>

                    <td>
                        <a href="/consultorio/action/action_consulta.php?action=excluir&id=<?= $consulta->id ?>"
                           class="btn btn-danger"
                           onclick="return confirm('Deseja realmente excluir esta consulta?')">
                            Excluir
                        </a>
                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</main>

<?php include('../includes/rodape.php'); ?>
