import { create } from "zustand";
import axiosClient from "../axios";

interface AuthUser {
  firstName: string;
  lastName: string;
  email: string;
  role: string;
  token: string;
}

interface AuthState {
  user: AuthUser | null;
  isAuthenticated: boolean;
  isLoading: boolean;

  initialize: () => Promise<void>;
  logout: () => void;
  setUser: (user: AuthUser | null) => void;
}

export const useAuthStore = create<AuthState>((set) => ({
  user: null,
  isAuthenticated: false,
  isLoading: false,

  setUser: (user) =>
    set({
      user,
      isAuthenticated: !!user,
    }),

  logout: () => {
    localStorage.removeItem("credentials");

    set({
      user: null,
      isAuthenticated: false,
    });
  },

  initialize: async () => {
    console.log("initialize started");
  
    const token = localStorage.getItem("credentials");
    console.log("token", token);
  
    if (!token) {
      console.log("no token");
      set({
        user: null,
        isAuthenticated: false,
        isLoading: false,
      });
      return;
    }
  
    set({ isLoading: true });
  
    try {
      const response = await axiosClient.get("/info-zustland");
  
      console.log("response", response.data);
  
      set({
        user: response.data.data.user,
        isAuthenticated: true,
      });
  
      console.log("after set", useAuthStore.getState());
    } catch (e) {
      console.error(e);
    } finally {
      set({ isLoading: false });
    }
  }
}));