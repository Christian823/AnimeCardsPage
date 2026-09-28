const animes = [
  {
    id: 1,
    nombre: "Dragon Ball",
    imagen: "/images/goku.jpg"
  },
  {
    id: 2,
    nombre: "Attack on Titan",
    imagen: "/images/aot.jpg"
  },
  {
    id: 3,
    nombre: "Demon Slayer",
    imagen: "/images/demonslayer.jpg"
  }
];

function Anime() {

  return (
    <div className="min-h-svh bg-gray-950 text-white">
      <h1>Selecciona un Anime</h1>
    </div>
  );
}

export default Anime;