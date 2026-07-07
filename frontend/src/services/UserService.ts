import axiosClient from "../axios";
import { useState, useEffect } from "react";


export function FetchUsers() {
    const [data, setData] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        setLoading(true);
        axiosClient.get('/admin/users/getall')
            .then(response => {
                setData(response.data.data);
                setLoading(false);
            })
            .catch(err => {
                setError(err.response?.data?.message || err.message || "Failed to fetch users");
                setLoading(false);
            });
    }, []);

    return { data, loading, error };
}


export function changeUserRole(user: string, role: string) {
  return  axiosClient.put(`/admin/users/${user}/promote`, { role })
}

export function toggleActive(user: string) {
  return axiosClient.put(`/admin/users/${user}/`)
}