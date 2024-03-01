import {useParams} from "react-router-dom";
import {useEffect} from "react";
import axiosClient from "../axios-client.js";

export default function Delivery(){
    let {id} = useParams();

    useEffect(() => {
        axiosClient.get(`/delivery/${id}`)
            .then(({data}) => {
                console.log(data)
            }).catch(error => {
            const response = error.response
            console.log(response.data.errors);
        })
    }, [])

    return(
        <div>
            Informação da entrega
        </div>
    )
}