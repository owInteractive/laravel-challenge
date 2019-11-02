/**
 * Theme: Highdmin - Bootstrap 4 Web App kit
 * Author: Coderthemes
 * Module/App: Main Js
 */


(function ($) {

    'use strict';

    function initNavbar() {

        $('.navbar-toggle').on('click', function (event) {
            $(this).toggleClass('open');
            $('#navigation').slideToggle(400);
        });

        $('.navigation-menu>li').slice(-2).addClass('last-elements');

        $('.navigation-menu li.has-submenu a[href="#"]').on('click', function (e) {
            if ($(window).width() < 992) {
                e.preventDefault();
                $(this).parent('li').toggleClass('open').find('.submenu:first').toggleClass('open');
            }
        });
    }
    function initScrollbar() {
        $('.slimscroll').slimscroll({
            height: 'auto',
            position: 'right',
            size: "8px",
            color: '#9ea5ab'
        });
    }
    // === following js will activate the menu in left side bar based on url ====
    function initMenuItem() {
        $(".navigation-menu a").each(function () {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) {
                $(this).parent().addClass("active"); // add active to li of the current link
                $(this).parent().parent().parent().addClass("active"); // add active class to an anchor
                $(this).parent().parent().parent().parent().parent().addClass("active"); // add active class to an anchor
            }
        });
    }
    function initMask(){
        $(".mobile").mask("(00) 00000-0000");
        $(".cpf").mask("000.000.000-00");
    }

    function initCep(){
        $(".cep").on('keyup', function(){
            let cep = $(this).val();
            if(cep.length == 8){
                pesquisaCep(cep);
            }
        });
    }

    function limpaFormularioCep() {
        //Limpa valores do formulário de cep.
        document.getElementById("logradouro").value = "";
        document.getElementById("bairro").value = "";
        document.getElementById("cidade").value = "";
        document.getElementById("estado").value = "";
    }

    function meuCallback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById("logradouro").value = conteudo.logradouro;
            document.getElementById("bairro").value = conteudo.bairro;
            document.getElementById("cidade").value = conteudo.localidade;
            document.getElementById("estado").value = conteudo.uf;
            $('#numero').focus();
        } //end if.
        else {
            //CEP não Encontrado.
            limpaFormularioCep();
        }
    }

    function pesquisaCep(valor) {
        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, "");

        //Verifica se campo cep possui valor informado.
        if (cep != "") {
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {
                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById("logradouro").value = "...";
                document.getElementById("bairro").value = "...";
                document.getElementById("cidade").value = "...";
                document.getElementById("estado").value = "...";

                //Cria um elemento javascript.
                var script = document.createElement("script");

                fetch("https://viacep.com.br/ws/" + cep + "/json")
                    .then(function(response) {
                        return response.json();
                    })
                    .then(endereco => {
                        meuCallback(endereco);
                    });
            } //end if.
            else {
                //cep é inválido.
                limpaFormularioCep();
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpaFormularioCep();
        }
    }

    function init() {
        initCep();
        initMask();
        initNavbar();
        initScrollbar();
        initMenuItem();
    }

    init();

})(jQuery);



