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
<!--*********************Style CSS*****************************-->
<style type="text/css">
.form-group .btn{
    border-radius: 10px;
} 
</style>

<!--********************Funções Javascript*********************-->
<script>
    /*
     * @author: Dhiego Balthazar
     * Método que limpa os imputs da página
     *
     *
     */
    function limparInputs(){
        $('input').val("");
        $('select').prop('selectedIndex', 0);
    }

</script>
<!--********************Funções Javascript/JQUERY que utilizam $(function(){})*********************-->
<script>
    $(function(){

        //bloco para inserir uma visita 
        $('#entrar').click(function(){
            var d = new Date();
            var strDate = d.getDate() + "/"  + (d.getMonth()+1) + "/" + d.getFullYear();
            var hora = d.getHours() + ":" + (d.getMinutes()<10? "0" + d.getMinutes(): d.getMinutes())+":"+(d.getSeconds()<10? "0" + d.getSeconds(): d.getSeconds());
            var nome = $("input[name=nome]").val();
            var rg = $("input[name=rg]").val();
            var setor = $("select[name=setor]").val();
            $('tbody').append("<tr><td>"+strDate+"</td><td>"+nome+"</td><td>"+rg+"</td><td>"+setor+"</td><td>"+hora+"</td><td><button type='button' class='btn btn-info' id='saida'>Marcar Saída</button></td></tr>");
            limparInputs();
        });

        //esse bloco é para buscar uma pessoa pelo rg
        $('#buscar_rg').click(function(){
            $.ajax({
                type: 'GET',
                contentType: "json",
                url: '<?php echo base_url(); ?>buscar/rg/pessoa/'+ $('input[name=rg]').val(),
                success: function(data) {
                    var pessoa = jQuery.parseJSON(data);
                    if(pessoa == null){
                        alert("Pessoa Não Cadastrada");
                        limparInputs();
                    }else{
                        $('input[name=nome]').val(pessoa.nome);
                    }
                }
            });
        });
    });            
</script>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Lista de Visitas</h4>
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
                        <div class="col-md-8">
                            <input type="text" placeholder="NOME" class="form-control form-control-line" name="nome">
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-info" id="buscar_nome"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8">
                            <input type="text" placeholder="RG" class="form-control form-control-line" name="rg">
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-info" id="buscar_rg"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="form-group">
                            <div class="col-sm-12">
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