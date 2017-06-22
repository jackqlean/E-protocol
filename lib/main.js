function txtBoxFormat(objeto, sMask, evtKeyPress) {
    var i, nCount, sValue, fldLen, mskLen,bolMask, sCod, nTecla;


if(document.all) { // Internet Explorer
    nTecla = evtKeyPress.keyCode;
} else if(document.layers) { // Nestcape
    nTecla = evtKeyPress.which;
} else {
    nTecla = evtKeyPress.which;
    if (nTecla == 8) {
        return true;
    }
}

    sValue = objeto.value;

    // Limpa todos os caracteres de formatação que
    // já estiverem no campo.
    sValue = sValue.toString().replace( "-", "" );
    sValue = sValue.toString().replace( "-", "" );
    sValue = sValue.toString().replace( ".", "" );
    sValue = sValue.toString().replace( ".", "" );
    sValue = sValue.toString().replace( "/", "" );
    sValue = sValue.toString().replace( "/", "" );
    sValue = sValue.toString().replace( ":", "" );
    sValue = sValue.toString().replace( ":", "" );
    sValue = sValue.toString().replace( "(", "" );
    sValue = sValue.toString().replace( "(", "" );
    sValue = sValue.toString().replace( ")", "" );
    sValue = sValue.toString().replace( ")", "" );
    sValue = sValue.toString().replace( " ", "" );
    sValue = sValue.toString().replace( " ", "" );
    fldLen = sValue.length;
    mskLen = sMask.length;

    i = 0;
    nCount = 0;
    sCod = "";
    mskLen = fldLen;

    while (i <= mskLen) {
      bolMask = ((sMask.charAt(i) == "-") || (sMask.charAt(i) == ".") || (sMask.charAt(i) == "/") || (sMask.charAt(i) == ":"))
      bolMask = bolMask || ((sMask.charAt(i) == "(") || (sMask.charAt(i) == ")") || (sMask.charAt(i) == " "))

      if (bolMask) {
        sCod += sMask.charAt(i);
        mskLen++; }
      else {
        sCod += sValue.charAt(nCount);
        nCount++;
      }

      i++;
    }

    objeto.value = sCod;

    if (nTecla != 8) { // backspace
      if (sMask.charAt(i-1) == "9") { // apenas números...
        return ((nTecla > 47) && (nTecla < 58)); } 
      else { // qualquer caracter...
        return true;
      } 
    }
    else {
      return true;
    }
  }

function VerificaCPF () {
<!-- JavaScript que validará o campo CPF! -->
   var cpf = document.cadastro.txtCpf.value;
   var filtro = /^\d{3}.\d{3}.\d{3}-\d{2}$/i;
   if(!filtro.test(cpf)){
     window.alert("CPF inválido. Tente novamente.");
     return false;
   }
   
   cpf = remove(cpf, ".");
   cpf = remove(cpf, "-");
    
   if(cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" ||
      cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" ||
      cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" ||
      cpf == "88888888888" || cpf == "99999999999"){
      window.alert("CPF inválido. Tente novamente.");
      return false;
   }

   soma = 0;
   for(i = 0; i < 9; i++)
     soma += parseInt(cpf.charAt(i)) * (10 - i);
   resto = 11 - (soma % 11);
   if(resto == 10 || resto == 11)
     resto = 0;
   if(resto != parseInt(cpf.charAt(9))){
     window.alert("CPF inválido. Tente novamente.");
     return false;
   }
   soma = 0;
   for(i = 0; i < 10; i ++)
     soma += parseInt(cpf.charAt(i)) * (11 - i);
   resto = 11 - (soma % 11);
   if(resto == 10 || resto == 11)
     resto = 0;
   if(resto != parseInt(cpf.charAt(10))){
     window.alert("CPF inválido. Tente novamente.");
     return false;
   }
   return true;
 }
 
 function remove(str, sub) {
   i = str.indexOf(sub);
   r = "";
   if (i == -1) return str;
   r += str.substring(0,i) + remove(str.substring(i + sub.length), sub);
   return r;
 }
<!-- Fim do JavaScript que validará o campo CPF! -->

function nu(campo){
<!-- JavaScript que validará o campo RG! -->
var digits="0123456789"
var campo_temp 
for (var i=0;i<campo.value.length;i++){
campo_temp=campo.value.substring(i,i+1) 
if (digits.indexOf(campo_temp)==-1){
campo.value = campo.value.substring(0,i);
break;
}
}
}

function ValRG(numero){
 
 var numero = numero.split("");
 tamanho = numero.length;
 vetor = new Array(tamanho);

if(tamanho>=1)
{
 vetor[0] = parseInt(numero[0]) * 2; 
}
if(tamanho>=2){
 vetor[1] = parseInt(numero[1]) * 3; 
}
if(tamanho>=3){
 vetor[2] = parseInt(numero[2]) * 4; 
}
if(tamanho>=4){
 vetor[3] = parseInt(numero[3]) * 5; 
}
if(tamanho>=5){
 vetor[4] = parseInt(numero[4]) * 6; 
}
if(tamanho>=6){
 vetor[5] = parseInt(numero[5]) * 7; 
}
if(tamanho>=7){
 vetor[6] = parseInt(numero[6]) * 8; 
}
if(tamanho>=8){
 vetor[7] = parseInt(numero[7]) * 9; 
}
if(tamanho>=9){
 vetor[8] = parseInt(numero[8]) * 100; 
}

 total = 0;

if(tamanho>=1){
 total += vetor[0];
}
if(tamanho>=2){
 total += vetor[1]; 
}
if(tamanho>=3){
 total += vetor[2]; 
}
if(tamanho>=4){
 total += vetor[3]; 
}
if(tamanho>=5){
 total += vetor[4]; 
}
if(tamanho>=6){
 total += vetor[5]; 
}
if(tamanho>=7){
 total += vetor[6];
}
if(tamanho>=8){
 total += vetor[7]; 
}
if(tamanho>=9){
 total += vetor[8]; 
}


resto = total % 11;
if(resto!=0){
window.alert("RG inválido. Tente novamente.");
}
}

function mudaMascara() {

}
