import {createBrowserRouter} from "react-router";
import LeaderBoard from "./pages/normal/LeaderBoard.tsx";
import MainLayout from "./layouts/MainLayout.tsx";
import Profile from "./pages/normal/Profile.tsx";
import Missions from "./pages/normal/Missions.tsx";
import Achievements from "./pages/normal/Achievements.tsx";
import League from "./pages/normal/League.tsx";
import Progress from "./pages/normal/Progress.tsx";
import Rewards from "./pages/normal/Rewards.tsx";

import AdminLayout from "./layouts/AdminLayout.tsx";
import DashBoard from "./pages/admin/DashBoard.tsx"

const router = createBrowserRouter([
    {
        path: "/",
        Component: MainLayout,
        children: [
            {index:true, Component:LeaderBoard},
            {path:"/profile", Component:Profile},
            {path:"/missions", Component:Missions},
            {path:"/achievements", Component:Achievements},
            {path:"/league", Component:League},
            {path:"/progress", Component:Progress},
            {path:"/rewards", Component:Rewards},


        ]
    },
    {
        path: "/admin",
        Component: AdminLayout,
        children: [
            {index:true, Component:DashBoard},


        ]
    }
]);


export default router;