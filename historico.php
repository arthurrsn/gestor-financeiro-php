<?php
include("session.php");
include("funcoes.php");

if (isset($_POST["limpar"])) {
    $_SESSION["transacoes"] = [];
    header("Location: historico.php");
    exit;
}

$transacoes   = $_SESSION["transacoes"];
$totalDespesas = totalDespesas($transacoes);
$totalReceitas = totalReceitas($transacoes);
$saldo         = calcularSaldo($transacoes);
?>
<?php include("includes/header.php"); ?>
<?php include("includes/menu.php"); ?>

<div class="container">
    <h1>Histórico de Transações</h1>

    <?php if (count($transacoes) === 0): ?>
        <div class="box vazio">
            <p>Nenhuma transação no histórico ainda.</p>
            <a href="index.php" class="btn">Ir para o Dashboard</a>
        </div>
    <?php else: ?>

    <div class="cards">
        <div class="card card-saldo <?= $saldo >= 0 ? 'positivo' : 'negativo' ?>">
            <span class="card-label">Saldo Final</span>
            <span class="card-valor"><?= formatarMoeda($saldo) ?></span>
        </div>
        <div class="card card-receita">
            <span class="card-label">Total Receitas</span>
            <span class="card-valor"><?= formatarMoeda($totalReceitas) ?></span>
        </div>
        <div class="card card-despesa">
            <span class="card-label">Total Despesas</span>
            <span class="card-valor"><?= formatarMoeda($totalDespesas) ?></span>
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <h2>Todas as Transações</h2>
            <form method="POST" onsubmit="return confirm('Apagar todo o histórico?')">
                <button type="submit" name="limpar" class="btn btn-perigo">Limpar Histórico</button>
            </form>
        </div>

        <table class="tabela">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transacoes as $i => $t):?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($t["nome"]) ?></td>
                    <td>
                        <span class="badge <?= $t["tipo"] ?>">
                            <?= $t["tipo"] === "receita" ? "Receita" : "Despesa" ?>
                        </span>
                    </td>
                    <td><?= formatarMoeda($t["valor"]) ?></td>
                    <td><?= $t["data"] ?? "-" ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Saldo Final</strong></td>
                    <td colspan="2" class="<?= $saldo >= 0 ? 'receita' : 'despesa' ?>">
                        <strong><?= formatarMoeda($saldo) ?></strong>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <?php endif; ?>
</div>

<?php include("includes/footer.php"); ?>
