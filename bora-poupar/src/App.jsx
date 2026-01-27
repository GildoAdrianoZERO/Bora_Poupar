import { useState } from 'react'
import './App.css'

function App() {

  const quadrados = Array(100).fill(0);

  return (
    <>
      <div className="min-h-screen flex items-center justify-center bg-gray-100 p-4"> 
        <div className="grid grid-cols-10 gap-2">
          {
            quadrados.map((item, index) => (
            <div key={index} className="w-10 h-10 bg-amber-600 border border-amber-800 rounded shadow-sm">

            </div>

          ))}
          
        </div>
      </div>
    </>
  )
}

export default App
