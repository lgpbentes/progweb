var rodada=1;
var size=15;
var matriz
var vencedor = false;

tabuleiroNum = [];
matrizJogo(15);

function jogo(){ 
  /*
  essa eh uma matriz que representa o tabuleiro->
  jogador 1: representado por 1;
  jogador 2: representado por 2;

  */
  tabuleiroNum = [];
  matrizJogo(15);
  vencedor = false;

  for (row=0; row < 15; row++) { 
    for (col=0; col < 15; col++) {
      document.images[size*row+col].src="rosa.jpg";
    }
  }
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
  //se nao tem um vencedor
  if (!vencedor) {
    if (rodada == 1){
      jogo();
    }

    if (rodada%2 == 0){
      document.images[size*linha+coluna].src = "O.jpg";
      tabuleiroNum[linha][coluna] = 2;
      temGanhador(linha, coluna, 2);
    }else{
      tabuleiroNum[linha][coluna] = 1;
      document.images[size*linha+coluna].src = "X.jpg";
      temGanhador(linha, coluna, 1);
      if(vencedor){
        tabuleiroNum = [];
        //exibir tela de vencedor aqui
      }
    }
    jogadorVez(rodada);
    rodada++;
  }

  
  
}

// essa funcao recebe a posicao da ultima jogada como parametros
function temGanhador(posX, posY, idJogador){
    /*for(row=0;row<15;row++){
    for(col=0;col<15;col++){
      
      if (document.images[size*row+col].src==caminhoImg){
        contzinho++;
      }
    }
  }*/

  //verifica na horizontal
  var iguais = 0;
  for(y = 0; y < 15; y++){
    
    if(tabuleiroNum[posX][y] == idJogador){
      iguais = iguais+1;
    } else{
      iguais=0;
    }

    if(iguais==5){
      vencedor = true;
      window.alert("Temos um vencedor!!!")
      break;
    }
  }

  //verifica na vertical
  iguais = 0;
  for(x = 0; x < 15; x++){
    if(tabuleiroNum[x][posY] == idJogador){
      iguais = iguais+1;
    } else{
      iguais=0;
    }

    if(iguais==5){
      vencedor = true;
      window.alert("Temos um vencedor!!!")
      break;
    }
  }

  var dX, dY;
  dX = posX;
  dY = posY;
  //verifica na diagonal (left-to-right)  
  if (dX > dY){
    dX = dX - dY;
    dY = 0;
  }else{
    dY = dY - dX;
    dX = 0;
  }

  iguais = 0;
  while(dX < 15 && dY < 15){
    if (tabuleiroNum[dX][dY] == idJogador){
      iguais++;
    }

    if(iguais==5){
      vencedor = true;
      window.alert("Temos um vencedor!!!")
      break;
    }
    //console.log(posX+", "+posY);
    dX++;
    dY++;
  }

  // vertical right-to-left
  dX = posX;
  dY = posY;

  // achando a posicao inicial
  while((dX >= 1 && dX <14) && (dY >= 1 && dY < 14)){
    
    dX--;
    dY++;
  }
  console.log(dX + ", " + dY);
  //contando
  iguais = 0;
  while(dX < 15 && dY >=0){
    console.log(dX + ", " + dY);
    if (tabuleiroNum[dX][dY] == idJogador){
      iguais++;
    }

    if(iguais==5){
      vencedor = true;
      break;
    }
    dX++;
    dY--;
  }



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