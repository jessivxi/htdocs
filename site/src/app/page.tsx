
import {BannerHome} from "./componentes/home/bannerHome";
import { Clientes } from "./componentes/home/Clientes";
import { Fornecedores } from "./componentes/home/fornecedores";
import { Produtos } from "./componentes/home/produtos";
export default function Home() {
  return (
    <div>
    <BannerHome/>
    <Produtos/>  
    <Clientes/>
    <Fornecedores/>
    
    
    </div>

  );
}
