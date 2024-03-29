<?php
require_once 'header.html';

$curl = curl_init('http://18.228.39.100:3333/atendimento');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$atendimentos = json_decode(curl_exec($curl));
?>

<main>
    <div class="container text-left mt-1">
        <div>
            <h3 class="cover-heading">Atendimentos</h3>
            <button type="button" class="btn btn-outline-secondary mt-3 mb-5" data-toggle="modal"
                    data-target="#myModal">
                Novo atendimento
            </button>
        </div>
        <div>
            <?php if ($atendimentos) {
                ?>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">CPF</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">Status</th>
                        <th scope="col">Detalhar</th>
                    </tr>
                    </thead>
                    <?php
                    foreach ($atendimentos as $atendimento) {

                        ?>
                        <tbody>
                        <tr>
                            <th scope="row"><?= $atendimento->id ?></th>
                            <td><?= $atendimento->cpf ?></td>
                            <td><?= $atendimento->email ?></td>
                            <td><?= $atendimento->status ?></td>
                            <td><a href="./AtendimentoCliente.php?id=<?= $atendimento->id ?>"
                                   class="btn btn-secondary">Detalhar</a></td>
                        </tr>
                        </tbody>
                        <?php
                    } ?>
                </table>

                <?php
            } else {
                ?>

                <div>
                    <span class="lead"> Não existem atendimento </span>
                </div>
                <?php
            } ?>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Registrar novo atendimento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="controller/ControllerAtendimento.php" method="POST">
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" name="cpf" id="cpf" required>
                        </div>

                        <div class="form-group">
                            <label for="data">E-Mail</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>

                        <div class="form-group">
                            <label for="metragem">Mensagem</label>
                            <textarea type="text" class="form-control" name="mensagem" id="mensagem"
                                      required></textarea>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="action" value="postAtendimento">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>
<?php require_once "footer.html" ?>


