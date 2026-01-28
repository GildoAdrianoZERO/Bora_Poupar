import { useState, useEffect } from 'react'
import './App.css'
import { gerarNotas } from './FuncaoNotas';


function App() {
  const [valores, setValores] = useState([]);
  const meta = 4000;
  
  useEffect(() => {
    const notasGeradas = gerarNotas(meta);
    setValores(notasGeradas);
  } , []);


return (
    // 1. AJUSTE DE FUNDO: 'min-h-screen' garante altura total e 'w-full' largura total
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
        <div className="bg-slate-800 rounded-2xl p-4 md:p-6 mb-8 shadow-xl border border-slate-700 flex flex-col md:flex-row justify-between items-center gap-4">
          <div className="text-center md:text-left">
            <p className="text-slate-400 text-xs md:text-sm uppercase tracking-wider font-semibold">Meta Total</p>
            <p className="text-2xl md:text-3xl font-bold text-green-400">R$ {meta.toFixed(2)}</p>
          </div>
          
          <div className="h-px w-full md:w-px md:h-12 bg-slate-600"></div>

          <div className="text-center md:text-right">
            <p className="text-slate-400 text-xs md:text-sm uppercase tracking-wider font-semibold">Faltam Depositar</p>
            <div className="flex items-center justify-center md:justify-end gap-2">
              <span className="text-2xl md:text-3xl font-bold text-amber-400">{valores.length}</span>
              <span className="text-xs md:text-sm text-slate-400">Depositos</span>
            </div>
          </div>
        </div>

        {/* Área do Grid */}
        <div className="bg-slate-800/50 rounded-3xl p-4 md:p-8 shadow-2xl border border-slate-700/50 backdrop-blur-sm">
          <h3 className="text-center text-slate-300 mb-6 font-medium text-sm md:text-base">
            Toque para marcar o depósito:
          </h3>
          
          {/* 2. AJUSTE DO GRID: 
             - 'grid grid-cols-5': No celular (mobile-first), força 5 colunas.
             - 'md:flex md:flex-wrap': Em telas médias/PC, volta a ser flexível para ficar bonito.
             - 'gap-2': Espaçamento menor no celular para caber tudo.
          */}
          <div className="grid grid-cols-5 gap-2 md:flex md:flex-wrap md:justify-center md:gap-3">
            {valores.map((valor, index) => (
              <div
                key={index}
                className="group relative w-full md:w-auto" // w-full faz ocupar a coluna toda do grid
              >
                {/* Botão Ajustado:
                   - 'aspect-square': Mantém o botão quadrado mesmo esticando.
                   - Removemos tamanhos fixos (w-14) no mobile para ele se adaptar à grade de 5.
                */}
                <div className="
                  w-full aspect-square md:w-16 md:h-16 
                  bg-gradient-to-br from-amber-400 to-orange-500 
                  rounded-lg md:rounded-2xl
                  flex items-center justify-center 
                  text-white font-bold text-xs md:text-base 
                  shadow-[0_3px_0_rgb(180,83,9)] md:shadow-[0_4px_0_rgb(180,83,9)]
                  active:shadow-none active:translate-y-[3px] 
                  hover:brightness-110 
                  transition-all duration-150 ease-in-out
                  cursor-pointer select-none border-t border-white/30
                ">
                  <span className="drop-shadow-md">R${valor}</span>
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