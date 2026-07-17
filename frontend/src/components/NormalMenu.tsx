import NavItem from "./NavItem";
import {
  FiAward,
  FiGift,
  FiHome,
  FiShield,
  FiTarget,
  FiTrendingUp,
  FiUser,
  FiSettings,
} from "react-icons/fi";

const menu= [
    { to: "/", icon: <FiHome />, label: "LeaderBoard" },
    { to: "/profile", icon: <FiUser />, label: "Profile" },
    { to: "/missions", icon: <FiTarget />, label: "Missions" },
    { to: "/achievements", icon: <FiAward />, label: "Achievements" },
    { to: "/league", icon: <FiShield />, label: "League" },
    { to: "/progress", icon: <FiTrendingUp />, label: "Progress" },
    { to: "/rewards", icon: <FiGift />, label: "Rewards" },
    { to: "/administration", icon: <FiSettings />, label: "Administration" },
  ];

export default function NormalMenu({ full }: { full: boolean }) {


  if (full) {
    return (
      <nav>
        <ul className="flex flex-col gap-1">
          {menu.map((item) => (
            <li key={item.to}>
              <NavItem
                to={item.to}
                label={item.label}
                icon={item.icon}
                collapsed={false}
              />
            </li>
          ))}
        </ul>
      </nav>
    );
  } else {
    return (
      <nav>
        <ul className="flex flex-col gap-1 items-center">
          {menu.map((item) => (
            <li key={item.to}>
              <NavItem to={item.to} icon={item.icon} collapsed />
            </li>
          ))}
        </ul>
      </nav>
    );
  }
}
