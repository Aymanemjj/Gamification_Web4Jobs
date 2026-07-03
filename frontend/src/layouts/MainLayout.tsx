import {Outlet} from "react-router"
import logo from "../assets/Web4Jobs-Logo.png";
import logo2 from "../assets/Web4Jobs-Logo-Word.png";
import avatar from "../assets/avatar.png";
import {FiMenu} from "react-icons/fi";
import {useState} from "react";
import FullMenu from "../components/FullMenu.tsx";
import CollapsedMenu from "../components/CollapsedMenu.tsx";
import { FaRegMoon, FaRegSun } from "react-icons/fa"
import { IoIosSearch } from "react-icons/io";

export default function MainLayout() {
    const [menu, setMenu] = useState(true)
    const [dark, setDark] = useState(false)

    function toggleDark() {
        setDark(d => !d)
        document.documentElement.classList.toggle("dark")
    }
    return (
        <>

            <header className="sticky flex justify-between items-center bg-white dark:bg-bg-dark rounded-3xl px-6 py-3 shadow-sm">

                <div className="flex items-center gap-2">
                    <img src={logo} alt="Web4Jobs" className="h-8"/>
                    <img src={logo2} alt="Web4Jobs" className="h-4"/>
                </div>

                <div className="flex items-center gap-8">
                    <div className="flex items-center light:border light:border-border dark:bg-bg-dark-hover rounded-full px-4 py-2 w-80">
                        <input
                            type="text"
                            placeholder="Search..."
                            className="flex-1 outline-none text-sm dark:text-white text-gray-500"
                        />
                        <IoIosSearch className="light:text-muted dark:text-white"/>
                    </div>

                    <div className="flex items-center gap-4 dark:bg-bg-dark-hover rounded-full p-2">
                        <img src={avatar} alt="avatar" className="w-9 h-9 rounded-full object-cover"/>
                        <div className="flex flex-col">
                            <span className="text-sm font-medium dark:text-white text-gray-800">Mouatassim ADAB</span>
                            <span className="text-xs text-gray-400">Admin</span>
                        </div>
                        <svg className="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>

            </header>

            <div className="flex min-h-screen gap-8 mt-8">
                <aside
                    className={`flex flex-col justify-between p-6 bg-white dark:bg-bg-dark rounded-3xl transition-all duration-300 ${menu ? "w-64" : "w-20"} max-h-[89vh]`}>
                    <div className="flex flex-col gap-12">
                        <button
                            className={`cursor-pointer flex gap-2 items-center ${menu ? "justify-start" : "justify-center w-full"}`}
                            onClick={() => setMenu(m => !m)}>
                            <span className="text-2xl dark:text-white"><FiMenu/></span>
                            {menu && (
                                <span className="transition-all duration-300 overflow-hidden dark:text-white whitespace-nowrap">
                                Menu
                            </span>
                            )}
                        </button>

                        {menu ? <FullMenu/> : <CollapsedMenu/>}
                    </div>
                    <div >
                        <button
                            onClick={toggleDark}
                            className={`flex items-center p-1 rounded-xl w-full transition-all ${menu ? "gap-2" : "justify-center"}`}
                        >
                            <div className="p-2 rounded-lg bg-primary-normal text-white">
                                {dark ? <FaRegSun /> : <FaRegMoon />}
                            </div>
                            {menu && <span className="text-small dark:text-white font-medium">{dark ? "Light Mode" : "Dark Mode"}</span>}
                        </button>
                    </div>
                </aside>
                <main className="flex-1 bg-white dark:bg-bg-dark rounded-3xl">
                    <Outlet/>
                </main>
            </div>
        </>
    )
}