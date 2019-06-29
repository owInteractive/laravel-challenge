<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>{{ (!empty($config->nome) ? $config->nome : 'Área administrativa') }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link href="/coloradmin/css/vendor.css" rel="stylesheet" />
    <link href="/plugins/gritter/css/gritter.css" rel="stylesheet" />
    
    <!-- ================== END BASE CSS STYLE ================== -->
    @yield('styles')
    <!-- ================== BEGIN BASE JS ================== -->
    {{-- <script src="/assets/plugins/pace/pace.min.js"></script> --}}
    <!-- ================== END BASE JS ================== -->
</head>
<body>
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
        <!-- begin #header -->
        @include('bredicoloradmin::includes.header')
        <!-- end #header -->

        <!-- begin #sidebar -->
        @include('bredicoloradmin::includes.sidebar')
        <!-- end #sidebar -->

        <!-- begin #content -->
        <div id="content" class="content">
            @yield('content')
        </div>
        <!-- end #content -->

        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->

    @include('bredicoloradmin::includes.atencao')

    <!-- ================== BEGIN BASE JS ================== -->
    {{-- <script src="/assets/plugins/jquery/jquery-3.3.1.min.js"></script> --}}
    {{-- <script src="/assets/plugins/jquery-ui/jquery-ui.min.js"></script> --}}
    {{-- <script src="/assets/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script> --}}
    {{-- falta fazer aqui IE9 --}}
    <!--[if lt IE 9]>
        <script src="/assets/crossbrowserjs/html5shiv.js"></script>
        <script src="/assets/crossbrowserjs/respond.min.js"></script>
        <script src="/assets/crossbrowserjs/excanvas.min.js"></script>
    <![endif]-->

    <!-- ================== END BASE JS ================== -->
        
    <script src="/coloradmin/js/vendor.js"></script>
    <script src="/plugins/gritter/js/gritter.js"></script>
    <script src="/plugins/sortablejs/Sortable.min.js"></script>
    <script src="/plugins/bootstrap-sweetalert/sweetalert.min.js"></script>
    <script src="/plugins/jquery-maskmoney/jquery.maskMoney.min.js"></script>

    <script>

    function sortable(table)
    {
        var el = document.getElementsByClassName('sortable');
        $('.sortable').css({"cursor": "ns-resize"})

        if (el.length > 0) {
            $(el).sortable({
                forceHelperSize: true,
                stop:function(event,ui){
                    
                    let order = [];
                    let obj = [];
                    
                    for(var i = 0; i < event.target.rows.length; i++) {
                        obj.push({id: event.target.rows[i].id, order: i + 1});
                        $("tr#" + event.target.rows[i].id + ' td:nth-child(1)').text(obj[i].order)
                    }

                    order = obj;
                    $.ajax({
                        url: "{{ route('bredidashboard::controle.ordenacao.update') }}",
                        data: {'order':order, table: table, _token: "{{ csrf_token() }}" },
                        dataType: 'json',
                        type: 'POST',
                        success: function(data) {
                            if (data.error == false && data.msg != 0) {
                                $.gritter.add({
                                    title: 'Sucesso!',
                                    text: "<span style='color:#FFF;font-size:13px'>Ordem atualizada!</span>",
                                    image: '/coloradmin/images/success.png',
                                    sticky: false,
                                    time: 1000,
                                });
                            }
                        }
                    }).fail(function(e){
                        $.gritter.add({
                            title: 'Erro!',
                            text: "<span style='color:#FFF;font-size:13px'>Houve um erro ao atualizar!</span>",
                            image: '/coloradmin/images/error.png',
                            sticky: false,
                            time: 3000,
                        });
                    });
                }
            })

        }
    }

    $(document).ready(function(){
        @if (session()->has('msg'))
        var unique_id = $.gritter.add({
            title: '{{ (!empty(session('error'))) ? 'Erro' : 'Sucesso' }}!',
            text: "<span style='color:#FFF;font-size:13px'>{{ session('msg') }}</span>",
            image: '/coloradmin/images/{{ (!empty(session('error'))) ? 'error' : 'success' }}.png',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: {{ (session('error')) ? "true" : "false" }},
            // (int | optional) the time you want it to be alive for before fading out
            time: 15000,
            close: 'fechar'
        });
        @endif

        @if (isset($errors) and count($errors))
        var unique_id = $.gritter.add({
            title: 'Erro!',
            text: "{!! implode('<br>', $errors->all()) !!}",
            image: '/coloradmin/images/error.png',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true
        });
        @endif

         // Exibe o modal de exclusão de registro
        $('.atencao').on('click', function (event) {
            event.preventDefault();
            var url = $(this).attr('data-url');
            swal({
                title: "Atenção!",
                text: "Deseja continuar com esta operação?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                buttons: {
                    cancel: "Cancelar",
                    catch: {
                      text: "Confirmar",
                      value: "excluir",
                    },
                    defeat: false,
                  }
            }).then((value) => {
                if (value == "excluir") {
                    window.location.href = url
                }
            })

        });
        
        addMaskPhone();
        $(".whatsapp").mask("(99) 99999-9999");

        $('.telefones').on('click', '.adicionar_linha', function(){
            var linha = $(this).parents('.linha_telefone').clone().appendTo(".telefones")
            addMaskPhone();
        });
        $('.telefones').on('click', '.remover_linha', function(){
            $(this).parents('.linha_telefone').remove()
        });

        $('.summernote').summernote({
            height: 300,
            callbacks: {
                onImageUpload: function(files, editor, $editable) {
                    var dados = new FormData();
                    if (files) {
                        dados.append("file", files[0]);
                        dados.append("_token",  "{{ csrf_token() }}");
                        $.ajax({
                            data: dados,
                            type: "post",
                             url: '{{ route('bredidashboard::controle.summernote.upload') }}',
                            cache: false,
                            processData: false,
                            contentType: false,
                            beforeSend: function(){
                                $("#loader_img").show();
                            },
                            success: function(res) {
                                if (res) {
                                    $('.summernote').summernote("insertImage", res, res);
                                    // editor.insertImage($editable, res);
                                    $("#loader_img").hide();
                                }
                            },
                            error: function() {
                                $("#loader_img").hide();
                            }
                        });
                    }
                },
                onMediaDelete: function(target) {
                    deleteImageEditor(target[0].src);
                }
            }
        
        });

        function deleteImageEditor(image) {
            var dados = new FormData();
            if (dados) {
                dados.append("image", image);
                dados.append("_token",  "{{ csrf_token() }}");

                $.ajax({
                    data: dados,
                    type: "post",
                    dataType: 'json',
                     url: '{{ route('bredidashboard::controle.summernote.deleteImageEditor') }}',
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $("#loader_img").show();
                    },
                    success: function(res) {
                        if (res) {
                            $("#loader_img").hide();
                        }
                    },
                    error: function() {
                        $("#loader_img").hide();
                    }
                });
            }
            
        }

        function addMaskPhone() {
            if($('.phone').length > 0){
                var fone = $('.phone').val().replace(/\D/g, '');
                $('.phone').unmask();
                if(fone.length > 10) {
                $('.phone').mask("(99) 99999-999?9");
                } else {
                $('.phone').mask("(99) 9999-9999?9");
                }
               
                $('.phone').change(function() {
                    $.each($('.phone'), function(index, input){
                        var fone = $(input).val().replace(/\D/g, '');
                         $(input).unmask();
                         if(fone.length > 10) {
                             $(input).mask("(99) 99999-999?9");
                         } else {
                             $(input).mask("(99) 9999-9999?9");
                         }
                    })
                }).change();
               
            }
        }

        $('.decimal').maskMoney({ prefix: 'R$ ', allowNegative: false, thousands: '.', decimal: ',', affixesStay: false });
        $(".cep").mask("99999-999");

        $('.selectLoad').change(function(){
            var id = $(this).find('option:selected').val();
            var tabela = $(this).data('tabela');
            var chave = $(this).data('chave');
            var campoRetorno = $(this).data('campo-retorno');
            if (id != "") {
                $.ajax({
                    url: '{{ route('controle.selectload.get') }}',
                    type: 'get',
                    dataType: 'json',
                    data: {id: id, tabela : tabela, chave : chave},
                    beforeSend: function(){
                        $("#" + campoRetorno).val("").change();
                        $("#" + campoRetorno).empty();
                    }
                })
                .done(function(resp) {
                    if (Object.keys(resp.json).length > 0) {
                        $("#" + campoRetorno).append('<option value="">Selecione</option>');
                        $.each(resp.json, function(index, valor) {
                            $("#" + campoRetorno).append('<option value="'+index+'">' + valor + '</option>');
            
                        });
                    }
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
            }
    
        });
        
    })
    </script>

    @yield('scripts')

    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
</body>
</html>
