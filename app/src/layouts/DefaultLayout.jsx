import {Outlet} from "react-router-dom";

/**
 * Font Awesome Icons
 * */
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faTruckFast} from "@fortawesome/free-solid-svg-icons";
import {faCode} from "@fortawesome/free-solid-svg-icons";
import {faLinkedin} from "@fortawesome/free-brands-svg-icons";
import {faSquareGithub} from "@fortawesome/free-brands-svg-icons";

export default function DefaultLayout(){
    return(
        <>
            <div className='container-fluid bg-light-subtle'>
                <header className='d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom'>
                    <a href="/" className="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                        <svg className='bi me-2' width='40' height='32'>
                            <FontAwesomeIcon icon={faTruckFast}/>
                        </svg>
                        <span className='fs-4'>Gerenciamento de entregas</span>
                    </a>
                </header>
                <div className='container-fluid'>
                    <Outlet/>
                </div>
                <footer className='d-flex justify-content-center py-3 my-4 border-top'>
                    <span className='mb-3 me-1 ms-1 text-body-secondary'><FontAwesomeIcon icon={faCode} /> Developed by Razumickin Maldonado</span>
                    <a className='text-body-secondary me-1'
                       href='https://www.linkedin.com/in/razumickin-maldonado-4a640412b/'>
                        <FontAwesomeIcon icon={faLinkedin}/>
                    </a>
                    <a className='text-body-secondary' href='https://github.com/Razumickin'>
                        <FontAwesomeIcon icon={faSquareGithub}/>
                    </a>
                </footer>
            </div>
        </>
    )
}