import { create } from "zustand";

interface AuthUser {
  id: number;
  firstName: string;
  lastName: string;
  email: string;
  role: string;
  token: string;
}

interface AuthState {
  user: AuthUser | null;
  isAuthenticated: boolean;
  setUser: (user: AuthUser | null) => void;
  logout: () => void;
}

export const useAuthStore = create<AuthState>((set) => ({
  // Core State (Initial values)
    user: null,
    isAuthenticated: false,
  
    // Actions (Mutations / Methods)
    setUser: (userData) => 
      set({ 
        user: userData, 
        isAuthenticated: true 
      }),
  
    logout: () => 
      set({ 
        user: null, 
        isAuthenticated: false 
      }),
}))