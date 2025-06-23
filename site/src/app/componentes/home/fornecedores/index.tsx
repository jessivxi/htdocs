export async function Fornecedores() {

    interface Fornecedor{
        razao_social: string;
        CNPJ: string;
        email: string;
        telefone: string;
    }

    let fornecedores = { data: [] as Fornecedor[] };
    try {
        const response = await fetch('http://localhost:8080/fornecedores', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
        });

        if (!response.ok) {
            throw new Error('Erro ao buscar fornecedores');
        }

        fornecedores = await response.json();
    } catch (error) {
        console.error('Falha ao buscar fornecedores:', error);
        // fornecedores permanece como array vazio
    }

    return (
        <section className="w-full bg-gray-100 flex flex-col items-center justify-center py-10">
            <h2 className="text-5xl font-bold text-black mb-6">Fornecedores</h2>
            <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 w-full max-w-screen-xl px-4">
                {fornecedores['data'].map((fornecedor: Fornecedor, index: number) => (
                    <div key={index} className="bg-white p-4 rounded-lg shadow-md transition-transform duration-300 hover:scale-100 hover:shadow-lg">
                        <h3 className="text-lg font-semibold text-gray-800">{fornecedor.razao_social}</h3>
                        <p className="text-gray-600 mt-2">CNPJ: {fornecedor.CNPJ}</p>
                        <p className="text-gray-600 mt-2">Email: {fornecedor.email}</p>
                        <p className="text-gray-600 mt-2">Telefone: {fornecedor.telefone}</p>
                    </div>
                ))}
            </div>
        </section>
    );
}