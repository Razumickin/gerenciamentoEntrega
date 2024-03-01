import {useEffect, useRef, useState} from "react";
import axiosClient from "../axios-client.js";

export default function Deliveries(){
    const [deliveries, setDeliveries] = useState([]);

    useEffect(() => {
        getDeliveries();
    }, [])

    const getDeliveries = () => {
        axiosClient.get('/deliveries')
            .then(({ data }) => {
                console.log(data.data);
                setDeliveries(data.data)
            })
    }

    const cpfRef = useRef();
    const onSubmit = (ev)=> {
        ev.preventDefault()

        const payload = {
            cpf: cpfRef.current.value
        }

        axiosClient.post('/deliveries', payload)
            .then(({data}) => {
                console.log(data);
            }).catch(error => {
                const response = error.response
                console.log(response.data.errors);
            })
    }

    return(
        <div>
            <div className='form row'>
                <form onSubmit={onSubmit}>
                    <div className='row mb-1'>
                        <label className='col-sm-1 col-form-label col-form-label-sm'>CPF</label>
                        <div className="col-sm-10">
                            <input ref={cpfRef} className='form-control form-control-sm'/>
                        </div>
                        <div className="col-sm-1">
                            <button className="btn btn-primary">Filtrar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div className='row'>
                <table className='table table-hover'>
                    <thead>
                    <tr>
                        <th scope="col">Nome destinatario</th>
                        <th scope="col">CPF destinatario</th>
                        <th scope="col">Endereço de entrega</th>
                        <th scope="col">Volumes</th>
                        <th scope="col">Remetente</th>
                        <th scope="col">Transportadora</th>
                        <th scope="col">Ultima atualização</th>
                    </tr>
                    </thead>
                    <tbody>
                        {deliveries.map(del => (
                            <tr key={del.entrega_id}>
                                <td>{del.destinatario.nome}</td>
                                <td>{del.destinatario.cpf}</td>
                                <td>{del.destinatario.endereco}, {del.destinatario.cep}, {del.destinatario.estado}, {del.destinatario.pais}</td>
                                <td>{del.volumes}</td>
                                <td>{del.remetente}</td>
                                <td>{del.transportadora.fantasia}</td>
                                <td>{del.ultimoRastreamento.mensagem}</td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>
    )
}