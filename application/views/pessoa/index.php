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

    $(function(){
        $('#entrar').click(function(){
            var d = new Date();
            var strDate = d.getDate() + "/"  + (d.getMonth()+1) + "/" + d.getFullYear();
            var hora = d.getHours() + ":" + (d.getMinutes()<10?"0" + d.getMinutes(): d.getMinutes());
            var nome = $("input[name=nome]").val();
            var rg = $("input[name=rg]").val();
            var setor = $("select[name=setor]").val();
            $('tbody').append("<tr><td>"+strDate+"</td><td>"+nome+"</td><td>"+rg+"</td><td>"+setor+"</td><td>"+hora+"</td></tr>");
            limparInputs();
        });
    });            
</script>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Basic Table</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="http://wrappixel.com/templates/pixeladmin/" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Upgrade to Pro</a>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Basic Table</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Basic Table</h3>
                <p class="text-muted">Add class <code>.table</code></p>
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
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="white-box">
                <form class="form-horizontal form-material">
                    <div class="form-group">
                        <div class="col-md-8">
                            <input type="text" placeholder="NOME" class="form-control form-control-line" name="nome">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8">
                            <input type="text" placeholder="RG" class="form-control form-control-line" name="rg">
                        </div>
                    </div>
                    <div class="form-group">
                            <div class="col-sm-12">
                                <select class="form-control form-control-line" name="setor">
                                    <option selected="selected">SETOR</option>
                                    <option value="Contagem">Contagem</option>
                                    <option value="Pagamento">Pagamento</option>
                                    <option value="Escola da Família">Escola da Família</option>
                                    <option value="Supervisão">Supervisão</option>
                                </select>
                            </div>
                        </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-success" id="entrar">Entrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->