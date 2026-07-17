import { Navigate, Outlet } from "react-router-dom";
import { useAuthStore } from "../stores/useAuthStore";

interface ProtectedRouteProps {
  requireAdmin?: boolean;
  guestOnly?: boolean;
}

export default function ProtectedRoute({
  requireAdmin = false,
  guestOnly = false,
}: ProtectedRouteProps) {
  const { user, isAuthenticated, isLoading } = useAuthStore();
  if (isLoading) {
    return <div>Loading...</div>;
  }

  if (guestOnly && isAuthenticated) {
    return <Navigate to="/" replace />;
  }

  if (!guestOnly && !isAuthenticated) {
    return <Navigate to="/login" replace />;
  }

  if (requireAdmin && user?.role !== "super_admin") {
    return <Navigate to="/" replace />;
  }

  return <Outlet />;
}