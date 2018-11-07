<!--********************************Funções PHP********************************-->
<?php
    function getNomePessoa($id, $list){
        $nome = "";
        foreach($list as $pessoa){
            if($pessoa->id_pessoa === $id){
                $nome = $pessoa->nome;
            }
        }
        return $nome;
    }

    function getRgPessoa($id, $list){
        $rg = "";
        foreach($list as $pessoa){
            if($pessoa->id_pessoa === $id){
                $rg = $pessoa->rg;
            }
        }
        return $rg;
    }

    function getNomeSetor($id, $list){
        $nome = "";
        foreach($list as $setor){
            if($setor->id_setor === $id){
                $nome = $setor->nome;
            }
        }
        return $nome;
    }
?>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">DE CARAGUATTAUBA</h4>
        </div>
    </div>
    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Nome</th>
                                <th>RG</th>
                                <th>Setor</th>
                                <th>Hora da Entrada</th>
                                <th>Hora da Saída</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($visitas)): ?>
                                <?php foreach($visitas as $visita): ?>
                                    <?php echo "<tr><td>".$visita->data."</td><td>".getNomePessoa($visita->id_pessoa, $pessoas)."</td><td>".getRgPessoa($visita->id_pessoa, $pessoas)."</td><td>".getNomeSetor($visita->id_setor, $setores)."</td><td>".$visita->hora_entrada."</td><td>".$visita->hora_saida."</td></tr>"; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="white-box">
                <form class="form-horizontal form-material" id="form-pessoa">
                    <div class="form-group">
                        <div class="col-md-2" id="div-rg">
                            <input type="text" placeholder="RG" class="form-control form-control-line" name="rg">
                            <div class="errors bg-danger" id="error-rg"><p>O campo RG não pode estar vazio!</p></div>
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-info" id="buscar_rg"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-5" id="div-nome">
                            <input type="text" placeholder="NOME" class="form-control form-control-line" name="nome">
                            <div class="errors bg-danger" id="error-nome"><p>O campo NOME não pode estar vazio!</p></div>
                        </div>
                    </div>
                    <div class="form-group">
                            <div class="col-sm-2">
                                <select class="form-control form-control-line" name="setor">
                                    <option selected="selected">SETOR</option>
                                    <?php foreach($setores as $setor): ?>
                                        <?php echo "<option>$setor->nome</option>"; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-success" id="entrar">Efetuar Entrada</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->