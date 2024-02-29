import {useRef} from "react";
import axiosClient from "../axios-client.js";

export default function Deliveries(){
    const cpfRef = useRef();
    const onSubmit = (ev)=> {
        ev.preventDefault()

        const payload = {
            cpf: cpfRef.current.value
        }

        axiosClient.post('/getDeliveries', payload)
            .then(({data}) => {
                console.log(data);
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
                    <tr>
                        <td>Maria Oliveira</td>
                        <td>355.956.060-88</td>
                        <td>Avenida Principal, 456, Rio de Janeiro, Brasil</td>
                        <td>1</td>
                        <td>Lojas B - Suprimentos Alimentos</td>
                        <td>SWIFT CARGO - 12.345.678/9000-01</td>
                        <td>ENTREGA REALIZADA - 17/11/2023 11:20</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    )
}