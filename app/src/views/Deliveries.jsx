import {useEffect, useRef, useState} from "react";
import axiosClient from "../axios-client.js";

/**
 * Font Awesome Icons
 * */
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faEraser, faEye, faMagnifyingGlass} from "@fortawesome/free-solid-svg-icons";
import {Link} from "react-router-dom";

export default function Deliveries(){
    const [entregas, setEntregas] = useState([]);
    const [carregando, setCarregando] = useState(true)
    
    useEffect(() => {
        getEntregas();
    }, [])

    const getEntregas = () => {
        axiosClient.get('/deliveries')
            .then(({ data }) => {
                setEntregas(data.data)
                setCarregando(false)
            }).catch(error => {
            const response = error.response
            console.log(response.data.errors);
        })
    }

    const destinarioCpfRef = useRef(null)
    const getEntregasByDestinarioCpf = (ev) => {
        ev.preventDefault()

        const payload = {
            destinario_cpf: destinarioCpfRef.current.value
        }

        setCarregando(true)

        if(payload.destinario_cpf === '')
        {
            axiosClient.get('/deliveries')
                .then(({ data }) => {
                    setEntregas(data.data)
                    setCarregando(false)
                }).catch(error => {
                const response = error.response
                console.log(response.data.errors);
            })
        }
        else
        {
            setEntregas([])
            axiosClient.post('/deliveries', payload)
                .then(({data}) => {
                    setEntregas(data.data)
                    setCarregando(false)
                }).catch(error => {
                const response = error.response
                console.log(response.data.errors);
            })
        }
    }

    const limparInputDestinatarioCpf = (ev) => {
        ev.preventDefault()

        destinarioCpfRef.current.value = "";

        setCarregando(true)

        axiosClient.get('/deliveries')
            .then(({ data }) => {
                setEntregas(data.data)
                setCarregando(false)
            }).catch(error => {
            const response = error.response
            console.log(response.data.errors);
        })
    }

    return(
        <div className='row'>
            <form onSubmit={getEntregasByDestinarioCpf}>
                <div className='row g-3 mb-2'>
                    <div className='offset-7 col-2 text-end'>
                        <label htmlFor='inputDestinatarioCpf' className='col-form-label'>Destinatario CPF:</label>
                    </div>
                    <div className='col-3 text-end'>
                        <div className='row'>
                            <div className='col-8'>
                                <input ref={destinarioCpfRef} id='inputDestinatarioCpf' className='form-control'/>
                            </div>
                            <div className='col-2'>
                                <button onClick={limparInputDestinatarioCpf} type="button" className='btn btn-outline-dark'>
                                    <FontAwesomeIcon icon={faEraser}/>
                                </button>
                            </div>
                            <div className='col-2'>
                                <button type="submit" className='btn btn-outline-success'>
                                    <FontAwesomeIcon icon={faMagnifyingGlass}/>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <hr className='border-3 mb-2'/>
            <table className='table table-hover'>
                <thead className='border-1'>
                <tr>
                    <th scope="col" className='align-middle border-1'>Nome destinatario</th>
                    <th scope="col" className='align-middle border-1'>CPF destinatario</th>
                    <th scope="col" className='align-middle border-1'>Endereço de entrega</th>
                    <th scope="col" className='align-middle border-1'>Volumes</th>
                    <th scope="col" className='align-middle border-1'>Remetente</th>
                    <th scope="col" className='align-middle border-1'>Transportadora</th>
                    <th scope="col" className='align-middle border-1'>Ultima atualização</th>
                    <th scope="col" className='align-middle border-1'>Ações</th>
                </tr>
                </thead>
                <tbody className='border-1'>
                    {carregando &&
                        <tr>
                            <td colSpan='8' className='align-middle text-center'>
                                Carregando entregas...
                                <div className=" ms-1 spinner-grow spinner-grow-sm" role="status">
                                    <span className="sr-only">Loading...</span>
                                </div>
                            </td>
                        </tr>
                    }
                    {!carregando && entregas.map(del => (
                        <tr key={del.entrega_id}>
                            <td className='align-middle'>{del.destinatario.nome}</td>
                            <td className='align-middle'>{del.destinatario.cpf}</td>
                            <td className='align-middle'>{del.destinatario.endereco}, {del.destinatario.cep}, {del.destinatario.estado}, {del.destinatario.pais}</td>
                            <td className='align-middle'>{del.volumes}</td>
                            <td className='align-middle'>{del.remetente}</td>
                            <td className='align-middle'>{del.transportadora.fantasia}</td>
                            <td className='align-middle'>{del.ultimoRastreamento.mensagem}</td>
                            <td className='align-middle'>
                                <Link to={'/delivery/' + del.entrega_id} className='btn btn-outline-dark btn-sm'>
                                    <FontAwesomeIcon icon={faEye}/>
                                </Link>
                            </td>
                        </tr>
                        ))
                    }

                </tbody>
            </table>
        </div>
    )
}