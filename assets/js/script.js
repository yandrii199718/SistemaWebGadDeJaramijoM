//agrego el nombre de una imagen a un label
$(document).on("change", ".custom-file-input", function(e){
  elementoAnterior = $(this).prev();
  nombre = e.target.files[0].name;
  elementoAnterior.html(nombre);
})
