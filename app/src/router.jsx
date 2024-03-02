import {createBrowserRouter, Navigate} from "react-router-dom";
import Deliveries from "./views/Deliveries.jsx";
import NotFound from "./views/NotFound.jsx";
import DefaultLayout from "./layouts/DefaultLayout.jsx";
import Delivery from "./views/Delivery.jsx";

const router = createBrowserRouter([
    {
        path:'/',
        element: <DefaultLayout />,
        children: [
            {
              path: '/',
              element: <Navigate to={'/deliveries'} />
            },
            {
                path: '/deliveries',
                element: <Deliveries />
            },
            {
                path: '/delivery/:id',
                element: <Delivery />
            },
            {
                path: '*',
                element: <NotFound />
            }
        ]
    }
])

export default router