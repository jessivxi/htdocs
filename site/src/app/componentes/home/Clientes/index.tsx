export async function Clientes() {
    interface Cliente {
        imagem: string;
        nome: string;
        email: string;
        whatsapp: string;
    }

    let clientes = { data: [] as Cliente[] };

    try {
        const response = await fetch('http://localhost:8080/clientes', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
        });

        if (!response.ok) {
            throw new Error('Erro ao buscar clientes');
        }

        clientes = await response.json();
    } catch (error) {
        console.error('Falha ao buscar clientes:', error);
        // clientes permanece como array vazio
    }

    return (
        <section className="w-full bg-gray-300 flex flex-col items-center justify-center py-10">
            <h2 className="text-5xl font-bold text-black mb-6">Clientes</h2>
            <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 w-full max-w-screen-xl px-4">
                {clientes['data'].map((cliente: Cliente, index: number) => (
                    <div key={index} className="flex flex-col items-center">
                        <div className="bg-white p-4 rounded-full shadow-md flex items-center justify-center w-40 h-40 mb-4">
                            <img
                                src={`http://localhost:8081/clientes/imagens/${cliente.imagem}`}
                                alt={cliente.nome}
                                className="w-32 h-32 object-cover rounded-full"
                            />
                        </div>
                        <h3 className="text-lg font-semibold text-gray-800">{cliente.nome}</h3>
                        <p className="text-gray-600 mt-2">Email: {cliente.email}</p>
                        <p className="text-gray-600 mt-2">Whatsapp: {cliente.whatsapp}</p>
                    </div>
                ))}
            </div>
        </section>
    );
}
