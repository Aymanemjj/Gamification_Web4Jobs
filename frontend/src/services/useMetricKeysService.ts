import { useEffect, useState } from "react";
import axiosClient from "../axios";

export function GetMetricKeys() {
  const [table, setTable] = useState(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  useEffect(() => {
    setLoading(true);
    axiosClient.get("/admin/metric-keys/getall")
      .then((response) => {
        setTable(response.data.data);
        setLoading(false);
      })
      .catch((error) => {
        setError(error.response?.data?.message || error.message || "Failed to fetch metric keys");
        setLoading(false);
      });
  }, []);

  return { table, loading, error };
}
