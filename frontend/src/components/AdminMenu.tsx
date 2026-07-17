
import NavItem from "./NavItem";
import {

  FiSettings,
} from "react-icons/fi";

const menu= [
  { to: "/administration", icon: <FiSettings />, label: "Dashboard" },
  { to: "metric-keys", icon: <FiSettings />, label: "Metric Keys" },
  { to: "badges", icon: <FiSettings />, label: "Badges" },
  { to: "attendance", icon: <FiSettings />, label: "Attendance" },
  ];

export default function AdminMenu({ full }: { full: boolean }) {


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