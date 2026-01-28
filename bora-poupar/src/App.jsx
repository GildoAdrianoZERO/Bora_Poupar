import { useState, useEffect } from 'react'
import './App.css'
import { gerarNotas } from './FuncaoNotas';

function App() {
  const [valores, setValores] = useState([]);
  const meta = 20000;
  
  useEffect(() => {
    const notasGeradas = gerarNotas(meta);
    setValores(notasGeradas);
  }, []);

  // --- LÓGICA DO CLIQUE ---
  const handleToggle = (id) => {
    setValores(prevValores => {
      return prevValores.map(item => {
        if (item.id === id){
          // CORREÇÃO CRÍTICA: O spread operator (...) mantém o ID e Valor originais
          return { ...item, pago: !item.pago };
        }
        return item;
      });
    });
  };

  // --- CÁLCULO FINANCEIRO (REDUCE) ---
  // Soma apenas os itens que estão com 'pago: true'
  const totalGuardado = valores
    .filter(item => item.pago)
    .reduce((acc, item) => acc + item.valor, 0);

  return (
    <div className="min-h-screen w-full bg-slate-900 text-white font-sans flex flex-col items-center py-10 px-2 md:px-4">
      
      <div className="max-w-4xl w-full">
        
        {/* Cabeçalho */}
        <div className="text-center mb-10 space-y-2">
          <h1 className="text-3xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-amber-300 to-yellow-500 drop-shadow-sm">
            Bora Poupar! 
          </h1>
          <p className="text-slate-400 text-sm md:text-lg">
            Sua meta em pequenas conquistas.
          </p>
        </div>

        {/* Card de Estatísticas */}
        <div className="bg-slate-800 rounded-2xl p-4 md:p-6 mb-8 shadow-xl border border-slate-700 flex flex-col md:flex-row justify-between items-center gap-4 sticky top-2 z-10 backdrop-blur-md bg-slate-800/90">
          <div className="text-center md:text-left">
            <p className="text-slate-400 text-xs md:text-sm uppercase tracking-wider font-semibold">Total Guardado</p>
            {/* Exibindo o valor calculado pelo REDUCE */}
            <p className="text-2xl md:text-3xl font-bold text-green-400">R$ {totalGuardado.toFixed(2)}</p>
            <p className="text-xs text-slate-500 mt-1">Meta: R$ {meta.toFixed(2)}</p>
          </div>
          
          <div className="h-px w-full md:w-px md:h-12 bg-slate-600"></div>

          <div className="text-center md:text-right">
            <p className="text-slate-400 text-xs md:text-sm uppercase tracking-wider font-semibold">Faltam Depositar</p>
            <div className="flex items-center justify-center md:justify-end gap-2">
              <span className="text-2xl md:text-3xl font-bold text-amber-400">
                {valores.filter(v => !v.pago).length}
              </span>
              <span className="text-xs md:text-sm text-slate-400">Depósitos</span>
            </div>
          </div>
        </div>

        {/* Área do Grid */}
        <div className="bg-slate-800/50 rounded-3xl p-4 md:p-8 shadow-2xl border border-slate-700/50 backdrop-blur-sm">
          <h3 className="text-center text-slate-300 mb-6 font-medium text-sm md:text-base">
            Toque para marcar o depósito:
          </h3>
          
          <div className="grid grid-cols-5 gap-2 md:flex md:flex-wrap md:justify-center md:gap-3">
            {valores.map((item) => (
              <div
                key={item.id}
                className="group relative w-full md:w-auto"
                onClick={() => handleToggle(item.id)}
              >
                {/* CSS REFATORADO: Sombras e Cores agora são totalmente condicionais */}
                <div className={`
                  w-full aspect-square md:w-16 md:h-16 
                  rounded-lg md:rounded-2xl
                  flex items-center justify-center 
                  font-bold text-xs md:text-base 
                  
                  active:shadow-none active:translate-y-[3px] 
                  hover:brightness-110 
                  transition-all duration-150 ease-in-out
                  cursor-pointer select-none border-t 
                  
                  ${
                    item.pago 
                    // PAGO (Verde): Fundo verde + Borda verde + Sombra verde escura
                    ? 'bg-emerald-600 text-white border-emerald-500 shadow-[0_3px_0_rgb(6,95,70)] md:shadow-[0_4px_0_rgb(6,95,70)]' 
                    
                    // PENDENTE (Laranja): Gradiente Laranja + Borda branca + Sombra laranja escura
                    : 'bg-gradient-to-br from-amber-400 to-orange-500 text-white border-white/30 shadow-[0_3px_0_rgb(180,83,9)] md:shadow-[0_4px_0_rgb(180,83,9)]'
                  }
                `}>
                  <span className="drop-shadow-md">R${item.valor}</span>
                  {item.pago && <span className="absolute text-emerald-800/30 text-4xl">✓</span>}
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </div>
  );
}

export default App;