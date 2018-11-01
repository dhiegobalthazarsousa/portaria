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
<!--*****************************Funções Javascript*********************-->
<script>
    function confereInputNome(){
        if($("input[name=nome]").val() == "")
            return false;
        return true;
    }

    function confereInputRG(){
        if($("input[name=rg]").val() == "")
            return false;
        return true;
    }
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

    function limparErros(){
        $("#error-nome").hide();
        $("#error-rg").hide();
    }

</script>

<!--********************Funções Javascript/JQUERY que utilizam $(function(){})*********************-->
<script>
    $(function(){
        limparErros();

        //bloco para inserir uma visita 
        $('#entrar').click(function(){
            if(!(confereInputRG() && confereInputNome())){
                if(!confereInputRG()){
                    $("#error-rg").show();
                }
                if(!confereInputNome()){
                    $("#error-nome").show();
                }
            }else{
                var d = new Date();
                var strDate = d.getDate() + "/"  + (d.getMonth()+1) + "/" + d.getFullYear();
                var hora = d.getHours() + ":" + (d.getMinutes()<10? "0" + d.getMinutes(): d.getMinutes())+":"+(d.getSeconds()<10? "0" + d.getSeconds(): d.getSeconds());
                var nome = $("input[name=nome]").val();
                var rg = $("input[name=rg]").val();
                var setor = $("select[name=setor]").val();
                $('tbody').append("<tr><td>"+strDate+"</td><td>"+nome+"</td><td>"+rg+"</td><td>"+setor+"</td><td>"+hora+"</td><td><button type='button' class='btn btn-info' id='saida'>Marcar Saída</button></td></tr>");

                limparInputs();
                limparErros();
            }
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
                        $.toast({
                            heading: 'Pessoa não cadastrada!',
                            text: ['Digite o nome manualmente;', 'Efetue a entrada;', 'A pessoa será cadastrada automaticamente'],
                            position: 'mid-center',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 4000,
                            showHideTransition: 'slide',
                            stack: 6
                        })
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