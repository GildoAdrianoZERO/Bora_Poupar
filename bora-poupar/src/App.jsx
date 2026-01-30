import { Routes, Route } from 'react-router-dom';
import Login from './pages/Login';
import Bingo from './pages/Bingo';

function App() {
  return (
    <Routes>
      <Route path="/" element={<Login />} />
      <Route path="/bingo" element={<Bingo />} />
    </Routes>
  );
}

export default App;