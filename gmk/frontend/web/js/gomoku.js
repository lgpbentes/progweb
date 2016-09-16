
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

var modal = document.getElementById('myModal');
var winner = document.getElementById('winner');
var rodada=1;
var size=15;
var matriz
var vencedor = false;

var tabuleiroNum = [];
matrizJogo(15);

// Para fechar o modal no 'X'
span.onclick = function() {
    modal.style.display = "none";
}

// caso seja clicado fora do modal, ele é fechado
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// funcao que inicia as variaveis do jogo
function jogo(){ 
  /*
  essa eh uma matriz que representa o tabuleiro->
  jogador 1: representado por 1;
  jogador 2: representado por 2;

  */
  rodada = 1;

  document.getElementById("j1").style.opacity = 1;
  document.getElementById("j2").style.opacity = 0.3;

  tabuleiroNum = [];
  matrizJogo(15);
  vencedor = false;

  for (row=0; row < 15; row++) { 
    for (col=0; col < 15; col++) {
      document.images[size*row+col].src="rosa.jpg";
    }
  }
}

// funcao que indica em um tabela quem é o jogador da vez
function jogadorVez() {
  if(rodada%2 == 0){
    document.getElementById("j1").style.opacity = 1;
    document.getElementById("j2").style.opacity = 0.3;    
  }else{
    document.getElementById("j2").style.opacity = 1;
    document.getElementById("j1").style.opacity = 0.3;

  }
}

// funcao que recebe o evento de clique em um ponto da tabela
function jogada(linha, coluna){
  if (rodada == 1){
      jogo();
  }
  jogador = 0;
  //se nao tem um vencedor
  if (!vencedor && tabuleiroNum[linha][coluna] == 0) {
    if (rodada%2 == 0){
      tabuleiroNum[linha][coluna] = 2;
      document.images[size*linha+coluna].src = "O.jpg";
      jogador = 2;
      temGanhador(linha, coluna, 2);
    }else{
      tabuleiroNum[linha][coluna] = 1;
      document.images[size*linha+coluna].src = "X.jpg";
      jogador = 1;
      temGanhador(linha, coluna, 1);
    }

    if(vencedor){
        tabuleiroNum = [];
        if (jogador == 1){
          winner.src = "X.jpg";
        } else{
          winner.src = "O.jpg";
        }
    }
    jogadorVez(rodada);
    rodada++;
  }
}

// essa funcao verifica se a ultima jogada gerou um vencedor
// verifica primeiro na seguinte ordem: linha da jogada, coluna da jogada,
// diagonal (esquerda-direita e direita-esquerda)
// recebe a posicao da ultima jogada como parametros
function temGanhador(posX, posY, idJogador){

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
      modal.style.display = "block";
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
      modal.style.display = "block";
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
    } else{
      iguais = 0;
    }

    if(iguais==5){
      vencedor = true;
      modal.style.display = "block";
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

  //contando
  iguais = 0;
  while(dX < 15 && dY >=0){
    if (tabuleiroNum[dX][dY] == idJogador){
      iguais++;
    }else{
      iguais=0;
    }

    if(iguais==5){
      vencedor = true;
      modal.style.display = "block";

      break;
    }
    dX++;
    dY--;
  }
}

// funcao que cria e preenche a matriz tabuleiroNum (15x15) com zeros
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