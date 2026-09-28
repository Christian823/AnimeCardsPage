type NavbarProps = {
    Inicio:string,
    Anime:string,
    AboutUs:string
}

function NavbarProps({
    Inicio,
    Anime,
    AboutUs
}:NavbarProps){
    return(
    <section className="w-full h-[8vh] bg-slate-900 flex">
      <div className="w-[200px] h-full ml-[120px] bg-slate-900 flex items-center justify-center">{Inicio}</div>
      <div className="w-[200px] h-full ml-[120px] bg-slate-900 flex items-center justify-center">{Anime}</div>
      <div className="w-[200px] h-full ml-[120px] bg-slate-900 flex items-center justify-center">{AboutUs}</div>
    </section>
    )
}

export default NavbarProps;
