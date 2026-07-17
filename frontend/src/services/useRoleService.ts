import { useEffect, useState } from "react";
import axiosClient from "../axios";

export function GetAllRoles() {
  const [roles, setData] = useState(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  useEffect(() => {
    setLoading(true);
    axiosClient.get('/admin/roles/getall')
      .then((response) => {
        setData(response.data.data);
        setLoading(false);
      })
      .catch((error) => {
        setError(error);
        setLoading(false);
      });
  }, []);
  console.log(roles);
  return { roles, loading, error };
}