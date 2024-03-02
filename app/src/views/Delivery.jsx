import {Link, useParams} from "react-router-dom";
import {useEffect, useState} from "react";
import axiosClient from "../axios-client.js";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faEye} from "@fortawesome/free-solid-svg-icons";

export default function Delivery(){
    const [rastreamentos, setRastreamento] = useState([]);
    const [transportadora, setTransportadora] = useState({
        cnpj: '',
        fantasia: '',
        transportadora_id: ''
    })
    const [destinatario, setDestinario] = useState({
        nome: '',
        cpf: '',
        endereco: '',
        estado: '',
        pais: '',
        cep: ''
    })
    const [delivery, setDelivery] = useState({
        entrega_id: '',
        volumes: '',
        remetente: ''
    });

    let {id} = useParams();

    useEffect(() => {
        getDelivery(id);
    }, [])

    const getDelivery = (id) => {
        axiosClient.get(`/delivery/${id}`)
            .then(({data}) => {
                console.log(data.data)
                setDelivery(data.data)
                setDestinario(data.data.destinatario)
                setTransportadora(data.data.transportadora)
                setRastreamento(data.data.rastreamentos)
            }).catch(error => {
                const response = error.response
                console.log(response.data.errors);
            })
    }

    return(
        <div>
            <div className='row'>
                <h4>Detalhes da entrega</h4>
                <hr className='border-3 mb-4'/>
                <div className='row'>
                    <div className='col-5'>
                        <label className='form-label'>Identificação da entrega</label>
                        <input className="form-control" type="text" value={delivery.entrega_id} readOnly/>
                    </div>
                    <div className='col-5'>
                        <label className='form-label'>Remetente</label>
                        <input className="form-control" type="text" value={delivery.remetente} readOnly/>
                    </div>
                    <div className='col-2'>
                        <label className='form-label'>Volumes</label>
                        <input className="form-control" type="text" value={delivery.volumes} readOnly/>
                    </div>
                </div>
                <h4 className='mt-3'>Detalhes do destinario</h4>
                <hr className='border-3 mb-4'/>
                <div className='row'>
                    <div className='col-6'>
                        <label className='form-label'>Nome</label>
                        <input className="form-control" type="text" value={destinatario.nome} readOnly/>
                    </div>
                    <div className='col-6'>
                        <label className='form-label'>CPF</label>
                        <input className="form-control" type="text" value={destinatario.cpf} readOnly/>
                    </div>
                </div>
                <div className='row'>
                    <div className='col-9'>
                        <label className='form-label'>Endereço</label>
                        <input className="form-control" type="text"
                               value={destinatario.endereco + ', ' + destinatario.estado + ', ' + destinatario.pais}
                               readOnly/>
                    </div>
                    <div className='col-3'>
                        <label className='form-label'>CEP</label>
                        <input className="form-control" type="text" value={destinatario.cep} readOnly/>
                    </div>
                </div>
                <h4 className='mt-3'>Detalhes do transportadora</h4>
                <hr className='border-3 mb-4'/>
                <div className='row'>
                    <div className='col-4'>
                        <label className='form-label'>Identificação da transportadora</label>
                        <input className="form-control" type="text" value={transportadora.transportadora_id} readOnly/>
                    </div>
                    <div className='col-4'>
                        <label className='form-label'>CNPJ</label>
                        <input className="form-control" type="text" value={transportadora.cnpj} readOnly/>
                    </div>
                    <div className='col-4'>
                        <label className='form-label'>Nome fantasia</label>
                        <input className="form-control" type="text" value={transportadora.fantasia} readOnly/>
                    </div>
                </div>
                <h4 className='mt-3'>Histórico de rastreamento</h4>
                <hr className='border-3 mb-4'/>
                <div className='row'>
                    <table className="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Data</th>
                            <th scope="col">Mensagem</th>
                        </tr>
                        </thead>
                        <tbody>
                            {rastreamentos.map((ras, index) => (
                                <tr key={index}>
                                    <td>{ras.data}</td>
                                    <td>{ras.mensagem}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    )
}