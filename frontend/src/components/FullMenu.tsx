import NavItem from "./NavItem.tsx";
import {FiAward, FiGift, FiHome, FiShield, FiTarget, FiTrendingUp, FiUser, FiSettings} from "react-icons/fi";

const items = [
    { to: "/", icon: <FiHome />, label: "LeaderBoard" },
    { to: "/profile", icon: <FiUser />, label: "Profile" },
    { to: "/missions", icon: <FiTarget />, label: "Missions" },
    { to: "/achievements", icon: <FiAward />, label: "Achievements" },
    { to: "/league", icon: <FiShield />, label: "League" },
    { to: "/progress", icon: <FiTrendingUp />, label: "Progress" },
    { to: "/rewards", icon: <FiGift />, label: "Rewards" },
    { to: "/admin", icon: <FiSettings />, label: "Admin" },
];

export default function FullMenu() {

    return (

            <nav>
                <ul className="flex flex-col gap-1">
                    {items.map(item => (
                        <li key={item.to}>
                            <NavItem to={item.to} label={item.label} icon={item.icon} collapsed={false} />
                        </li>
                    ))}
                </ul>
            </nav>

    )
}