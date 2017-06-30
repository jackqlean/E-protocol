// Testando a validação usando jQuery
$(function(){
    // ## EXEMPLO 3
    // Aciona a validação e formatação ao sair do input
    $('.cpf_cnpj').blur(function(){
    
        // O CPF ou CNPJ
        var cpf_cnpj = $(this).val();
        
        // Testa a validação e formata se estiver OK
        if ( formata_cpf_cnpj( cpf_cnpj ) ) {
            $(this).val( formata_cpf_cnpj( cpf_cnpj ) );
        } else {
            alert('CPF ou CNPJ inválido!');
        }
        
    });

});
