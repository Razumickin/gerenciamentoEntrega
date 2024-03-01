import {useEffect, useRef, useState} from "react";
import axiosClient from "../axios-client.js";

/**
 * Font Awesome Icons
 * */
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faEye} from "@fortawesome/free-solid-svg-icons";
import {Link} from "react-router-dom";


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
            }).catch(error => {
                const response = error.response
                console.log(response.data.errors);
            })
    }

    return(
        <div>
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
                        <th scope="col">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                        {deliveries.map(del => (
                            <tr  key={del.entrega_id}>
                                <td><span className='fs-6'>{del.destinatario.nome}</span></td>
                                <td>{del.destinatario.cpf}</td>
                                <td>{del.destinatario.endereco}, {del.destinatario.cep}, {del.destinatario.estado}, {del.destinatario.pais}</td>
                                <td>{del.volumes}</td>
                                <td>{del.remetente}</td>
                                <td>{del.transportadora.fantasia}</td>
                                <td>{del.ultimoRastreamento.mensagem}</td>
                                <td className='align-middle'><Link to={'/delivery/' + del.entrega_id} className='btn btn-outline-dark btn-sm'><FontAwesomeIcon icon={faEye}/></Link></td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>
    )
}