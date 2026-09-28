import type {Dispatch, SetStateAction} from "react";

type CarruselProps = {
    indice:number,
    setIndice:Dispatch<SetStateAction<number>>;
    imagenes:string[],
    siguiente: () => void;
    anterior: () => void;

}


function CarruselProps({
  indice,
  setIndice,
  imagenes,
  siguiente,
  anterior
}:CarruselProps){
  return(
     <section className="w-full h-[60vh] flex items-center justify-center relative">
        <button
          onClick={anterior}
          className="absolute left-5 text-white text-4xl"
        >
          ←
        </button>

        <img
          src={imagenes[indice]}
          alt="Imagen del carrusel"
          className="w-[70%] h-[90%] object-contain rounded-xl"
        />

        <button
          onClick={siguiente}
          className="absolute right-5 text-white text-4xl"
        >
          →
        </button>
      </section>
  )
}

export default CarruselProps;