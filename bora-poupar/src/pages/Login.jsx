import { useState } from 'react';
import { useNavigate } from 'react-router-dom';

export default function Login() {
  const [email, setEmail] = useState('');
  const navigate = useNavigate(); 

  const handleLogin = (e) => {
    e.preventDefault();
    navigate('/bingo');
  };

  return (
    <div className="min-h-screen flex items-center justify-center bg-slate-900 px-4">
      <div className="bg-slate-800 p-8 rounded-2xl shadow-2xl w-full max-w-sm border border-slate-700">
        <h2 className="text-2xl font-bold text-white mb-6 text-center">Acessar Bingo</h2>
        
        <form onSubmit={handleLogin} className="space-y-4">
          <input 
            type="email" 
            placeholder="Seu e-mail"
            className="w-full p-3 rounded-lg bg-slate-700 text-white border border-slate-600 outline-none focus:border-amber-500"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
          />
          <button className="w-full bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-3 rounded-lg transition-colors">
            Entrar no Jogo
          </button>
        </form>
      </div>
    </div>
  );
}