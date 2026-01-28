const notasDisponiveis = [200, 100, 50, 20, 10, 5];

export const gerarNotas = (metaAlvo) => {
  let somaAtual = 0;
  const listaDeNotas = [];

  if (!metaAlvo || metaAlvo <= 0) return [];

  while (somaAtual < metaAlvo) {
    const falta = metaAlvo - somaAtual;
    const notasPossiveis = notasDisponiveis.filter(nota => nota <= falta);

    if (notasPossiveis.length === 0) break;
    const indiceAleatorio = Math.floor(Math.random() * notasPossiveis.length);
    const notaSelecionada = notasPossiveis[indiceAleatorio];

    const novaNota ={
      id: crypto.randomUUID(),
      valor: notaSelecionada,
      pago: false
    };
    
    listaDeNotas.push(novaNota);
    somaAtual += notaSelecionada;
  }
  return listaDeNotas;
}