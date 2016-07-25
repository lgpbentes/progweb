var rodada=1;
var size=15;
var matriz

function jogo(){ 
  /*
  essa eh uma matriz que representa o tabuleiro->
  jogador 1: representado por 1;
  jogador 2: representado por 2;

  */
  tabuleiroNum = [];
  matrizJogo(15);
 
  /*//imprimindo a matriz loca
  var tmp, rs="";
  for (var i = 0; i < 15; i++) {
    tmp="";
    for (var j = 0; j < 15; j++) {
      tmp+= tabuleiroNum[i][j]+" ";
    }
    rs+=tmp+"\n";
  }
  //rsrsrsrsrsr
  window.alert(rs);*/
}

function jogadorVez() {
  if(rodada%2 == 0){
    document.getElementById("j1").style.opacity = 1;
    document.getElementById("j2").style.opacity = 0.3;    
  }else{
    document.getElementById("j2").style.opacity = 1;
    document.getElementById("j1").style.opacity = 0.3;

  }
}

function jogada(linha, coluna){
  if (rodada%2 == 0){
    /*Nao tenho ideia do que isso faz*/
    document.images[size*linha+coluna].src = "O.jpg";
    tabuleiroNum[linha][coluna] = 2;
  }else{
    tabuleiroNum[linha][coluna] = 1;
    document.images[size*linha+coluna].src = "X.jpg";
  }
  
  //imprimindo a matriz loca
  var tmp, rs="";
  for (var i = 0; i < 15; i++) {
    tmp="";
    for (var j = 0; j < 15; j++) {
      tmp+= tabuleiroNum[i][j]+" ";
    }
    rs+=tmp+"\n";
  }
  //rsrsrsrsrsr
  window.alert(rs);

  temGanhador(document.images[size*linha+coluna].src);
  jogadorVez(rodada);
  rodada++;
}

function temGanhador(caminhoImg){
  var contzinho=0;

  for(row=0;row<15;row++){
    for(col=0;col<15;col++){
      // assim que se acessa um elemento da matriz :((
      if (document.images[size*row+col].src==caminhoImg){
        contzinho++;
      }
    }
  }

  console.log(contzinho);

}

var tabuleiroNum = [];
function matrizJogo(rows) {
  for (var i=0;i<rows;i++) {
     tabuleiroNum[i] = [[]];
  }

   for (var i = 0; i < 15; i++) {
    for (var j = 0; j < 15; j++) {
      tabuleiroNum[i][j] = 0;
    }
  }
}