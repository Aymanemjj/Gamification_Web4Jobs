import { createBrowserRouter } from "react-router";

import ProtectedRoute from "./layouts/ProtectedRoute";

import MainLayout from "./layouts/MainLayout";
import AdminLayout from "./layouts/AdminLayout";

import LoginPage from "./pages/LoginPage";
import ErrorPage from "./pages/ErrorPage";

import LeaderBoard from "./pages/normal/LeaderBoard";
import Profile from "./pages/normal/Profile";
import Missions from "./pages/normal/Missions";
import Achievements from "./pages/normal/Achievements";
import League from "./pages/normal/League";
import Progress from "./pages/normal/Progress";
import Rewards from "./pages/normal/Rewards";

import DashBoard from "./pages/admin/DashBoard";
import MetricKeys from "./pages/admin/MetricKeys";

const router = createBrowserRouter([
  // Guest-only routes
  {
    element: <ProtectedRoute guestOnly />,
    children: [
      {
        path: "/login",
        Component: LoginPage,
      },
    ],
  },

  // Authenticated users
  {
    element: <ProtectedRoute />,
    children: [
      {
        path: "/",
        Component: MainLayout,
        children: [
          { index: true, Component: LeaderBoard },
          { path: "profile", Component: Profile },
          { path: "missions", Component: Missions },
          { path: "achievements", Component: Achievements },
          { path: "league", Component: League },
          { path: "progress", Component: Progress },
          { path: "rewards", Component: Rewards },
        ],
      },
    ],
  },

  // Admin only
  {
    element: <ProtectedRoute requireAdmin />,
    children: [
      {
        path: "/administration",
        Component: AdminLayout,
        children: [
          { index: true, Component: DashBoard },
          { path: "metric-keys", Component: MetricKeys },
        ],
      },
    ],
  },

  {
    path: "*",
    Component: ErrorPage,
  },
]);

export default router;
