import {
  FiHome,
  FiUser,
  FiTarget,
  FiAward,
  FiShield,
  FiTrendingUp,
  FiGift,
  FiSettings,
} from "react-icons/fi";
import NavItem from "./NavItem";

const items = [
  { to: "/", icon: <FiHome /> },
  { to: "/profile", icon: <FiUser /> },
  { to: "/missions", icon: <FiTarget /> },
  { to: "/achievements", icon: <FiAward /> },
  { to: "/league", icon: <FiShield /> },
  { to: "/progress", icon: <FiTrendingUp /> },
  { to: "/rewards", icon: <FiGift /> },
  { to: "/admin", icon: <FiSettings />},
];

export default function CollapsedMenu() {
  return (
    <nav>
      <ul className="flex flex-col gap-1 items-center">
        {items.map((item) => (
          <li key={item.to}>
            <NavItem to={item.to} icon={item.icon} collapsed />
          </li>
        ))}
      </ul>
    </nav>
  );
}
