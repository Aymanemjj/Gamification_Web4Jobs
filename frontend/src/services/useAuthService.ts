import { useState } from "react";
import axiosClient from "../axios";
import type { LoginData } from "../types";

export function loegin(data: LoginData) {
  console.log("login", data);
  const credentials = axiosClient.post("/login", data);
  console.log("login", credentials);
  return credentials;
  
}
export function signOut() {
  return axiosClient.post("/logout");
}



export function useLogin() {
  const [credentials, setCredentials] = useState(null);
  const [loading, setLoading] = useState(false);
  const [errorMessage, setErrorMessage] = useState("");

  const login = async (data: LoginData) => {
    setLoading(true);
    setErrorMessage("");

    try {
      const response = await axiosClient.post("/login", data);
      setCredentials(response.data.data);
      localStorage.setItem("credentials", response.data.data.token);
      return response.data;
    } catch (error: any) {
      setErrorMessage(
        error.response?.data?.message || "An error occurred"
      );
      throw error;
    } finally {
      setLoading(false);
      console.log(localStorage.getItem("credentials"));
    }
  };

  return {
    login,
    credentials,
    loading,
    errorMessage,
  };
}