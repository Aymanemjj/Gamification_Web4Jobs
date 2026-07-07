import { FiHome, FiUser, FiTarget, FiAward, FiShield, FiTrendingUp, FiGift, FiSettings } from "react-icons/fi";
import { useAuthStore } from "stores/useAuthStore";

// 1. Define the TypeScript shape for a nav item
export interface NavItem {
  to: string;
  icon: React.ReactNode;
  label: string;
}

export function useNavigationItems(): NavItem[] {
  // 2. Pull the user object reactively from your Zustand store
  const user = useAuthStore((state) => state.user);

  // 3. Define the base items that EVERY logged-in user can see
  const baseItems: NavItem[] = [
    { to: "/", icon: <FiHome />, label: "LeaderBoard" },
    { to: "/profile", icon: <FiUser />, label: "Profile" },
    { to: "/missions", icon: <FiTarget />, label: "Missions" },
    { to: "/achievements", icon: <FiAward />, label: "Achievements" },
    { to: "/league", icon: <FiShield />, label: "League" },
    { to: "/progress", icon: <FiTrendingUp />, label: "Progress" },
    { to: "/rewards", icon: <FiGift />, label: "Rewards" },
  ];

  // 4. Run the conditional check based on the user's role
  // (Assuming your payload roles match 'superAdmin' or 'admin' based on your JSON)
  if (user?.role === "superAdmin" || user?.role === "admin") {
    return [
      ...baseItems,
      { to: "/admin", icon: <FiSettings />, label: "Admin" } // Only appended for admins
    ];
  }

  switch (user?.role) {
      case "superAdmin" || "admin":
      return [
        ..baseItems,
        { to: "/admin", icon: <FiSettings />, label: "Dashboard" }
      ]
      }

  // Fallback: Return just the base navigation items for standard learners/guests
  return baseItems;
}