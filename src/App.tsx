import { useState } from 'react';
import './App.css';
import CarruselProps from './components/carrusel';
import NavbarProps from './components/navbar';

const Inicio:string = "Inicio";
const Anime:string = "Animes";
const AboutUs:string = "Acerca De";

const imagenes = [
  "demonslayer.jpeg",
  "goku.jpeg",
  "codegeass.jpg",
  "aot.jpg",
  "fullmetal.jpeg"
]

function App() {

const [indice,setIndice] = useState(0);

const siguiente = () => {
  setIndice((indice + 1) % imagenes.length);
}

const anterior = () => {
  setIndice((indice - 1 + imagenes.length) % imagenes.length); 
}
  return(
  <div className="min-h-svh bg-gray-950">
    <NavbarProps Inicio={Inicio} Anime={Anime} AboutUs={AboutUs}/>
    <section className="w-full h-[100px] flex items-center justify-center">
      <div>COLLECCIONA TUS CARTAS DE ANIME FAVORITAS</div>
    </section>
    <CarruselProps imagenes={imagenes} indice={indice} siguiente={siguiente} anterior={anterior} setIndice={setIndice}/>
    <div className="w-full h-[150px] flex items-center justify-center"><button className='h-[75px] w-[150px] bg-gray-800 border-4 rounded-lg'>Iniciar Session</button></div>
    <></>
  </div>
  )
}

export default App