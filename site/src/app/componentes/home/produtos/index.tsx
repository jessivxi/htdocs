export  async function Produtos() {


    interface produto {    //uma interface para facilitar o uso de tipos
        id: number;
        produto: string;
        descricao: string;
        preco: number;
        imagem: string;
    }

    const produtos: produto[] = [ //simular banco de dados
        {
            id: 1,
            produto: "Notebook",
            descricao: "Notebook potente para trabalho e estudo.",
            preco: 3500,
            imagem: "https://placehold.co/300x200.png?text=Notebook"
        },
    ]


    
    const api = await fetch("http://localhost:8080/produtos", { //realizar a requisição para obter o produtos da nossa API
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    }). then((res) => {
        console.log(res);
    })

    return (
        <section className="w-full bg-gray-100 flex flex-col items-center justify-center py-10">
            <h2 className="text-5xl font-bold text-black mb-6">Produtos</h2>
            <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 w-full max-w-screen-xl px-4">
                {produtos.map((produto, index) => (
                    <div
                        key={produto.id}
                        className="bg-white p-4 rounded-lg shadow-md transition-transform duration-300 hover:scale-100 hover:shadow-lg"
                    >
                        <img
                            src={produto.imagem}
                            alt={produto.produto}
                            className="w-full h-40 object-cover mb-4 rounded"
                        />
                        <h3 className="text-lg font-semibold text-gray-800">{produto.produto}</h3>
                        <p className="text-gray-600 mt-2">{produto.descricao}</p>
                        <p className="text-green-600 font-bold mt-2">R$ {produto.preco},00</p>
                    </div>
                ))}
            </div>
        </section>
    );
}