<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/plugins/images/favicon.png">
        <title>Controle de Entrada</title>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url(); ?>assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Menu CSS -->
        <link href="<?php echo base_url(); ?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
        <!-- toast CSS -->
        <link href="<?php echo base_url(); ?>assets/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
        <!-- morris CSS -->
        <link href="<?php echo base_url(); ?>assets/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
        <!-- animation CSS -->
        <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
        <!-- color CSS -->
        <link href="<?php echo base_url(); ?>assets/css/colors/blue-dark.css" id="theme" rel="stylesheet">
        <!--Ajax JQUERY-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <script>

        /**
         *
         * Metodo que apresenta um Toast como mensagem de retorno
         * @author: Dhiego Balthazar
         * @params: heading, text, icon
         *
        */
        function showToast(heading, text, icon){
            $.ajax({
                type: 'GET',
                contentType: "json",
                url: '<?php echo base_url(); ?>buscar/rg/pessoa/'+ $('input[name=rg]').val(),
                success: function(data) {
                    var pessoa = jQuery.parseJSON(data);
                    if(pessoa == null){
                        $.toast({
                            heading: heading,
                            text: text,
                            position: 'mid-center',
                            loaderBg: '#ff6849',
                            icon: icon,
                            hideAfter: 4000,
                            showHideTransition: 'slide',
                            stack: 6
                        })
                    }else{
                        $('input[name=nome]').val(pessoa.nome);
                    }
                    limparErros();
                }
            });
        }


        /**
         *
         * Metodo onfere se o campo informado é vazio ou não
         * @author: Dhiego Balthazar
         * @params: nome: string - nome atributo name do input
        */
        function inputIsValid(val){
            if(val == "")
                return false;
            return true;
        }

        /*
         * @author: Dhiego Balthazar
         * Método que limpa os inputs da página
         *
         *
         */
        function limparInputs(){
            $('input').val("");
            $('select').prop('selectedIndex', 0);
        }

        /*
         * @author: Dhiego Balthazar
         * Método que limpa os erros da página
         *
         */
        function limparErros(){
            $("#error-nome").hide();
            $("#error-rg").hide();
        }

        function efetuarEntrada(){
            limparErros();

            var nome = $('input[name=rg]').val();
            var rg = $('input[name=nome]').val();

            if(!(inputIsValid(nome) && inputIsValid(rg))){
                if(!inputIsValid(rg))
                        $("#error-rg").show();
                if(!inputIsValid(nome))
                        $("#error-nome").show();
            }else{
                var setor_id = $('input[name=nome]').val();
                $.ajax({
                    url: "",
                    type:'POST',
                    data: jQuery.param({nome: nome, rg: rg, setor: setor_id}),
                    success: function(response){
                        
                    },
                });
                var d = new Date();
                var strDate = d.getDate() + "/"  + (d.getMonth()+1) + "/" + d.getFullYear();
                var hora = d.getHours() + ":" + (d.getMinutes()<10? "0" + d.getMinutes(): d.getMinutes())+":"+(d.getSeconds()<10? "0" + d.getSeconds(): d.getSeconds());
                var nome = $("input[name=nome]").val();
                var rg = $("input[name=rg]").val();
                var setor = $("select[name=setor]").val();
                $('tbody').append("<tr><td>"+strDate+"</td><td>"+nome+"</td><td>"+rg+"</td><td>"+setor+"</td><td>"+hora+"</td><td><button type='button' class='btn btn-info' id='saida' onclick='efetuarSaida("+""+")'>Marcar Saída</button></td></tr>");

                limparInputs();
                limparErros();
            }
        }

        function efetuarBuscaRG(){
            limparErros();
            var rgIsValid = inputIsValid($('input[name=rg]').val());
            if(rgIsValid){
                $.ajax({
                    type: 'GET',
                    contentType: "json",
                    url: '<?php echo base_url(); ?>buscar/rg/pessoa/'+ $('input[name=rg]').val(),
                    success: function(data) {
                        var pessoa = jQuery.parseJSON(data);
                        if(pessoa == null){
                            showToast("RG não cadastrado", ['Digite o nome manualmente;', 'Efetue a entrada;', 'A pessoa será cadastrada automaticamente'], "error");
                        }else{
                            $('input[name=nome]').val(pessoa.nome);
                        }
                    }
                });
            }else{
                $("#error-rg").show();
            }
        }

        //Metodos que funionam quando o documento carregar
        $(function(){
            limparErros();
            $.ajax({
                    url:'<?php echo base_url(); ?>getall/visitas',
                    success: function (response){
                        var visitas = jQuery.parseJSON(response);
                        $.each(response, function(i, item){
                            $('tbody').html("<tr><td>"+data[i].data+"</td><td>"+data[i].+"</td></tr>"); //mostrando resultado
                        });
                    }
                })
                timerI = setTimeout("lista()", 60000);//tempo de espera
                        timerR = true;
        });
    </script>
    
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

    <body>
        <!-- Preloader -->
        <div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top m-b-0">
                <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></a>
                    <ul class="nav navbar-top-links navbar-left">
                        <li>
                           <h1>Controle de Entrada - Diretoria de Ensino Região de Caraguatatuba</h1>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-header -->
                <!-- /.navbar-top-links -->
                <!-- /.navbar-static-side -->
            </nav>
            <!-- Left navbar-header -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                    <dl>
                      <dt>Relatórios</dt>
                      <dd>2018</dd>
                    </dl>
                </div>
            </div>
            <!-- Left navbar-header end -->
            <!-- Page Content -->
            <div id="page-wrapper">
