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


export function changeUserRole(user: number, role: string) {
  return axiosClient.put(`/admin/users/${user}/change-role`, { role })
}

export function toggleActive(user: number) {
  return axiosClient.put(`/admin/users/${user}/toggle-active`)
}


