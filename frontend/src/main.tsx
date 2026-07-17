import {StrictMode} from 'react'
import {createRoot} from 'react-dom/client'
import './index.css'
import {RouterProvider} from "react-router/dom";
import router from "./router.tsx";
import { useAuthStore } from './stores/useAuthStore.ts';


const initialize = useAuthStore.getState().initialize;

initialize().finally(() => {
    createRoot(document.getElementById('root')!).render(
        <StrictMode>
            <RouterProvider router={router}/>
        </StrictMode>
    )
});

document.documentElement.classList.toggle('dark')