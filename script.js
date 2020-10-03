$(document).ready(function()
{	


	 //EVENTO PARA QUANDO SUBMITAMOS O FORMULÁRIO 
    $('#formulario-arquivo').submit(function(e) {
        e.preventDefault();
      	
        //let formulario = $("#formulario-arquivo");
		let arquivo = $("#arquivo"); //pega o campo arquivo
		arquivo = arquivo[0].files; //pega a lista de arquivos	
		file = arquivo[0]; // pega o arquivo ZERO
	

		// Apenas arquivos com menos de 2MB é permitido
		if (file.size > 2*1024*1024) {
			alert("Tamanho do arquivo superior a 2MB");
			return;
		}
		
		let formulario = $('#formulario-arquivo')[0];
		let data = new FormData(formulario);

        enviarArquivos(data);
    });


	function enviarArquivos(data)
	{			

			$.ajax
			({
				url: "import.php",
				type: "POST",
				enctype: "multipart/form-data",				
				data: data,
				dataType: "json",
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000

			}).done(function(retorno) 
			{
					if(retorno == "sucesso")
					{
						alert("Dados Inseridos com Sucesso!");
						location.reload();
					}
					else
					{	
						alert("Dados não inseridos");
						location.reload();
					}	



			}).fail(function() 
			{
					alert("Arquivo não enviado");
					
			});

		   
	}


});
